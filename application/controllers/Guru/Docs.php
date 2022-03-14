<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Docs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('GuruModel', 'guru', true);
		$this->get_guru = $this->db->get_where('tb_guru', ['guru_nip' =>
		$this->session->userdata('nip')])->row_array();
		is_guru_login();
	}

	public function export_latihan($method = null, $id = null)
	{
		if ($id == null && $method == null) {
			return false;
		}

		$guru 	= $this->get_guru;
		$id 	= $this->secure->decrypt_url($id);
		$tugas	= $this->guru->ekspor_latihan($id)->row_array();
		$siswa 	= $this->guru->getAllStudent($tugas['id_kelas']);
		$sum_siswa = $this->db->get_where('tb_siswa', ['id_kelas' => $tugas['id_kelas']])->num_rows();
		$mengumpulkan = $this->guru->get_tugas_siswa([
			'id_kelas' => $tugas['id_kelas'],
			'id_tugas' => $tugas['id_tugas'],
			'keterangan' => '1'
		])->num_rows();

		$belum = $sum_siswa - $mengumpulkan;

		if ($method === 'pdf') {
			$this->load->library('pdfgenerator');
			$this->data = [
				'title_pdf' => 'Laporan Nilai Tugas Latihan PerBab SMP Negeri 01 Kalibagor Tahun ' . date("Y"),
				'tugas'		=> $tugas,
				'guru' 		=> $guru,
				'siswa'		=> $siswa,
				'num_siswa' => $sum_siswa,
				'mengumpulkan' => $mengumpulkan,
				'belum'		=> $belum
			];
			$kelas = strtolower($tugas['kelas_nama']);
			$file_pdf = 'laporan_nilai_siswa_kelas_' . $kelas . '_' . time() . '_download';
			$paper 	= 'A4';
			$orientation = "portrait";
			$html = $this->load->view('guru/data_tugas/cetak_nilai',  $this->data, true);
			$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
		} elseif ($method === 'excel') {
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$styleJudul = [
				'font' => [
					'bold' => true,
					'size' => 14,
				],
				'alignment' => [
					'vertical' => Alignment::VERTICAL_CENTER,
					'horizontal' => Alignment::HORIZONTAL_CENTER,
					'wrap' => true,
				],
			];
			$sheet->setCellValue('A1', 'Laporan Nilai Tugas Latihan PerBab SMP Negeri 01 Kalibagor Tahun ' . date("Y"));
			$sheet->mergeCells('A1:F2');
			$sheet->getStyle('A1')->applyFromArray($styleJudul);

			$sheet->setCellValue('B4', 'Kelas : ' . $tugas['kelas_nama'] . '');
			$sheet->setCellValue('B5', 'Bab : ' . $tugas['bab_ke'] . ' (' . $tugas['bab_judul']  . ')');
			$sheet->setCellValue('B6', 'latihan Tugas : ' . $tugas['latihan_tugas_ke'] . '');
			$sheet->setCellValue('B7', 'Mapel : ' . $tugas['mapel'] . '');
			$sheet->setCellValue('D4', 'Guru Pengajar : ' . $guru['guru_nama'] . '');
			$sheet->mergeCells('D4:E4');
			$sheet->setCellValue('D5', 'NIP : ' . $guru['guru_nip'] . '');
			$sheet->mergeCells('D5:E5');
			$sheet->setCellValue('D6', 'Tanggal Cetak : ' . date('Y-m-d H:i:s') . '');
			$sheet->mergeCells('D6:E6');

			$stylefield = [
				'font' => [
					'bold' => true,
					'size' => 12,
				],
				'alignment' => [
					'horizontal' => Alignment::HORIZONTAL_CENTER,
					'wrap' => true,
				],

			];
			$sheet->setCellValue('A9', 'No');
			$sheet->setCellValue('B9', 'Nama Siswa');
			$sheet->setCellValue('C9', 'NIS');
			$sheet->setCellValue('D9', 'Jenis Kelamin');
			$sheet->setCellValue('E9', 'Tanggal Pengumpulan');
			$sheet->setCellValue('F9', 'Nilai');
			$sheet->getStyle('A9:F9')->applyFromArray($stylefield);

			$no = 1;
			$x = 10;
			foreach ($siswa as $row) {
				$nilai = $this->db->get_where('tb_tugas_siswa', [
					'id_tugas' => $tugas['id_tugas'],
					'id_siswa' => $row->id_siswa
				])->row_object();
				$sheet->setCellValue('A' . $x, $no++);
				$sheet->setCellValue('B' . $x, $row->siswa_nama);
				$sheet->setCellValue('C' . $x, $row->siswa_nis);
				$sheet->setCellValue('D' . $x, $row->siswa_jenis_kelamin);
				if (!empty($nilai)) {
					$sheet->setCellValue('E' . $x, ($nilai->tanggal_upload == '0000-00-00') ? '-' : date('d-m-Y', strtotime($nilai->tanggal_upload)));
					$sheet->setCellValue('F' . $x, $nilai->nilai_tugas);
				} else {
					$sheet->setCellValue('E' . $x, '');
					$sheet->setCellValue('F' . $x, '');
				}
				$x++;
			}

			$sheet->setCellValue('B46', 'Keterangan');
			$sheet->mergeCells('B46:C46');
			$sheet->setCellValue('B47', 'Jumlah Siswa');
			$sheet->mergeCells('B47:C47');
			$sheet->setCellValue('B48', 'Siswa Yang Mengumpulkan Tugas');
			$sheet->mergeCells('B48:C48');
			$sheet->setCellValue('B49', 'Siswa Yang Tidak Mengumpulkan Tugas');
			$sheet->mergeCells('B49:C49');
			$sheet->getStyle('B46')->getFont()->setBold(true);
			$sheet->getStyle('B46:C46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

			$sheet->setCellValue('D46', 'Jumlah');
			$sheet->setCellValue('D47', '' . $sum_siswa . '');
			$sheet->setCellValue('D48', '' . $mengumpulkan . '');
			$sheet->setCellValue('D49', '' . $belum . '');
			$sheet->getStyle('D46')->getFont()->setBold(true);
			$sheet->getStyle('D46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(35);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(8);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(7);

			$writer = new Xlsx($spreadsheet);

			$kelas = strtolower($tugas['kelas_nama']);
			$filename = 'laporan_nilai_siswa_kelas_' . $kelas . '_' . time() . '_download';

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
		}
	}

	public function export_kompetensi($method = null, $id = null)
	{
		if ($id == null && $method == null) {
			return false;
		}

		$guru 	= $this->get_guru;
		$id 	= $this->secure->decrypt_url($id);
		$uk		= $this->guru->ekspor_kompetensi($id)->row_array();
		$siswa 	= $this->guru->getAllStudent($uk['id_kelas']);
		$sum_siswa = $this->db->get_where('tb_siswa', ['id_kelas' => $uk['id_kelas']])->num_rows();
		$mengerjakan =  $this->guru->get_uk_siswa([
			'id_kelas' => $uk['id_kelas'],
			'id_bab' => $uk['id_bab'],
			'keterangan' => '1'
		])->num_rows();
		$belum = $sum_siswa - $mengerjakan;

		if ($method === 'pdf') {

			$this->load->library('pdfgenerator');
			$this->data = [
				'title_pdf' => 'Laporan Nilai Uji Kompetensi PerBab SMP Negeri 01 Kalibagor Tahun ' . date("Y"),
				'kompetensi' => $uk,
				'guru' 		=> $guru,
				'siswa'		=> $siswa,
				'num_siswa' => $sum_siswa,
				'mengerjakan' => $mengerjakan,
				'belum'		=> $belum
			];
			$kelas = strtolower($uk['kelas_nama']);
			$file_pdf = 'laporan_kompetensi_siswa_kelas_' . $kelas . '_' . time() . '_download';
			$paper 	= 'A4';
			$orientation = "portrait";
			$html = $this->load->view('guru/data_tugas/cetak_nilai_uk',  $this->data, true);
			$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
		} elseif ($method === 'excel') {

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$styleJudul = [
				'font' => [
					'bold' => true,
					'size' => 14,
				],
				'alignment' => [
					'vertical' => Alignment::VERTICAL_CENTER,
					'horizontal' => Alignment::HORIZONTAL_CENTER,
					'wrap' => true,
				],
			];
			$sheet->setCellValue('A1', 'Laporan Nilai Uji Kompetensi PerBab SMP Negeri 01 Kalibagor Tahun ' . date("Y"));
			$sheet->mergeCells('A1:J2');
			$sheet->getStyle('A1')->applyFromArray($styleJudul);

			$sheet->setCellValue('B4', 'Kelas');
			$sheet->setCellValue('B5', 'Bab');
			$sheet->setCellValue('B6', 'Tanggal Uji Kompetensi');
			$sheet->setCellValue('B7', 'Mapel');

			$sheet->setCellValue('C4', '' . $uk['kelas_nama'] . '');
			$sheet->mergeCells('C4:D4');
			$sheet->setCellValue('C5', '' . $uk['bab_ke'] . ' (' . $uk['bab_judul'] . ')');
			$sheet->mergeCells('C5:D5');
			$sheet->setCellValue('C6', '' . ($uk['tanggal_mulai'] == null) ? ' - ' : date('d-m-Y', strtotime($uk['tanggal_mulai'])) . '');
			$sheet->mergeCells('C6:D6');
			$sheet->setCellValue('C7', '' . $uk['mapel'] . '');
			$sheet->mergeCells('C7:D7');

			$sheet->setCellValue('F4', 'Guru Pengajar');
			$sheet->mergeCells('F4:G4');
			$sheet->setCellValue('F5', 'NIP');
			$sheet->mergeCells('F5:G5');
			$sheet->setCellValue('F6', 'Tanggal Cetak');
			$sheet->mergeCells('F6:G6');

			$sheet->setCellValue('H4', '' . $guru['guru_nama'] . '');
			$sheet->mergeCells('H4:I4');
			$sheet->setCellValue('H5', '' . $guru['guru_nip'] . '');
			$sheet->mergeCells('H5:I5');
			$sheet->setCellValue('H6', '' . date('Y-m-d H:i:s') . '');
			$sheet->mergeCells('H6:I6');


			$stylefield = [
				'font' => [
					'bold' => true,
					'size' => 12,
				],
				'alignment' => [
					'horizontal' => Alignment::HORIZONTAL_CENTER,
					'wrap' => true,
				],

			];

			$sheet->setCellValue('A9', 'No');
			$sheet->setCellValue('B9', 'Nama Siswa');
			$sheet->setCellValue('C9', 'NIS');
			$sheet->setCellValue('D9', 'Jenis Kelamin');
			$sheet->setCellValue('E9', 'Soal');
			$sheet->setCellValue('F9', 'Benar');
			$sheet->setCellValue('G9', 'Salah');
			$sheet->setCellValue('H9', 'Tidak DiJawab');
			$sheet->setCellValue('I9', 'Nilai');
			$sheet->setCellValue('J9', 'Tanggal Pengerjaan');
			$sheet->getStyle('A9:J9')->applyFromArray($stylefield);

			$no = 1;
			$x = 10;
			foreach ($siswa as $row) {
				$nilai = $this->db->get_where('tb_uk_siswa', [
					'id_bab' => $uk['id_bab'],
					'id_siswa' => $row->id_siswa
				])->row_object();
				$sheet->setCellValue('A' . $x, $no++);
				$sheet->setCellValue('B' . $x, $row->siswa_nama);
				$sheet->setCellValue('C' . $x, $row->siswa_nis);
				$sheet->setCellValue('D' . $x, $row->siswa_jenis_kelamin);
				$sheet->setCellValue('E' . $x, (empty($nilai)) ? '' : $nilai->jumlah_soal);
				$sheet->setCellValue('F' . $x, (empty($nilai)) ? '' : $nilai->jumlah_benar);
				$sheet->setCellValue('G' . $x, (empty($nilai)) ? '' : $nilai->jumlah_salah);
				$sheet->setCellValue('H' . $x, (empty($nilai)) ? '' : $nilai->tidak_dijawab);
				$sheet->setCellValue('I' . $x, (empty($nilai)) ? '' : $nilai->nilai_uk);
				$sheet->setCellValue('J' . $x, (empty($nilai)) ? '' : date('d-m-Y', strtotime($nilai->tanggal_uk)));
				$x++;
			}

			$sheet->setCellValue('B46', 'Keterangan');
			$sheet->mergeCells('B46:C46');
			$sheet->setCellValue('B47', 'Jumlah Siswa');
			$sheet->mergeCells('B47:C47');
			$sheet->setCellValue('B48', 'Siswa Yang Mengerjakan Kompetensi');
			$sheet->mergeCells('B48:C48');
			$sheet->setCellValue('B49', 'Siswa Yang Tidak Mengerjakan Kompetensi');
			$sheet->mergeCells('B49:C49');
			$sheet->getStyle('B46')->getFont()->setBold(true);
			$sheet->getStyle('B46:C46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

			$sheet->setCellValue('D46', 'Jumlah');
			$sheet->setCellValue('D47', '' . $sum_siswa . '');
			$sheet->setCellValue('D48', '' . $mengerjakan . '');
			$sheet->setCellValue('D49', '' . $belum . '');
			$sheet->getStyle('D46')->getFont()->setBold(true);
			$sheet->getStyle('D46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);

			$writer = new Xlsx($spreadsheet);
			$kelas = strtolower($uk['kelas_nama']);
			$filename = 'laporan_kompetensi_siswa_kelas_' . $kelas . '_' . time() . '_download';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
		}
	}
}

<?php 
    class Ujian extends CI_Controller {
        
        public function __construct()
		{
			parent::__construct();
			$this->load->model('SiswaModel', 'siswa', true);
			$this->userSiswa = $this->siswa->get_datasiswa($this->session->userdata('nis'))->row_array();
			is_siswa_login();
		}

		public function index($id_bab) {
			is_siswa();
			$siswa = $this->userSiswa;
			$id_bab = $this->secure->decrypt_url($id_bab);
			$info_uk = $this->siswa->get_infouk([
				'tb_pemb_uk.id_bab' => $id_bab,
				'tb_pemb_uk.id_kelas' => $siswa['id_kelas']
			])->row_array();
			$ParseData = [
				'title' => 'Wiyata E-Learning | Soal Uji Kompetensi BAB',
				'info_uk' => $info_uk,
				'siswa' => $siswa,
				'data_bab' => $this->db->get_where('tb_bab', ['id_bab' => $id_bab])->row_array()
			]; 

            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar',  $ParseData);
            $this->load->view('siswa/uji_kompetensi/pemb_uk',  $ParseData);
            $this->load->view('siswa/layouts/footer',  $ParseData);
		}

		public function uji_kompetensi($id_bab){
			is_siswa();
			$id_bab = $this->secure->decrypt_url($id_bab);
			$soal_ujian = $this->db->get_where('tb_ujikompetensi', ['id_bab' => $id_bab]);
            $ParseData = [
				'title' => 'Wiyata E-Learning | Soal Uji Kompetensi BAB',
				'soal_ujian' => $soal_ujian->result_object(),
				'jumlah_soal' => $soal_ujian->num_rows(),
				'get_bab' 	=> $this->db->get_where('tb_bab', ['id_bab' => $id_bab])->row_array()
			]; 

            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar',  $ParseData);
            $this->load->view('siswa/uji_kompetensi/uk',  $ParseData);
            $this->load->view('siswa/layouts/footer',  $ParseData);
        }

		public function uji_kompetensiEssay($id_bab){
			is_siswa();
			$id_bab = $this->secure->decrypt_url($id_bab);
			$soal_ujian = $this->db->get_where('tb_ujikompetensi', ['id_bab' => $id_bab]);
            $ParseData = [
				'title' => 'Wiyata E-Learning | Soal Uji Kompetensi BAB',
				'soal_ujian' => $soal_ujian->result_object(),
				'jumlah_soal' => $soal_ujian->num_rows(),
				'get_bab' 	=> $this->db->get_where('tb_bab', ['id_bab' => $id_bab])->row_array()
			]; 

            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar',  $ParseData);
            $this->load->view('siswa/uji_kompetensi/uk_essay',  $ParseData);
            $this->load->view('siswa/layouts/footer',  $ParseData);
        }

		public function cek_ujian() {
			// is_siswa();
			$siswa = $this->userSiswa;
			$date_now = date('Y-m-d');
			$time_now = date('H:i:s');
			$id_bab = $this->input->post('id_bab', true);
			$id_bab = $this->secure->decrypt_url($id_bab);
			$where_uk = array(
				'id_kelas' => $siswa['id_kelas'],
				'id_bab' => $id_bab
			);
			$cek_uk = $this->db->get_where('tb_pemb_uk', $where_uk)->row_array();

			$tanggal_mulai	= strtotime($cek_uk['tanggal_mulai']);
			$waktu_mulai 	= strtotime($cek_uk['waktu_mulai']);
			$waktu_selesai	= strtotime($cek_uk['waktu_selesai']);
	
			if(empty($tanggal_mulai)) {
				$response = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => false,
					'msgujian' => 'Pelaksanaan Uji Kompetensi Belum Dimulai'
				];
			} else {
				if(strtotime($date_now) < strtotime($cek_uk['tanggal_mulai'])) {
					$response = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => false,
						'msgujian' => 'Waktu Uji Kompetensi Belum Dimulai'
					];
				} elseif(strtotime($date_now) == strtotime($cek_uk['tanggal_mulai'])) {

					if(empty($waktu_mulai) OR empty($waktu_selesai)) {
						$response = [
							'csrfName' => $this->security->get_csrf_token_name(),
							'csrfHash' => $this->security->get_csrf_hash(),
							'success' => true,
							'msgujian' => 'Waktu Uji Kompetensi Sudah Dimulai'
						];
					} elseif(strtotime($time_now) <= strtotime($cek_uk['waktu_mulai'])) {
						$response = [
							'csrfName' => $this->security->get_csrf_token_name(),
							'csrfHash' => $this->security->get_csrf_hash(),
							'success' => false,
							'msgujian' => 'Waktu Uji Kompetensi Belum Dimulai'
						];
					} elseif(strtotime($time_now) >= strtotime($cek_uk['waktu_selesai'])) {
						$response = [
							'csrfName' => $this->security->get_csrf_token_name(),
							'csrfHash' => $this->security->get_csrf_hash(),
							'success' => false,
							'msgujian' => 'Waktu Uji Kompetensi Sudah Selesai'
						];
					} else {
						$response = [
							'csrfName' => $this->security->get_csrf_token_name(),
							'csrfHash' => $this->security->get_csrf_hash(),
							'success' => true,
							'msgujian' => 'Waktu Uji Kompetensi Sudah Dimulai'
						];
					}
				} elseif(strtotime($date_now) > $tanggal_mulai) {
					$response = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => false,
						'msgujian' => 'Waktu Uji Kompetensi Telah Berakhir'
					];
				} else {
					$response = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => true,
						'msgujian' => 'Waktu Uji Kompetensi Sudah Dimulai'
					];
				}
			}

			echo json_encode($response);
		}

		public function submit_ujian() {
			$siswa = $this->userSiswa;
			$id_bab		= $this->input->post('id_bab', true);
			$ujian = $this->input->post();

			if($ujian) {
				$pilihan	= $this->input->post('pilihan', true);
				$id_soal	= $this->input->post('id_ujian', true);
				$jumlah_soal = $this->input->post('jumlah_soal', true);

				$score    = 0;
				$benar    = 0;
				$salah    = 0;
				$kosong	  = 0;

				for($i= 0; $i < $jumlah_soal; $i++) {
					$nomor    =$id_soal[$i];
					if(empty($pilihan[$nomor])) {
						$kosong++;
					} else {
						$jawaban	= $pilihan[$nomor];
						$query 		= $this->db->get_where('tb_ujikompetensi',[
							'id_ujian' => $nomor,
							'id_bab' => $id_bab,
							'kunci'	 => $jawaban,
						]);
						$cek = $query->num_rows();
						if($cek) {
							$benar++;
						} else {
							$salah++;
						}
					}
					$hitung_soal = $this->db->get_where('tb_ujikompetensi', ['id_bab' => $id_bab]);
					$jumlah_soal = $hitung_soal->num_rows();
					$score = $benar / $jumlah_soal * 100;
					$nilai = number_format($score,2);
				}

				$nilai_siswa = array(
					'id_siswa' => $siswa['id_siswa'],
					'id_bab' => $id_bab,
					'jumlah_soal' 	=> $jumlah_soal,
					'jumlah_benar' => $benar,
					'jumlah_salah' => $salah,
					'tidak_dijawab' => $kosong,
					'nilai_uk'	=> $nilai,
					'tanggal_uk' => date('Y-m-d'),
					'keterangan' => 1
				);
				$this->db->insert('tb_uk_siswa', $nilai_siswa);
			}
			$bab_id = $this->secure->encrypt_url($id_bab);
			redirect('uji_kompetensi/ujian/nilai_ujian/' .$bab_id);
		}

        public function nilai_ujian($id_bab){
			is_siswa();
			$siswa = $this->userSiswa;
			$id_bab = $this->secure->decrypt_url($id_bab);
			$hasil_ujian = $this->db->get_where('tb_uk_siswa', [
				'id_siswa' => $siswa['id_siswa'],
				'id_bab' => $id_bab,
			])->row_array();
			
			$ParseData = [
				'title' => 'Wiyata E-Learning | Hasil Uji Kompetensi',
				'hasil_uk' => $hasil_ujian,
				'siswa'	=> $siswa,
				'data_bab' => $this->db->get_where('tb_bab', ['id_bab' => $id_bab])->row_array()
			]; 

			$this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar',  $ParseData);
            $this->load->view('siswa/uji_kompetensi/nilai_uk',  $ParseData);
            $this->load->view('siswa/layouts/footer',  $ParseData);
        }

		public function nilai_ujian_pilgan() {

			$ParseData = [
				'title' => 'Wiyata E-Learning | Hasil Evaluasi BAB',
			]; 

            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar',  $ParseData);
            $this->load->view('siswa/uji_kompetensi/hasil_uk_pilgan',  $ParseData);
            $this->load->view('siswa/layouts/footer',  $ParseData);
		}
        
		public function nilai_ujian_essay() {

			$ParseData = [
				'title' => 'Wiyata E-Learning | Hasil Evaluasi BAB',
			]; 

            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar',  $ParseData);
            $this->load->view('siswa/uji_kompetensi/hasil_uk_essay',  $ParseData);
            $this->load->view('siswa/layouts/footer',  $ParseData);
		}
        

        public function cetak_nilai($id)
    	{
    		if ($id == null) {
    			return false;
    		}
    
    		is_siswa();
    		$siswa 	= $this->userSiswa;
    		$id		= $this->secure->decrypt_url($id);
    		$nilai 	= $this->db->get_where('tb_uk_siswa', ['id_uk_siswa' => $id,])->row_array();
    		$bab 	= $this->db->get_where('tb_bab', ['id_bab' => $nilai['id_bab']])->row_array();
    
    		$this->ParseData = [
    			'title_pdf' => 'Hasil Uji Kompetensi BAB' . $bab['bab_ke'] . ' ' . $bab['bab_judul'],
    			'nilai' => $nilai,
    			'bab' => $bab,
    			'siswa' => $siswa,
    		];
    
    		$this->load->library('pdfgenerator');
    		$file_pdf = 'bukti_uji_kompetensi_bab_' . $bab['bab_ke'] . '_' . $siswa['siswa_nis'];
    		// setting paper
    		$paper = 'A4';
    		//orientasi paper potrait / landscape
    		$orientation = "portrait";
    		$html = $this->load->view('siswa/uji_kompetensi/cetak_nilai', $this->ParseData, true);
    
    		// run dompdf
    		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    	}
    }
?>

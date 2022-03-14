<?php 
    class Dashboard extends CI_Controller {
        
		public function __construct() {
			parent::__construct();
			$this->load->model('AdminModel', 'admin', true);
			is_admin_login();	
		}
        // Dashboard admin
        public function index(){
           
			is_admin();
			$ParseData = [
				'title'		=> 'Dashboard Admin | Wiyata E-Learning',
				'sum_guru'	=> $this->admin->get_jumlahdata('sum_guru'),
				'sum_kelas' => $this->admin->get_jumlahdata('sum_kelas'),
				'sum_siswa' => $this->admin->get_jumlahdata('sum_siswa'),
				'sum_pesan' => $this->admin->get_jumlahdata('sum_pesan')
			];
            $this->load->view('admin/layouts/header', $ParseData);
            $this->load->view('admin/layouts/sidebar', $ParseData);
            $this->load->view('admin/layouts/topbar', $ParseData);
            $this->load->view('admin/dashboard/dsb', $ParseData);
            $this->load->view('admin/layouts/footer', $ParseData);
        }


		# Ajax Halaman Dashboard
		// Get Data Tabel Dashboard
		public function table_dashboard()
		{
			$datatable = $this->input->get('type');
			$draw = intval($this->input->get("draw"));
			$data = array();
			$no   = 1;
			if ($datatable == 'tabel_kelas') {
				$query = $this->admin->getKelasGuru();
				foreach ($query->result() as $row) {
					$sub_array	= array();
					$sub_array[]	=	$no++;
					$sub_array[]	=	$row->kelas_nama;
					$sub_array[]	=	$row->mapel_nama;
					$sub_array[]	=	$row->guru_nama;
					$data[] = $sub_array;
				}
	
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $this->admin->getKelasGuru()->num_rows(),
					'recordFiltered' 	=> $this->admin->getKelasGuru()->num_rows(),
					'data' => $data
				);
			} elseif ($datatable == 'tabel_pesan') {
				$query = $this->admin->get_datatable('tb_pesan');
				foreach ($query->result() as $row) {
					$sub_array = array();
					$sub_array[] = 	$no++;
					$sub_array[] = 	$row->nama;
					$sub_array[] =	$row->subject;
					$sub_array[] =  $row->ket;
					$sub_array[]	=	'<div class="text-center"><button class="btn btn-sm btn-danger hapus-pesan" data-pesan-id="' . $row->pesan_id . '" title="Hapus Pesan">Hapus</button></div> ';
	
					$data[] = $sub_array;
				}
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $query->num_rows(),
					'recordFiltered' 	=> $query->num_rows(),
					'data' => $data
				);
			} elseif ($datatable == 'tabel_guru') {
				$query = $this->admin->getGuruMapel();
				foreach ($query->result() as $row) {
					$sub_array = array();
					$sub_array[] = 	$no++;
					$sub_array[] = 	$row->guru_nama;
					$sub_array[] =	$row->guru_nip;
					$sub_array[] =  $row->mapel_nama;
					$sub_array[] =  $row->guru_phone;
				
					$data[] = $sub_array;
				}
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $query->num_rows(),
					'recordFiltered' 	=> $query->num_rows(),
					'data' => $data
				);
			}
			echo json_encode($result);
		}
		
    }

?>

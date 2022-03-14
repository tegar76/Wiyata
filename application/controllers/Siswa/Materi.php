<?php 
    class Materi extends CI_Controller {
        

		public function __construct()
		{
			parent::__construct();
			$this->load->model('SiswaModel', 'siswa', true);
			$this->userSiswa = $this->db->get_where('tb_siswa', ['siswa_nis' => $this->session->userdata('nis')])->row_array();
			is_siswa_login();

		}

        public function index() {
			is_siswa();
			$siswa = $this->userSiswa;
			$ParseData = [
				'title' => 'Wiyata E-Learning - Ruang Materi',
				'materi' => $this->siswa->get_materibab(),
				'datakelas' => $this->siswa->get_datakelas($siswa['siswa_nis']),
			];

            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar', $ParseData);
            $this->load->view('siswa/materi_bab', $ParseData);
            $this->load->view('siswa/layouts/footer', $ParseData);
        }
    }

?>

<?php 
    class VideoPembelajaran extends CI_Controller {

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
			$ParseData = [
				'title' => 'Wiyata E-Learning | Video Pembelajaran',
				'video' => $this->siswa->get_videoID(['tb_videopembelajaran.id_bab' => $id_bab])->result_array(),
				'bab' => $this->db->get_where('tb_bab', ['id_bab' => $id_bab])->row_array()
			];

            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar', $ParseData);
            $this->load->view('siswa/video_pembelajaran/vp', $ParseData);
            $this->load->view('siswa/layouts/footer', $ParseData);
        }
    }

?>

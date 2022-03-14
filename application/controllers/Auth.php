<?php 
    class Auth extends CI_Controller {

        public function __construct() {
			parent::__construct();
			$this->load->model('AuthModel', 'auth', TRUE);
		}

		// message sweetalert 2 flashdata
		public function message($title = NULL, $text = NULL, $type = NULL) {
			return $this->session->set_flashdata([
				'title' => $title,
				'text' => $text,
				'type' => $type,
			]);
		}
		// check login user
		public function checkLogin() {
			if($this->session->userdata('level') == 'siswa') {
				redirect('Siswa/Profile');
			} else if($this->session->userdata('level') == 'guru') {
				redirect('Guru/Dashboard');
			}
		}

		public function index()
		{
        	$this->checkLogin();

			$validation = [
				[
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'trim|required',
					'errors' => ['required' => 'Form %s harus diisi!', 'xss_clean' => 'Please check your form on %s.']
				],
				[
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required',
					'errors' => ['required' => 'Form %s harus diisi!', 'xss_clean' => 'Please check your form on %s.']
				]
			];
			$this->form_validation->set_rules($validation);
			if ( $this->form_validation->run() == FALSE ) {
				$data['title'] = 'Wiyata E-Learning | Halaman Login';	
				$this->load->view('auth/v_auth', $data);
			} else {
				$this->_login();
			}
        }

		// aksi login
		public function _login() 
		{
			$data = $this->input->post();
			if($this->input->post()) {
				$dataSiswa	= $this->auth->getSiswaByNIS($data['username']);
				$dataGuru	= $this->auth->getGuruByNIP($data['username']);
				if($dataSiswa) {
					if( $data['password'] == $dataSiswa->siswa_password) {
						$sess_ = [
							'fullName'	=> $dataSiswa->siswa_nama,
							'nis'		=> $dataSiswa->siswa_nis,
							'kelas'		=> $dataSiswa->id_kelas,
							'id_'		=> $dataSiswa->id_siswa,
							'level'		=> 'siswa',
							'logged_in'	=> TRUE
						];

						$this->session->set_userdata( $sess_ );

						// update table siswa online
						$this->db->set('siswa_online', 1);
						$this->db->where('siswa_nis', $dataSiswa->siswa_nis);
						$this->db->update('tb_siswa');

						$this->message('Selamat Datang ' . $dataSiswa->siswa_nama . ' ! ', 'Silahkan mengikuti mata pelajaran Bahasa Indonesia ', 'success');
						redirect('Siswa/Profile');
					} else {
						$this->message('Opss!!', 'Username dan password tidak sesuai, silahkan coba lagi', 'warning');
						redirect('Auth');
					}
				} elseif($dataGuru) {
					if( password_verify($data['password'], $dataGuru->guru_password) ) {
						$sess_ = [
							'fullName'	=> $dataGuru->guru_nama,
							'nip'		=> $dataGuru->guru_nip,
							'mapel'		=> $dataGuru->id_mapel,
							'id_'		=> $dataGuru->id_guru,
							'level'		=> 'guru',
							'logged_in'	=> TRUE
						];
						$this->session->set_userdata( $sess_ );
						// update table guru online
						$this->db->set('guru_online', 1);
						$this->db->where('guru_nip', $dataGuru->guru_nip);
						$this->db->update('tb_guru');

						$this->message('Selamat Datang ' . $dataGuru->guru_nama . ' ! ', 'Silahkan memulai pelajaran Bahasa Indonesia ', 'success');
						redirect('Guru/Dashboard');
					} else {
						$this->message('Opss!!', 'Username dan password tidak sesuai, silahkan coba lagi', 'warning');
						redirect('Auth');
					}
				} elseif(empty($dataGuru) OR empty($dataSiswa)) {
					$this->message('Opss!!', 'Username dan password tidak sesuai, silahkan coba lagi', 'warning');
					redirect('Auth');
				}
			}
		}		
		// fungsi logout
		public function logout() {

			$reponse = [
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
				'success' => false,
				'messages' => []
			];

			if($this->session->userdata('level') == 'siswa') {

				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];

				$update_db = [
					'last_login' => date('Y-m-d H:i:s'),
					'siswa_online'	=> 0
				];
				$this->db->where('siswa_nis', $this->session->userdata('nis'));
				$this->db->update('tb_siswa', $update_db);
				$this->session->sess_destroy();

			} elseif($this->session->userdata('level') == 'guru') {

				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];

				$update_db = [
					'last_login' => date('Y-m-d H:i:s'),
					'guru_online'	=> 0
				];
				$this->db->where('guru_nip', $this->session->userdata('nip'));
				$this->db->update('tb_guru', $update_db);
				$this->session->sess_destroy();

			}

			echo json_encode($reponse);
		}
    }
?>

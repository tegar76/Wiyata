<?php 
    class AuthAdmin extends CI_Controller {
        

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

        public function index(){

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
			if($this->form_validation->run() == FALSE) {
				$data['title'] = 'Wiyata E-Learning | Halaman Login Admin';
            	$this->load->view('admin/auth/auth_admin', $data);
			} else {
				$this->do_login();
			}
        }

		public function do_login() {
			$data = $this->input->post();
			if($this->input->post()) {
				$dataAdmin = $this->auth->getAdminByUsername($data['username']);
				if($dataAdmin) {
					if( $data['password'] == $dataAdmin->password ) {
						$sess_ = [
							'fullName' 	=> $dataAdmin->nama_admin,
							'username'	=> $dataAdmin->username,
							'id_'		=> $dataAdmin->id_admin,
							'level' 	=> 'admin',
							'logged_in'	=> TRUE
						];
		
						$this->session->set_userdata($sess_);
						
						// update table admin 
						$this->db->set('status', 'online');
						$this->db->where('id_admin', $dataAdmin->id_admin);
						$this->db->update('tb_admin');
		
						$this->message('Selamat Datang ' . $dataAdmin->nama_admin . ' ! ', 'semoga harimu menyenangkan :) ', 'success');
						redirect('Admin/Dashboard');
					} else {
						$this->message('Opss!!', 'Username dan password tidak sesuai, silahkan coba lagi', 'warning');
						redirect('Admin/AuthAdmin');
					}
					
				} else if (empty($dataAdmin)) {
					$this->message('Opss!!', 'Username dan password tidak sesuai, silahkan coba lagi', 'warning');
					redirect('Admin/AuthAdmin');
				}
			}
		}

		public function logout() {

			$reponse = [
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
				'success' => false,
				'messages' => []
			];

			if($this->session->userdata('level') == 'admin') {

				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
	
				$update_db = [
					'last_login' => date('Y-m-d H:i:s'),
					'status' => 'offline'	
				];
	
				$this->db->where('id_admin', $this->session->userdata('id_'));
				$this->db->update('tb_admin', $update_db);
				$this->session->sess_destroy();

			}

			echo json_encode($reponse);
		}
    }
?>

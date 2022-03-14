<?php 
    class Profile extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('SiswaModel', 'siswa', true);
			$this->userSiswa = $this->siswa->get_datasiswa($this->session->userdata('nis'))->row_array();
			is_siswa_login();

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
			is_siswa();
            $siswa = $this->userSiswa['siswa_nama'];
			$ParseData = [
				'title' => 'Halaman Profile ' . $siswa . ' | Wiyata E-Learning',
				'profile_siswa' => $this->userSiswa

			];

            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar', $ParseData);
            $this->load->view('siswa/profile_siswa', $ParseData);
            $this->load->view('siswa/layouts/footer', $ParseData);
        }

        public function update_profile($error = null) {
			is_siswa();
            $siswa = $this->userSiswa['siswa_nama'];
			$ParseData = [
				'title' => 'Halaman Edit Profile ' . $siswa . ' | Wiyata E-Learning',
				'profile_siswa' => $this->userSiswa,
				'error_image' => $error
			];

			$validation = [
				[
					'field' => 'tempat_lahir_siswa',
					'label' => 'Tempat Lahir',
					'rules' => 'trim|required|xss_clean',
					'errors' => ['required' => 'Form %s harus diisi!', 'xss_clean' => 'Please check your form on %s.']
				],
				[
					'field' => 'tanggal_lahir_siswa',
					'label' => 'Tanggal Lahir',
					'rules' => 'trim|required|xss_clean',
					'errors' => ['required' => 'Form %s harus diisi!', 'xss_clean' => 'Please check your form on %s.']
				],
				[
					'field' => 'agama_siswa',
					'label' => 'Agama',
					'rules' => 'required|xss_clean|in_list[Islam, Kristen, Katolik, Hindu, Budha, Konghucu]',
					'errors' => ['required' => 'Form %s harus diisi!', 'xss_clean' => 'Please check your form on %s.']
				],
				[
					'field' => 'telepon_siswa',
					'label' => 'Nomor Telepon',
					'rules' => 'trim|required|numeric|xss_clean',
					'errors' => ['required' => 'Form %s harus diisi!', 'numeric' => 'form %s harus angka' , 'xss_clean' => 'Please check your form on %s.']
				],
				[
					'field' => 'alamat_siswa',
					'label' => 'Alamat',
					'rules' => 'trim|required|xss_clean',
					'errors' => ['required' => 'Form %s harus diisi!', 'xss_clean' => 'Please check your form on %s.']
				],
				[
					'field' => 'nama_ortu_siswa',
					'label' => 'Nama Orang Tua',
					'rules' => 'trim|required|xss_clean',
					'errors' => ['required' => 'Form %s harus diisi!', 'xss_clean' => 'Please check your form on %s.']
				],
				[
					'field' => 'no_telp_ortu',
					'label' => 'Nomor Telepon Orang Tua',
					'rules' => 'trim|required|numeric|xss_clean',
					'errors' => ['required' => 'Form %s harus diisi!', 'numeric' => 'form %s harus angka', 'xss_clean' => 'Please check your form on %s.']
				],
				[
					'field' => 'alamat_ortu',
					'label' => 'Alamat',
					'rules' => 'trim|required|xss_clean',
					'errors' => ['required' => 'Form %s harus diisi!', 'xss_clean' => 'Please check your form on %s.']
				],
			];

			
			$this->form_validation->set_rules($validation);
			if($this->form_validation->run() == FALSE) {
				$this->load->view('siswa/layouts/header', $ParseData);
				$this->load->view('siswa/layouts/navbar', $ParseData);
				$this->load->view('siswa/edit_profile', $ParseData);
				$this->load->view('siswa/layouts/footer', $ParseData);
			} else {
				$this->do_update();
			}
        }

		public function do_update() {
			$siswa = $this->userSiswa;
			$query_image = $siswa;
			$update_at	= date('Y-m-d H:i:s');

			if (!empty(htmlspecialchars($this->input->post('pass_conf')))) {
				$this->db->set('siswa_password', $this->input->post('pass_conf'));
			}

			$upload_image = $_FILES['profile_siswa']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
				$config['max_size']      = '2048';
				$config['file_name'] = 'IMG_' . $siswa['siswa_nisn'];
				$config['upload_path'] = './storage/siswa/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('profile_siswa')) {
					$gambar = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = './storage/siswa/profile/' . $gambar['file_name'];
					$config['create_thumb'] = false;
					$config['maintain_ratio'] = false;
					$config['width'] = 300;
					$config['height'] = 300;
					$config['new_image'] = './storage/siswa/profile/' . $gambar['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$old_image = $query_image['siswa_image'];
					if ($old_image != 'default.png') {
						@unlink(FCPATH . './storage/siswa/profile/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('siswa_image', $new_image);
				} else {
					$error = array('error' => $this->upload->display_errors());
					return $error;
				}
			}

			$savedata = [
				'siswa_tempat_lahir'	=> $this->input->post('tempat_lahir_siswa', true),
				'siswa_tanggal_lahir'	=> $this->input->post('tanggal_lahir_siswa', true),
				'siswa_agama'	=> $this->input->post('agama_siswa', true),
				'siswa_alamat'	=> $this->input->post('alamat_siswa', true),
				'siswa_phone'	=> $this->input->post('telepon_siswa', true),
				'siswa_ortu'	=> $this->input->post('nama_ortu_siswa', true),
				'siswa_ortu_phone'	=> $this->input->post('no_telp_ortu', true),
				'siswa_ortu_alamat'	=> $this->input->post('alamat_ortu', true),
				'update_at'	=> $update_at
			];

			$this->db->set($savedata);
			$this->db->where(['id_siswa' => $siswa['id_siswa'] ]);
			$this->db->update('tb_siswa');
			$this->message('Profile Berhasil Diupdate', 'Selamat' . $siswa['siswa_nama'] .', profile anda berhasil diperbarui', 'success');
			redirect('Siswa/Profile');
		}
        
        public function update_password() {
			$siswa = $this->userSiswa;
			$ParseData = [
				'title' => 'Update Password Siswa | Wiayta E-Learning',
				'profile_siswa' => $siswa,
			
			];

			$this->form_validation->set_rules('pass_lama', 'Password Lama', 'callback_password_check');
			$this->form_validation->set_rules('new_pass', 'Password Baru', 'required|trim|min_length[8]|matches[conf_pass]',[
				'matches' => 'konfirmasi password tidak sama!',
				'min_length' => 'password terlalu pendek! (minimal 8 karakter)',
				'required' => '{field} harus diisi!'
			]);
			$this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required|trim|min_length[8]|matches[new_pass]');
			if($this->form_validation->run() == FALSE) {
				$this->load->view('siswa/layouts/header', $ParseData);
				$this->load->view('siswa/layouts/navbar', $ParseData);
				$this->load->view('siswa/update_password', $ParseData);
				$this->load->view('siswa/layouts/footer', $ParseData);
			} else {
				$new_password = $this->input->post('new_pass');
				$this->db->set('siswa_password', $new_password); 
                $this->db->where('siswa_nis', $siswa['siswa_nis']);
                $this->db->update('tb_siswa');
				$this->message('Berhasil', 'password anda berhasil diperbarui', 'success');
				return redirect('Siswa/Profile');
			}
			
		}

		public function password_check($str) {
			$siswa = $this->userSiswa;
			if($siswa['siswa_password'] !== $str) {
				$this->form_validation->set_message('password_check', '{field} tidak sesuai!');
				return false;
			}
			return true;
		}
    }
?>

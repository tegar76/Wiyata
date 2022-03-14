<?php 
    class Profile extends CI_Controller {
        
        public function __construct() {
			parent::__construct();
			$this->load->model('GuruModel', 'guru', true);
			$this->load->model('AdminModel', 'admin', true);
			$this->get_guru = $this->db->get_where('tb_guru', ['guru_nip' => 
			$this->session->userdata('nip')])->row_array();
			is_guru_login();
		}

		// message sweetalert 2 flashdata
		public function message($title = NULL, $text = NULL, $type = NULL) {
			return $this->session->set_flashdata([
				'title' => $title,
				'text' => $text,
				'type' => $type,
			]);
		}

		// Profile guru
        public function index(){
			is_guru();
			$dataGuru = $this->get_guru;
            $ParseData = [
				'title' => 'Guru Wiayta E-Learning | Profile Guru' . $dataGuru['guru_nama'],
				'data_guru' => $dataGuru,
				'data_kelas' => $this->guru->getKelasByGuru($dataGuru['id_guru'])
			];

            $this->load->view('guru/layouts/header', $ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData);
            $this->load->view('guru/profile/prf', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
        }

        // Edit Profile guru
        public function editProfile($error = null){
			is_guru();
			$dataGuru = $this->get_guru;
			
            $ParseData = [
				'title' => 'Guru Wiayta E-Learning | Profile Guru' . $dataGuru['guru_nama'],
				'data_guru' => $dataGuru,
				'data_kelas' => $this->guru->getKelasByGuru($dataGuru['id_guru'])
			];

			$validation = [
				[
					'field'	=> 'nama_guru_edit',
					'label'	=> 'Nama Guru',
					'rules' => 'trim|xss_clean',
					'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field'	=> 'nip_guru_edit',
					'label'	=> 'NIP',
					'rules' => 'trim|xss_clean|numeric',
					'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'karakter harus angka tidak boleh huruf pada %s.']
				],
				[
					'field'	=> 'guru_mapel_edit',
					'label'	=> 'Guru Mapel',
					'rules' => 'trim|xss_clean',
					'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'jenis_kelamin_guru_edit',
					'label' => 'Jenis Kelamin',
					'rules' => 'xss_clean|in_list[laki-laki,perempuan]',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'tempat_lahir_edit',
					'label' => 'Tempat Lahir',
					'rules' => 'trim|xss_clean',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'tanggal_lahir_edit',
					'label' => 'Tanggal Lahir',
					'rules' => 'xss_clean',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'agama_guru_edit',
					'label' => 'Agama',
					'rules' => 'xss_clean|in_list[Islam,Kristen,Katolik,Hindu,Budha,Konghucu]',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'alamat_guru_edit',
					'label' => 'Alamat',
					'rules' => 'trim|xss_clean',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'no_telp_guru_edit',
					'label' => 'Telepon',
					'rules' => 'trim|xss_clean|numeric|max_length[13]',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'Karakter harus angka tidak boleh huruf pada %s.', 'max_length' => 'nomor Telepon terlalu panjang, max Karakter 13!']
				],
			];
			$this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == false) {
			
                $this->load->view('guru/layouts/header', $ParseData);
                $this->load->view('guru/layouts/sidebar', $ParseData);
                $this->load->view('guru/layouts/topbar', $ParseData);
                $this->load->view('guru/profile/edit_profile', $ParseData, $error);
                $this->load->view('guru/layouts/footer', $ParseData);
            } else {
				$this->update_guru();
			}
        }

		public function update_guru(){

			$query_guru = $this->get_guru;
			$date_edited = date('Y-m-d H:i:s');

			if (!empty(htmlspecialchars($this->input->post('pass_conf')))) {
				$this->db->set('guru_password', $this->input->post('pass_conf'));
			}
		
			if ($_FILES['image']['name'] != "") {
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
				$config['max_size']      = '2048';
				$config['encrypt_name'] = true;
				$config['upload_path'] = './storage/guru/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$gambar = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = './storage/guru/profile/' . $gambar['file_name'];
					$config['create_thumb'] = false;
					$config['maintain_ratio'] = false;
					$config['width'] = 300;
					$config['height'] = 300;
					$config['new_image'] = './storage/guru/profile/' . $gambar['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$old_image = $query_guru['guru_image'];
					if ($old_image != 'default.png') {
						@unlink(FCPATH . './storage/guru/profile/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('guru_image', $new_image);
				} else {
					$error = array('gagal' => $this->upload->display_errors());
					$this->editProfile($error);
				}
			}

			$sendsave = [
				'guru_nip'	=> htmlspecialchars($this->input->post('nip_guru_edit', true)),
				'guru_nama'	=> htmlspecialchars($this->input->post('nama_guru_edit', true)),
				'guru_jenis_kelamin'	=> htmlspecialchars($this->input->post('jenis_kelamin_guru_edit', true)),
				'guru_tempat_lahir'	=> htmlspecialchars($this->input->post('tempat_lahir_edit', true)),
				'guru_tanggal_lahir'	=> htmlspecialchars($this->input->post('tanggal_lahir_edit', true)),
				'guru_agama'	=> htmlspecialchars($this->input->post('agama_guru_edit', true)),
				'guru_alamat'	=> htmlspecialchars($this->input->post('alamat_guru_edit', true)),
				'guru_phone'	=> htmlspecialchars($this->input->post('telp_guru_edit', true)),
				'update_at'	=> $date_edited,
			];

			$this->db->set($sendsave);
			$this->db->where('id_guru', htmlspecialchars($query_guru['id_guru']));
			$this->db->update('tb_guru');

			$this->message('Profile Berhasil Diupdate', 'Selamat ' . $query_guru['guru_nama'] .', profile anda berhasil diperbarui', 'success');
			redirect('Guru/Profile');
		}
        
        public function update_password() {
			$dataGuru = $this->get_guru;
			$this->form_validation->set_rules('pass_lama', 'Password Lama', 'callback_password_check');
			$this->form_validation->set_rules('new_pass', 'Password Baru', 'required|trim|min_length[8]|matches[conf_pass]',[
				'matches' => 'konfirmasi password tidak sama!',
				'min_length' => 'password terlalu pendek! (minimal 8 karakter)',
				'required' => '{field} harus diisi!'
			]);
			$this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required|trim|min_length[8]|matches[new_pass]');
			if($this->form_validation->run() == FALSE) {
				$ParseData = [
					'title' => 'Guru Wiayta E-Learning | Update Password ',
					'data_guru' => $dataGuru,
					'data_kelas' => $this->guru->getKelasByGuru($dataGuru['id_guru'])
				];
				$this->load->view('guru/layouts/header', $ParseData);
				$this->load->view('guru/layouts/sidebar', $ParseData);
				$this->load->view('guru/layouts/topbar', $ParseData);
				$this->load->view('guru/profile/update_password', $ParseData);
				$this->load->view('guru/layouts/footer', $ParseData);
			} else {
				$new_password = $this->input->post('new_pass');
				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
				$this->db->set('guru_password', $password_hash); //set password yang sudah di hash ke database
                $this->db->where('guru_nip', $dataGuru['guru_nip']); // mengambil data dari session
                $this->db->update('tb_guru');
				$this->message('Berhasil', 'password anda berhasil diperbarui', 'success');
				return redirect('Guru/Profile');
			}
			
		}

		public function password_check($str) {
			$dataGuru = $this->get_guru;
			if(!password_verify( $str, $dataGuru['guru_password'])) {
				$this->form_validation->set_message('password_check', '{field} tidak sesuai!');
				return false;
			}
			return true;
		}
    }
?>

<?php 
    class DataSiswa extends CI_Controller {
        
		public function __construct() {
			parent::__construct();
			$this->load->model('AdminModel', 'admin', true);
			is_admin_login();	
		}

        // Data siswa
        public function index()
		{
			is_admin();
            $ParseData = [
				'title' => 'Admin Wiyata E-Learning | Daftar Data Siswa',
				'kelas' => $this->admin->get_datatable('tb_kelas')->result_object()
			];

            $this->load->view('admin/layouts/header', $ParseData);
            $this->load->view('admin/layouts/sidebar', $ParseData);
            $this->load->view('admin/layouts/topbar', $ParseData);
            $this->load->view('admin/data_siswa/ds', $ParseData);
            $this->load->view('admin/layouts/footer', $ParseData);
        }
		
		// ajax function untuk menampikna data siswa pada halaman data siswa admin
		public function get_datasiswa()
		{
			$draw = intval($this->input->get("draw"));
			$data = array();
			$no   = 1;
			$id_kelas	= $this->input->post('id_kelas');
			$query = $this->admin->get_siswa(['tb_kelas.id_kelas' => $id_kelas]);
			foreach ($query->result() as $row) {
				$sub_array = array();
				$sub_array[]	= 	$no++;
				$sub_array[]	=	$row->siswa_nama;
				$sub_array[]	=	$row->siswa_nis;
				$sub_array[]	=	$row->siswa_jenis_kelamin;
				$sub_array[]	=	(empty($row->siswa_phone)) ? ' - ' : $row->siswa_phone;
				$sub_array[]	=	($row->last_login == '0000-00-00 00:00:00') ? ' - ' :	date('d-m-Y H:i:s', strtotime($row->last_login));
				$sub_array[]	=	($row->siswa_online == 1) ? '<p class="text-primary font-weight-bold">Online</p>' : '<p class="text-danger font-weight-bold">Offline</p>';
				$sub_array[]	=	'<div class="text-center"><button class="btn btn-sm btn-success mb-1 px-3 ml-2 edit-siswa" data-siswa-id="' . $row->id_siswa . '" title="Edit Siswa">Edit</button><button class="btn btn-sm btn-primary mb-1 px-3 ml-2 view-siswa" data-siswa-id="' . $row->id_siswa . '" title="View Siswa">Lihat</button><button class="btn btn-sm btn-danger mb-1 px-3 ml-2 hapus-siswa" data-siswa-id="' . $row->id_siswa . '" title="Hapus Siswa">Hapus</button></div> ';

				$data[] = $sub_array;
			}

			$result = array(
				'draw' 	=> $draw,
				'recordTotal' => $this->admin->get_siswa(['tb_kelas.id_kelas' => $id_kelas])->num_rows(),
				'recordFiltered' 	=> $this->admin->get_siswa(['tb_kelas.id_kelas' => $id_kelas])->num_rows(),
				'data' => $data
			);

			echo json_encode($result);
		}


		// ajax function crud data siswa
		public function crud_datasiswa()
		{
			$typesend = $this->input->get('type');
			$reponse = [
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
			];

			// a. tambah data siswa
			if ($typesend == 'tambahsiswa') {
				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => False,
					'messages' => []
				];

				$validation = [
					[
						'field'	=> 'kelas_siswa',
						'label'	=> 'Kelas Siswa',
						'rules' => 'required|trim|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field'	=> 'nis_siswa',
						'label'	=> 'NIS',
						'rules' => 'required|trim|xss_clean|numeric',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'Karakter harus angka tidak boleh huruf pada %s.']
					],
					[
						'field'	=> 'nisn_siswa',
						'label'	=> 'NISN',
						'rules' => 'trim|xss_clean|numeric',
						'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'Karakter harus angka tidak boleh huruf pada %s.']
					],
					[
						'field'	=> 'nama_siswa',
						'label'	=> 'Nama Siswa',
						'rules' => 'required|trim|xss_clean',
						'error'	=> ['required' => 'Form %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'tempat_lahir',
						'label' => 'Tempat Lahir',
						'rules' => 'trim|xss_clean',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'tanggal_lahir',
						'label' => 'Tanggal Lahir',
						'rules' => 'xss_clean',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'agama_siswa',
						'label' => 'Agama',
						'rules' => 'xss_clean|in_list[Islam, Kristen, Katolik, Hindu, Budha, Konghucu]',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'jenis_kelamin_siswa',
						'label' => 'Jenis Kelamin',
						'rules' => 'required|xss_clean|in_list[laki-laki,perempuan]',
						'errors' => ['required' => 'Form %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'alamat_siswa',
						'label' => 'Alamat',
						'rules' => 'trim|xss_clean',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'no_telp_siswa',
						'label' => 'Telepon',
						'rules' => 'trim|xss_clean|numeric|max_length[13]',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'Karakter harus angka tidak boleh huruf pada %s.', 'max_length' => 'Nomor Telepon terlalu panjang, Max Karakter 13!']
					],
					[
						'field' => 'nama_ortu_siswa',
						'label' => 'Orang Tua Siswa',
						'rules' => 'trim|xss_clean',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'no_telp_ortu',
						'label' => 'Telepon Orang Tua',
						'rules' => 'trim|xss_clean',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'Karakter harus angka dan tidak boleh huruf pada %s.', 'max_length' => 'Nomor Telepon terlalu panjang, Max Karakter 13!']
					],
					[
						'field' => 'alamat_ortu',
						'label' => 'Alamat Orang Tua',
						'rules' => 'trim|xss_clean',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'pass_siswa',
						'label' => 'Password',
						'rules' => 'required|trim|required|xss_clean|min_length[8]',
						'errors' => ['required' => 'Form %s harus diisi minimal 8 karakter!', 'xss_clean' => 'cek kembali pada form %s %s.', 'max_length' => 'Password terlalu pendek, Minimal 8 Karakter!']
					],
					[
						'field' => 'pass_siswa_conf',
						'label' => 'Konfirmasi Password',
						'rules' => 'required|trim|xss_clean|min_length[8]|matches[pass_siswa]',
						'errors' => ['required' => 'Form %s harus diisi minimal 8 karakter!', 'xss_clean' => 'cek kembali pada form %s %s.', 'max_length' => 'Password terlalu pendek, Minimal 8 Karakter!', 'matches' => 'Konfirmasi passowrd tidak sesuai!']
					],
				];

				$this->form_validation->set_rules($validation);
				if ($this->form_validation->run() == FALSE) {
					$reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
				} else {
					$this->admin->crudsiswa($typesend);
					$reponse = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => true
					];
				}
			} elseif ($typesend == 'viewsiswa') { // b. liat data siswa
				$data['datasiswa'] = $this->admin->get_siswa(['id_siswa' => $this->input->post('id_siswa', TRUE)])->row_object();
				$html = $this->load->view('admin/data_siswa/view_siswa', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash()
				];
			} elseif ($typesend == 'hapussiswa') { // c. hapus data siwa
				$this->admin->crudsiswa($typesend);
				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'message' => 'Anda telah menghapus data siswa!',
					'success' => true
				];
			} elseif ($typesend == 'updatesiswa') { // d. update data siswa
				$data['datasiswa'] = $this->admin->get_siswa(['id_siswa' => $this->input->post('id_siswa', TRUE)])->row_object();
				$data['datakelas']	=	$this->admin->get_datatable('tb_kelas')->result_object();
				$html = $this->load->view('admin/data_siswa/edit_siswa', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash()
				];
			}

			echo json_encode($reponse);
		}
		public function do_updatesiswa()
		{
			$typesend = $this->input->get('type');
			$reponse = [
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
				'success' => False,
				'messages' => []
			];

			$validation = [
				[
					'field'	=> 'kelas_siswa_edit',
					'label'	=> 'Kelas Siswa',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field'	=> 'nis_siswa_edit',
					'label'	=> 'NIS',
					'rules' => 'trim|required|xss_clean|numeric',
					'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'Karakter harus angka tidak boleh huruf pada %s.']
				],
				[
					'field'	=> 'nisn_siswa_edit',
					'label'	=> 'NISN',
					'rules' => 'trim|xss_clean|numeric',
					'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'Karakter harus angka tidak boleh huruf pada %s.']
				],
				[
					'field'	=> 'nama_siswa_edit',
					'label'	=> 'Nama Siswa',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
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
					'field' => 'agama_siswa_edit',
					'label' => 'Agama',
					'rules' => 'xss_clean|in_list[Islam, Kristen, Katolik, Hindu, Budha, Konghucu]',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'jenis_kelamin_siswa_edit',
					'label' => 'Jenis Kelamin',
					'rules' => 'required|xss_clean|in_list[laki-laki,perempuan]',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'alamat_siswa_edit',
					'label' => 'Alamat',
					'rules' => 'trim|xss_clean',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'no_telp_siswa_edit',
					'label' => 'Telepon',
					'rules' => 'trim|xss_clean|numeric|max_length[13]',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'Karakter harus angka tidak boleh huruf pada %s.', 'max_length' => 'Nomor Telepon terlalu panjang, Max Karakter 13!']
				],
				[
					'field' => 'ortu_siswa_edit',
					'label' => 'Orang Tua Siswa',
					'rules' => 'trim|xss_clean',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'no_telp_ortu_edit',
					'label' => 'Telepon Orang Tua',
					'rules' => 'trim|xss_clean',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'Karakter harus angka tidak boleh huruf pada %s.', 'max_length' => 'Nomor Telepon terlalu panjang, Max Karakter 13!']
				],
				[
					'field' => 'alamat_ortu_edit',
					'label' => 'Alamat Orang Tua',
					'rules' => 'trim|xss_clean',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'pass_siswa',
					'label' => 'Password',
					'rules' => 'trim|xss_clean|min_length[8]',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.', 'max_length' => 'Password terlalu pendek, Minimal 8 Karakter!']
				],
				[
					'field' => 'pass_siswa_conf',
					'label' => 'Konfirmasi Password',
					'rules' => 'trim|xss_clean|min_length[8]',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.', 'max_length' => 'Password terlalu pendek, Minimal 8 Karakter!', 'matches' => 'Konfirmasi passowrd tidak sesuai!']
				],
			];

			$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE) {
				$reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
			} else {
				$this->admin->crudsiswa($typesend);
				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true
				];
			}
			echo json_encode($reponse);
		}
    }
?>

<?php 
    class DataGuru extends CI_Controller {
        
		public function __construct() {
			parent::__construct();
			$this->load->model('AdminModel', 'admin', true);
			is_admin_login();	
		}

        // Data guru admin
        public function index(){
			is_admin();
			$ParseData = [
				'title' =>	'Admin Wiyata E-Learning | Daftar Data Guru',
				'mapel' =>	$this->admin->get_datatable('tb_mapel')->result_object(),
				'kelas' =>	$this->admin->get_datatable('tb_kelas')->result_object(),
			];
            $this->load->view('admin/layouts/header', $ParseData);
            $this->load->view('admin/layouts/sidebar', $ParseData);
            $this->load->view('admin/layouts/topbar', $ParseData);
            $this->load->view('admin/data_guru/dg', $ParseData);
            $this->load->view('admin/layouts/footer', $ParseData);
        }

		# ajax halaman data guru
		// 1. Get tabel guru
		public function get_dataguru()
		{
			$draw = intval($this->input->get("draw"));
			$data = array();
			$no   = 1;
			$query = $this->admin->get_guru();
			foreach ($query->result() as $row) {

				$sub_array	= array();
				$sub_array[]	=	$no++;
				$sub_array[]	=	$row->guru_nama;
				$sub_array[]	=	$row->guru_nip;
				$sub_array[]	=	$row->mapel_nama;
				$sub_array[]	=	$row->guru_phone;
				$sub_array[]	=	date('d-m-Y', strtotime($row->created_at));

				$sub_array[]	=	'<div class="text-center"><button class="btn btn-sm btn-success mb-1 px-3 ml-2 edit-guru" data-guru-id="' . $row->id_guru . '" title="Edit Guru">Edit</button><button class="btn btn-sm btn-info mb-1 px-3 ml-2 view-guru" data-guru-id="' . $row->id_guru . '" title="View Guru">Detail</button><button class="btn btn-sm btn-danger mb-1 px-3 ml-2 hapus-guru" data-guru-id="' . $row->id_guru . '" title="Hapus Guru">Hapus</button></div> ';

				$data[] = $sub_array;
			}

			$result = array(
				'draw' 	=> $draw,
				'recordTotal' => $this->admin->get_guru()->num_rows(),
				'recordFiltered' 	=> $this->admin->get_guru()->num_rows(),
				'data' => $data
			);

			echo json_encode($result);
		}

		// 2. crud data guru
		public function crud_dataguru()
		{
			$typesend = $this->input->get('type');
			$reponse = [
				'csrfName'	=> $this->security->get_csrf_token_name(),
				'csrfHash'	=> $this->security->get_csrf_hash(),
			];
			
			// a. tambah data guru
			if ($typesend == 'addguru') {
				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => False,
					'messages' => []
				];
	
				$validation = [
					[
						'field'	=> 'nama_guru',
						'label'	=> 'Nama Guru',
						'rules' => 'trim|required|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field'	=> 'nip_guru',
						'label'	=> 'NIP',
						'rules' => 'trim|required|xss_clean|numeric',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'karakter harus angka tidak boleh huruf pada %s.']
					],
					[
						'field'	=> 'guru_mapel',
						'label'	=> 'Guru Mapel',
						'rules' => 'trim|required|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'jenis_kelamin_guru',
						'label' => 'Jenis Kelamin',
						'rules' => 'required|xss_clean|in_list[laki-laki,perempuan]',
						'errors' => ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
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
						'field' => 'agama_guru',
						'label' => 'Agama',
						'rules' => 'xss_clean|in_list[Islam, Kristen, Katolik, Hindu, Budha, Konghucu]',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'alamat_guru',
						'label' => 'Alamat',
						'rules' => 'trim|xss_clean',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'no_telp_guru',
						'label' => 'Telepon',
						'rules' => 'trim|xss_clean|numeric|max_length[13]',
						'errors' => ['xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'Karakter harus angka tidak boleh huruf pada %s.', 'max_length' => 'nomor Telepon terlalu panjang, max Karakter 13!']
					],
					[
						'field' => 'pass_guru',
						'label' => 'Password',
						'rules' => 'trim|required|xss_clean|min_length[8]',
						'errors' => ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.', 'max_length' => 'Password terlalu pendek, Minimal 8 Karakter!']
					],
				];
				$this->form_validation->set_rules($validation);
				if ($this->form_validation->run() == FALSE) {
					$reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
				} else {
					$this->admin->crudguru($typesend);
					$reponse = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => true
					];
				}
			} elseif ($typesend == 'hapusguru') { // b. hapus data guru
				$this->admin->crudguru($typesend);
				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),	
					'csrfHash' => $this->security->get_csrf_hash(),
					'message' => 'Anda telah menghapus data guru!',
					'success' => true
				];
			} elseif ($typesend == 'viewguru') { // c. lihat data guru
				$data['dataguru'] = $this->admin->get_guru_id(['id_guru' => $this->input->post('guru_id', TRUE)])->row_array();
				$data['datamapel']	=	$this->admin->get_datatable('tb_mapel')->result_array();
				$data['datakelas'] = $this->admin->getKelasByGuru(['id_guru' => $this->input->post('guru_id', TRUE)])->result_array();
				$html = $this->load->view('admin/data_guru/view_guru', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash()
				];
			} elseif ($typesend == 'updateguru') { // d. update data guru
				$guru_id	=	 $this->input->post('guru_id', TRUE);
				$data['dataguru']	= 	$this->admin->get_guru_id(['id_guru' => $guru_id])->row_array();
				$data['datakelas']	=	$this->admin->get_datatable('tb_kelas')->result_object();
				$data['datamapel']	=	$this->admin->get_datatable('tb_mapel')->result_array();
				$html = $this->load->view('admin/data_guru/edit_guru', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash()
				];
			}
			echo json_encode($reponse);
		}

		public function do_updateguru() 
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
					'field'	=> 'nama_guru_edit',
					'label'	=> 'Nama Guru',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field'	=> 'nip_guru_edit',
					'label'	=> 'NIP',
					'rules' => 'trim|required|xss_clean|numeric',
					'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.', 'numeric' => 'karakter harus angka tidak boleh huruf pada %s.']
				],
				[
					'field'	=> 'guru_mapel_edit',
					'label'	=> 'Guru Mapel',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'jenis_kelamin_guru_edit',
					'label' => 'Jenis Kelamin',
					'rules' => 'required|xss_clean|in_list[laki-laki,perempuan]',
					'errors' => ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
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
					'rules' => 'xss_clean|in_list[Islam, Kristen, Katolik, Hindu, Budha, Konghucu]',
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
				[
					'field' => 'pass_guru_edit',
					'label' => 'Password',
					'rules' => 'trim|xss_clean|min_length[8]',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.', 'max_length' => 'Password terlalu pendek, Minimal 8 Karakter!']
				],
				[
					'field' => 'pass_guru_conf',
					'label' => 'Konfirmasi Password',
					'rules' => 'trim|xss_clean|min_length[8]|matches[pass_guru_edit]',
					'errors' => ['xss_clean' => 'cek kembali pada form %s %s.', 'max_length' => 'Password terlalu pendek, Minimal 8 Karakter!', 'matches' => 'Konfirmasi passowrd tidak sesuai!']
				],
			];
			$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE) {
				$reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
			} else {
				$this->admin->crudguru($typesend);
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

<?php 
    class Dashboard extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('GuruModel', 'guru', true);
			$this->load->model('AdminModel', 'admin', true);
			$this->get_guru = $this->db->get_where('tb_guru', ['guru_nip' => 
			$this->session->userdata('nip')])->row_array();
			is_guru_login();
		}

        // Dashboard guru
        public function index(){

			is_guru();
			$guru_kelas = $this->db->get_where('tb_kelas', ['id_guru' => $this->get_guru['id_guru']])->row_array();
			$ParseData = [
				'title' => 'Guru Wiayta E-Learning | Halaman Dashboard',
				'data_guru' => $this->guru->get_gurumapel($this->get_guru['guru_nip'])->row_array(),
				'guru_kelas' => $guru_kelas,
				'getBab' => $this->guru->get_datatable('tb_bab')->result_object(),
				'pemberitahuan' => $this->guru->get_pemberitahuan($this->get_guru['id_guru'])->result_array()

			];

            $this->load->view('guru/layouts/header', $ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData);
            $this->load->view('guru/dashboard', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
        }

		public function get_tabelpemberitahuan()
		{
			$draw = intval($this->input->get("draw"));
			$data = array();
			$no   = 1;
			$query = $this->guru->get_pemberitahuan($this->get_guru['id_guru']);
			foreach ($query->result() as $row) {
				$sub_array	= array();
				$sub_array[]	=	$no++;
				$sub_array[]	=	$row->kelas_nama;
				$sub_array[]	=	'BAB '. $row->bab_ke;
				$sub_array[]	=	'Bahasa Indonesia';
				$sub_array[]	=	$row->pemberitahuan;
				$sub_array[]	=	$row->link_pemberitahuan;
				$sub_array[]	=	date('d-m-Y', strtotime($row->dibuat_pada));
				$sub_array[]	=	date('d-m-Y', strtotime($row->diubah_pada));
				$sub_array[]	=	'<div class="text-center row pl-2"><button class="btn btn-sm btnGreen mr-2 mb-3 pr-3 pl-3 edit-pemberitahuan" data-pemberitahuan-id="' . $row->id_pemberitahuan . '" title="Edit pemberitahuan">Edit</button><button class="btn btn-sm btn-danger mb-3 pr-3 pl-3 hapus-pemberitahuan" data-pemberitahuan-id="' . $row->id_pemberitahuan . '" title="Hapus pemberitahuan">Hapus</button></div>';

				$data[] = $sub_array;
			}
	
			$result = array(
				'draw' 	=> $draw,
				'recordTotal' => $query->num_rows(),
				'recordFiltered' 	=> $query->num_rows(),
				'data' => $data
			);

			echo json_encode($result);
		}

		public function crud_pemberitahuan()
		{
			$typesend = $this->input->get('type');
			$response = [
				'csrfName'	=> $this->security->get_csrf_token_name(),
				'csrfHash'	=> $this->security->get_csrf_hash(),
			];

			if($typesend == 'tambah') {
				$response = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => False,
					'messages' => []
				];

				$validation = [
					[
						'field'	=> 'kelas[]',
						'label'	=> 'Kelas',
						'rules' => 'trim|required|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field'	=> 'bab',
						'label'	=> 'BAB',
						'rules' => 'trim|required|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field'	=> 'pemberitahuan',
						'label'	=> 'Pemberitahuan',
						'rules' => 'trim|required|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field'	=> 'link_pemberitahuan',
						'label'	=> 'Link Pemberitahuan',
						'rules' => 'trim|xss_clean',
						'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.']
					],
				];
				$this->form_validation->set_rules($validation);
				if ($this->form_validation->run() == FALSE) {
					$response['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
				} else {
					$this->guru->crud_pemberitahuan($typesend);
					$response = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => true
					];
				}
			} elseif ($typesend == 'update') {
				$id_pemberitahuan = $this->input->post('id_pemberitahuan', true);
				$data['pemberitahuan'] = $this->guru->get_pemberitahuanID(['id_pemberitahuan' => $id_pemberitahuan])->row_object();
				$data['getBab'] = $this->guru->get_datatable('tb_bab')->result_object();
				$html = $this->load->view('guru/edit_pemberitahuan', $data);
				$response = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash()
				];

			} elseif ($typesend == 'hapus') {
				$this->guru->crud_pemberitahuan($typesend);
				$response = [
					'csrfName' => $this->security->get_csrf_token_name(),	
					'csrfHash' => $this->security->get_csrf_hash(),
					'message' => 'Anda telah menghapus pemberitahuan!',
					'success' => true
				];
			}
			echo json_encode($response);
		}

		public function update_pemberitahuan() {
			$typesend = $this->input->get('type');
			$response = [
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
				'success' => False,
				'messages' => []
			];

			$validation = [
				[
					'field'	=> 'kelas_edit',
					'label'	=> 'Kelas',
					'rules' => 'trim|xss_clean',
					'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field'	=> 'bab_edit',
					'label'	=> 'BAB',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field'	=> 'pemberitahuan_edit',
					'label'	=> 'Pemberitahuan',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field'	=> 'link_pemberitahuan_edit',
					'label'	=> 'Link Pemberitahuan',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
				],
			];
				$this->form_validation->set_rules($validation);
				if ($this->form_validation->run() == FALSE) {
					$response['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
				} else {
					$this->guru->crud_pemberitahuan($typesend);
					$response = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => true
					];
			}
			echo json_encode($response);
		}

		// Data Siswa
		public function data_siswa($class = null) {
			is_guru();
			$class = $this->secure->decrypt_url($class);
			$dataSiswa = $this->guru->getAllStudent($class);
			
			$ParseData = [
				'title' => 'Guru Wiayta E-Learning | Halaman Daftar Siswa',
				'data_guru' => $this->guru->get_gurumapel($this->get_guru['guru_nip'])->row_array(),
				'kelas'	=> $this->guru->getKelasByGuru($this->get_guru['id_guru']),
				'class' => $class,
				'dataSiswa'	=> $dataSiswa
			];

			$this->load->view('guru/layouts/header',$ParseData);
            $this->load->view('guru/layouts/sidebar',$ParseData);
            $this->load->view('guru/layouts/topbar',$ParseData);
            $this->load->view('guru/data_siswa/ds',$ParseData);
            $this->load->view('guru/layouts/footer',$ParseData);
		}

		public function detail_siswa() {
			$typesend = $this->input->get('type');
			$response = [
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
			];
			if($typesend == 'view') {
				$data['datasiswa'] = $this->admin->get_siswa(['id_siswa' => $this->input->post('id_siswa', TRUE)])->row_object();
				$html = $this->load->view('admin/data_siswa/view_siswa', $data);
				$response = [
						'html' => $html,
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash()
				];
			}

			echo json_encode($response);
		}
    }
?>

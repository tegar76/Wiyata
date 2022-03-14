<?php 
    class DataMateri extends CI_Controller {
        
        public function __construct() {
			parent::__construct();
			$this->load->model('AdminModel', 'admin', true);
			is_admin_login();	
		}
		
		// Data materi
        public function bahanAjar(){
			$ParseData = [
				'title' =>	'Admin Wiyata E-Learning | Daftar Bahan Ajar',
				'mapel' =>	$this->admin->get_datatable('tb_mapel')->result_object(),
				'kelas' =>	$this->admin->get_datatable('tb_kelas')->result_object(),
			];
            $this->load->view('admin/layouts/header', $ParseData);
            $this->load->view('admin/layouts/sidebar', $ParseData);
            $this->load->view('admin/layouts/topbar', $ParseData);
            $this->load->view('admin/data_materi/bahan_ajar', $ParseData);
            $this->load->view('admin/layouts/footer', $ParseData);
        }


        // Bahan Ajar Unit 1
        public function unitBab($id_unit){
			$id_unit_bab = $this->secure->decrypt_url($id_unit); 
			$ParseData = [
				'title' => 'Materi Unit',
				'unitMateri' => $this->admin->getUnitByID(['id_unit_bab' => $id_unit_bab])->row_object()
			];
            $this->load->view('admin/data_materi/unit', $ParseData);
        }


        // Bahan Ajar Rangkuman
        public function rangkumanBab($id_bab){
			$rangkuman_bab = $this->secure->decrypt_url($id_bab); 
			$ParseData = [
				'title' => 'Materi Unit',
				'rangkuman' => $this->db->get_where('tb_bab', ['id_bab' => $rangkuman_bab])->row_object()
			];
            $this->load->view('admin/data_materi/rangkuman', $ParseData);
        }

        // Bahan Ajar Video Pembelajaran
        public function latihanTugas(){
		
            $ParseData = [
				'title' =>	'Admin Wiyata E-Learning | Daftar Bahan Ajar',
				'dataMateri' => $this->admin->get_datatable('tb_bab')->result_object(),
			];
            $this->load->view('admin/layouts/header', $ParseData);
            $this->load->view('admin/layouts/sidebar',  $ParseData);
            $this->load->view('admin/layouts/topbar',  $ParseData);
            $this->load->view('admin/data_materi/latihan_tugas',  $ParseData);
            $this->load->view('admin/layouts/footer',  $ParseData);
        }

		
        // Bahan Ajar latihan 1
        public function latihan($id_tugas){
			$latihan_tugas = $this->secure->decrypt_url($id_tugas);
			$ParseData = [
				'title' => 'Latihan Tugas',
				'latihanTugas' => $this->admin->getLatihanbyID(['id_tugas' => $latihan_tugas])->row_object()
			];
            $this->load->view('admin/data_materi/latihan', $ParseData);
        }
		
		// Bahan Ajar Video Pembelajaran
		public function videoPembelajaran(){
			$ParseData = [
				'title' => 'Admin Wiyata E-Learning | Video Pembelajaran',
				'video' => $this->admin->get_videoBAB()->result_object(),
				'getBab' =>	$this->admin->get_datatable('tb_bab')->result_object(),
			];

			$this->load->view('admin/layouts/header',$ParseData);
			$this->load->view('admin/layouts/sidebar', $ParseData);
			$this->load->view('admin/layouts/topbar', $ParseData);
			$this->load->view('admin/data_materi/video_pembelajaran', $ParseData);
			$this->load->view('admin/layouts/footer', $ParseData);
		}


		// tabel bahan ajar 
		public function get_datatable() {
			$datatable = $this->input->get('type');
			$draw = intval($this->input->get("draw"));
			$data = array();
			$no   = 1;
			if ($datatable == 'tb_bahanajar') {
				$query = $this->admin->get_datatable('tb_bab');
				foreach($query->result() as $row) {
					$sub_array	= array();
					$sub_array[]	=	$no++;
					$sub_array[]	=	'BAB ' . $row->bab_ke;
					$sub_array[]	=	$row->bab_judul;
					$unit_bab 		= $this->admin->getUnitByBAB($row->id_bab)->result_array();
					$sub_array[]	=	'<div class="text-center"><a target="blank" href="'. base_url('Admin/DataMateri/unitbab/' . $this->secure->encrypt_url($unit_bab[0]['id_unit_bab'])). '"><img src="'. base_url('assets/guru/icons/pdficon.png') .'"width="25px" class="ml-2"></a></div>';
					$sub_array[]	=	'<div class="text-center"><a target="blank" href="'. base_url('Admin/DataMateri/unitbab/' . $this->secure->encrypt_url($unit_bab[1]['id_unit_bab'])). '"><img src="'. base_url('assets/guru/icons/pdficon.png') .'"width="25px" class="ml-2"></a></div>';
					$sub_array[]	=	'<div class="text-center"><a target="blank" href="'. base_url('Admin/DataMateri/rangkumanbab/' . $this->secure->encrypt_url($row->id_bab)).'"><img src="'. base_url('assets/guru/icons/pdficon.png').'" width="25px" class="ml-2"></a></div>';
					$sub_array[]	=  	date('d-m-Y', strtotime($row->created_at));
					$sub_array[]	= 	($row->update_at == '2022-01-01') ? ' - ' : date('d-m-Y', strtotime($row->update_at));
					$sub_array[]	= 	'<div class="text-center"><button class="btn btn-sm btn-success mb-1 px-3 ml-2 edit-bab" data-bab-id="'. $row->id_bab.'" title="Edit Bab">Edit</button><button class="btn btn-sm btn-danger mb-1 px-3 ml-2 hapus-bab" data-bab-id="'. $row->id_bab .'" title="Hapus Bab">Hapus</button></div>';

					$data[] = $sub_array;
				}
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $query->num_rows(),
					'recordFiltered' 	=> $query->num_rows(),
					'data' => $data
				);
			} elseif ($datatable == 'tb_video') {
				$query_video = $this->admin->get_videoBAB();
				foreach($query_video->result() as $row) {
					$sub_array	= array();
					$sub_array[]	=	$no++;
					$sub_array[]	=	'BAB ' . $row->bab_ke;
					$sub_array[]	=	$row->judul_video;
					$sub_array[]	=	'<div class="embed-responsive embed-responsive-16by9"><iframe class="youtube-video" src="' . $row->link_video .'" allowfullscreen></iframe></div>';
					$sub_array[]	=	'<div class="text-center">'. (!empty($row->dibuat_pada)) ? date('d-m-Y', strtotime($row->dibuat_pada)) : '-'   .'</div>';
					$sub_array[]	=	'<div class="text-center">'. (empty($row->diubah_pada)) ? '-' : (($row->diubah_pada == '0000-00-00') ? '-' : date('d-m-Y', strtotime($row->diubah_pada))) .'</div>';
					$sub_array[]	=	'<div class="text-center"><button class="btn btn-sm btn-success mb-1 px-3 ml-2 edit-video" data-video-id="'. $row->id_video.'" title="Edit Video">Edit</button><button class="btn btn-sm btn-danger mb-1 px-3 ml-2 hapus-video" data-video-id="'. $row->id_video .'" title="hapus Video">Hapus</button></div>';
					$data[] = $sub_array;
				}
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $query_video->num_rows(),
					'recordFiltered' 	=> $query_video->num_rows(),
					'data' => $data
				);
			}

			echo json_encode($result);
		}

		// CRUD Bahan bahan_ajar
		public function crud_bahanajar() {
			$typesend = $this->input->get('type');
			$reponse = [
				'csrfName'	=> $this->security->get_csrf_token_name(),
				'csrfHash'	=> $this->security->get_csrf_hash(),
			];

			if ($typesend == 'tambah') {
				$reponse = [
    				'csrfName' => $this->security->get_csrf_token_name(),
    				'csrfHash' => $this->security->get_csrf_hash(),
    				'success' => False,
    				'messages' => []
			    ];

    			$this->form_validation->set_rules('mapel_bab', 'Mata Pelajaran', 'trim|required|xss_clean', [
    				'required' => '{field} harus diisi!',
    				'xss_clean' => 'cek kembali pada form {field}'
    			]);
    			$this->form_validation->set_rules('judul_bab', 'Judul Bab', 'trim|required|xss_clean', [
    				'required' => '{field} harus diisi!',
    				'xss_clean' => 'cek kembali pada form {field}'
    			]);
    			$this->form_validation->set_rules('bab_ke', 'BAB KE-', 'trim|required|xss_clean', [
    				'required' => '{field} harus diisi!',
    				'xss_clean' => 'cek kembali pada form {field}'
    			]);
    			$this->form_validation->set_rules('unit_bab[]', 'Unit Materi', 'callback_unit_check');
    			$this->form_validation->set_rules('rangkuman_bab', 'Rangkuman BAB', 'callback_rangkuman_check');
    			$this->form_validation->set_rules('latihan_bab[]', 'Latihan Tugas', 'callback_latihan_check');
    			$this->form_validation->set_rules('deskripsi_latihan[]', 'Deskripsi Latihan', 'trim|required|xss_clean', [
    				'required' => '{field} harus diisi!',
    				'xss_clean' => 'cek kembali pada form {field}'
    			]);
    			if ($this->form_validation->run() == false) {
    				$reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
    			} else {
    				$bab = $this->input->post('bab_ke');
    				$query = $this->db->get_where('tb_bab', ['bab_ke' => $bab])->row_array();
    				if (!empty($query)) {
    					$reponse = [
    						'csrfName' => $this->security->get_csrf_token_name(),
    						'csrfHash' => $this->security->get_csrf_hash(),
    						'success' => false,
    						'messages' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    											Bahan Ajar BAB ' . $bab . ' <strong>Sudah Tersedia</strong>
    											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    							 	 				<span aria-hidden="true">&times;</span>
    											</button>
    										</div>'
    					];
    				} else {
    					$this->admin->crudBahanAjar($typesend);
    					$reponse = [
    						'csrfName' => $this->security->get_csrf_token_name(),
    						'csrfHash' => $this->security->get_csrf_hash(),
    						'success' => true,
    						'messages' => 'belum tersedia'
    					];
    				}
    			}
			} elseif ($typesend == 'update') {
				$id_bab = $this->input->post('id_bab', true);
				$data = [
					'data_bab' => $this->admin->get_datatable('tb_bab')->result_array(),
					'bahan_ajar' => $this->db->get_where('tb_bab', ['id_bab' => $id_bab])->row_array(),
				];
				$html = $this->load->view('admin/data_materi/edit_bahanajar', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash()
				];
			} elseif ($typesend == 'hapus') {
				$this->admin->crudBahanAjar($typesend);
				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'message' => 'Anda telah menghapus materi bahan ajar!',
					'success' => true
				];
			}

			echo json_encode($reponse);
		}
		
		public function do_update_bahanajar()
    	{
    		$typesend = $this->input->get('type');
    		$reponse = [
    			'csrfName'	=> $this->security->get_csrf_token_name(),
    			'csrfHash'	=> $this->security->get_csrf_hash(),
    		];
    
    		if ($typesend == 'update') {
    			$reponse = [
    				'csrfName' => $this->security->get_csrf_token_name(),
    				'csrfHash' => $this->security->get_csrf_hash(),
    				'success' => False,
    				'messages' => []
    			];
    
    			$this->form_validation->set_rules('judul_bab_edit', 'Judul Bab', 'trim|required|xss_clean', [
    				'required' => '{field} harus diisi!',
    				'xss_clean' => 'cek kembali pada form {field}'
    			]);
    			// $this->form_validation->set_rules('deskripsi_latihan[]', 'Deskripsi Latihan', 'trim|required|xss_clean', [
    			// 	'required' => '{field} harus diisi!',
    			// 	'xss_clean' => 'cek kembali pada form {field}'
    			// ]);
    			if ($this->form_validation->run() == false) {
    				$reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
    			} else {
    				$this->admin->crudBahanAjar($typesend);
    				$reponse = [
    					'csrfName' => $this->security->get_csrf_token_name(),
    					'csrfHash' => $this->security->get_csrf_hash(),
    					'success' => true,
    					'messages' => 'belum tersedia'
    				];
    			}
    		}
    		echo json_encode($reponse);
    	}
        
        public function rangkuman_check()
    	{
    		if (empty($_FILES['rangkuman_bab']['name'])) {
    			$this->form_validation->set_message('rangkuman_check', '{field} harus upload file!');
    			return false;
    		}
    		return true;
    	}

    	public function latihan_check()
    	{
    		if (empty($_FILES['latihan_bab']['name'])) {
    			$this->form_validation->set_message('latihan_check', '{field} harus upload file!');
    			return false;
    		}
    		return true;
    	}

    	public function unit_check()
    	{
    		if (empty($_FILES['unit_bab']['name'])) {
    			$this->form_validation->set_message('unit_check', '{field} harus upload file!');
    			return false;
    		}
    		return true;
    	}
        
		public function crud_datavideo() {
			$typesend = $this->input->get('type');
			$reponse = [
				'csrfName'	=> $this->security->get_csrf_token_name(),
				'csrfHash'	=> $this->security->get_csrf_hash(),
			];
			if($typesend == 'tambah_video') {
				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => False,
					'messages' => []
				];
				$validation = [
					[
						'field'	=> 'judul_video',
						'label'	=> 'Judul Video',
						'rules' => 'trim|required|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field'	=> 'video_bab',
						'label'	=> 'BAB',
						'rules' => 'trim|required|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'link_video',
						'label' => 'Link Video',
						'rules' => 'trim|required|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
				];
				$this->form_validation->set_rules($validation);
				if ($this->form_validation->run() == FALSE) {
					$reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
				} else {
					$this->admin->crud_video($typesend);
					$reponse = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => true
					];
				}
			} elseif($typesend == 'update') {
				$id_video = $this->input->post('id_video', true);
				$data['video'] = $this->admin->get_videoID(['id_video' => $id_video])->row_array();
				$html = $this->load->view('admin/data_materi/edit_video', $data);
				$reponse = [
					'html' => $html,
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash()
				];
			} elseif($typesend == 'hapus_video') {
				$this->admin->crud_video($typesend);
				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'message' => 'Anda telah menghapus video pembelajaran!',
					'success' => true
				];
			}
			echo json_encode($reponse);
		}

		public function do_updatevideo() {
			$typesend = $this->input->get('type');
			$reponse = [
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
				'success' => False,
				'messages' => []
			];
			$validation = [
				[
					'field'	=> 'judul_video_edit',
					'label'	=> 'Judul Video',
					'rules' => 'trim|xss_clean',
					'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.']
				],
				[
					'field' => 'link_video_edit',
					'label' => 'Link Video',
					'rules' => 'trim|xss_clean',
					'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.']
				],
			];
			$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE) {
				$reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
			} else {
				$this->admin->crud_video($typesend);
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

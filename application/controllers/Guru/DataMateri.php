<?php 
    class DataMateri extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('GuruModel', 'guru', true);
			$this->load->model('AdminModel', 'admin', true);
			$this->get_guru = $this->db->get_where('tb_guru', ['guru_nip' => 
			$this->session->userdata('nip')])->row_array();
			is_guru_login();
		}

        // Bahan Ajar
        public function index(){

			is_guru();
			$dataGuru = $this->get_guru;
			$ParseData = [
				'title' => 'Guru Wiayta E-Learning | Profile Guru' . $dataGuru['guru_nama'],
				'data_guru' => $dataGuru,
				'data_materi' => $this->admin->get_datatable('tb_bab')->result_object(),
			];

            $this->load->view('guru/layouts/header', $ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData);
            $this->load->view('guru/data_materi/bahan_ajar', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
        }

        // Bahan Ajar Unit 1
        public function unitbab($id_unit)
		{
			$id_unit_bab = $this->secure->decrypt_url($id_unit); 
			$ParseData = [
				'title' => 'Materi Unit',
				'unitMateri' => $this->admin->getUnitByID(['id_unit_bab' => $id_unit_bab])->row_object()
			];
            $this->load->view('guru/data_materi/unit1', $ParseData);
        }

        // Bahan Ajar Rangkuman
        public function rangkuman($id_bab)
		{
			$rangkuman_bab = $this->secure->decrypt_url($id_bab); 
			$ParseData = [
				'title' => 'Materi Unit',
				'rangkuman' => $this->db->get_where('tb_bab', ['id_bab' => $rangkuman_bab])->row_object()
			];
            $this->load->view('guru/data_materi/rangkuman', $ParseData);
        }

        // Bahan Ajar Video Pembelajaran
        public function videoPembelajaran(){

			is_guru();
			$dataGuru = $this->get_guru;
			$ParseData = [
				'title' => 'Admin Wiyata E-Learning | Video Pembelajaran',
				'data_guru' => $dataGuru,
				'video' => $this->admin->get_videoBAB()->result_object(),
				'getBab' =>	$this->admin->get_datatable('tb_bab')->result_object(),
			];

            $this->load->view('guru/layouts/header',$ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData );
            $this->load->view('guru/data_materi/video_pembelajaran', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
        }
		public function get_tablevideo(){
            $draw = intval($this->input->get("draw"));
            $data = array();
            $no   = 1;
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
			
			echo json_encode($result);
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
					$this->guru->crud_video($typesend);
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
				$this->guru->crud_video($typesend);
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
				$this->guru->crud_video($typesend);
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

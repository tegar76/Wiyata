<?php 
    class Home extends CI_Controller {
        
        public function __construct() {
			parent::__construct();
			$this->load->model('AdminModel', 'admin', true);
		}
		
		public function index(){
			$ParseData = [
				'title' => 	'Wiyata E-Learning - Pembelajaran Mata Pelajaran Bahasa Indonesia'
			];
            $this->load->view('v_home', $ParseData);
        }

		// CRUD Pesan Aduan
		public function crud_pesan_aduan()
		{
			$typesend = $this->input->get('type');
			$reponse = [
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
			];
	
			if ($typesend == 'addpesan') {
				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => false,
					'messages' => []
				];
	
				$validation = [
					[
						'field' => 'nama_user',
						'label' => 'Nama',
						'rules' => 'trim|required|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'subject_name',
						'label' => 'Nama Subjek',
						'rules' => 'trim|required|xss_clean',
						'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					],
					[
						'field' => 'message',
						'label' => 'Keterangan Pesan Aduan',
						'rules' => 'trim|required|xss_clean',
						'errors' => ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
					]
				];
				$this->form_validation->set_rules($validation);
				if ($this->form_validation->run() == false) {
					$reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
				} else {
					$this->admin->crudPesanAduan($typesend);
					$reponse = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => true
					];
				}
			} elseif ($typesend == 'deletepesan') {
	
				$this->admin->crudPesanAduan($typesend);
				$reponse = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'message' => 'Anda telah menghapus data pesan!',
					'success' => true
				];
			}
	
			echo json_encode($reponse);
		}
		
		public function unduh_panduan()
    	{
    		$this->load->helper('download');
    		$path_tugas = './storage/panduan-penggunaan-wiyata.pdf';
    		force_download($path_tugas, NULL);
    	}
    }
?>

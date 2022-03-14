<?php 
    class Diskusi extends CI_Controller {
        
        public function __construct()
		{
			parent::__construct();
			$this->load->model('SiswaModel', 'siswa', true);
			$this->userSiswa = $this->db->get_where('tb_siswa', ['siswa_nis' => $this->session->userdata('nis')])->row_array();
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

		public function index($id = null) {
            is_siswa();
			$siswa = $this->userSiswa;
			$id = $this->secure->decrypt_url($id);
			$where = array(
				'diskusi.id_bab' => $id,
				'id_kelas' => $siswa['id_kelas']
			);
			$ParseData = [
				'title' => 'Wiyata E-Learning - Ruang Materi',
				'materi' => $this->siswa->get_materibab(),
				'user_siswa' => $this->siswa->get_datasiswa($siswa['siswa_nis'])->row(),
				'get_bab' => $this->db->get_where('tb_bab', ['id_bab' => $id])->row_array(),
				'diskusi' => $this->siswa->get_diskusi($where, 'id_info', 'DESC')->result()
			];

            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar', $ParseData);
            $this->load->view('siswa/ruang_diskusi/rd', $ParseData);
            $this->load->view('siswa/layouts/footer', $ParseData);
        }

        public function forum_diskusi($id_forum) {
			is_siswa();
			$siswa = $this->userSiswa;
			$id_forum = $this->secure->decrypt_url($id_forum);
            $ParseData = [
				'title' => 'Wiyata E-Learning - Ruang Materi',
				'materi' => $this->siswa->get_materibab(),
				'user_siswa' => $this->siswa->get_datasiswa($siswa['siswa_nis'])->row(),
				'diskusi' => $this->siswa->get_diskusi(['diskusi.id_info' => $id_forum], 'id_info', 'DESC')->row()
			];

			$this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar', $ParseData);
            $this->load->view('siswa/ruang_diskusi/rd_detail', $ParseData);
            $this->load->view('siswa/layouts/footer', $ParseData);
        }

		public function submit_forum() {
			$id_bab = $this->input->post('id_bab');
			$validation = [
				[
					'field'	=> 'judul_diskusi',
					'Label'	=> 'Judul Diskusi',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'You must provide a %s.', 'xss_clean' => 'Please check your form on %s.']
				],
				[
					'field'	=> 'deskripsi_diskusi',
					'Label'	=> 'Deskripsi Diskusi',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'You must provide a %s.', 'xss_clean' => 'Please check your form on %s.']
				]
			];
			$this->form_validation->set_rules($validation);
			if($this->form_validation->run() == FALSE) {
				$this->message('Ada Kesalahan Saat Tambah Forum Diskusi', 'cek kembali pada form tambah diskusi baru' , 'error');
				redirect('ruang_diskusi/Diskusi/index/' .$this->secure->encrypt_url($id_bab));
			} else {
				$this->siswa->input_forum();
				$this->message('Forum Diskusi Berhasil Dibuat', 'Silahkan memulai diskusi sesuai materi yang diajar', 'success');
				redirect('ruang_diskusi/Diskusi/index/' .$this->secure->encrypt_url($id_bab));
			}
		}


		public function submit_diskusi()
		{
			$reponse = [
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
				'success' => False,
				'messages' => []
			];
	
			$validation = [
				[
					'field'	=> 'diskusi',
					'Label'	=> 'Diskusi',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'You must provide a %s.', 'xss_clean' => 'Please check your form on %s.']
				],
			];

			$this->form_validation->set_rules($validation);
			if( $this->form_validation->run() == FALSE ) {
				$reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
			} else {
				$this->siswa->insert_diskusi();
					$reponse = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => true
					];
			}
			echo json_encode($reponse);
		}

		public function get_komentar() {
			$output='';
			$id_forum = $this->input->post('id_info', true);
			$where_diskusi = array(
				'parent_diskusi_id' => '0',
				'id_info' => $id_forum,
			);
			$query 	= $this->db->order_by('diskusi_id', 'DESC')->get_where('tb_diskusi', $where_diskusi);
			$result	= $query->result();

			foreach($result as $key => $val) {
				$foto_siswa = $this->siswa->get_fotosiswa($val->id_user)->row();
				$foto_guru	= $this->siswa->get_fotoguru($val->id_user)->row();
				if($foto_siswa) {
					if($foto_siswa->siswa_image == 'default.png' ) {
						$foto = 'assets/siswa/img/UserDefault.png';
					} else {
						$foto = '/storage/siswa/profile/' . $foto_siswa->siswa_image;
					}
				} elseif($foto_guru) {
					if($foto_guru->guru_image == 'default.png' ) {
						$foto = 'assets/siswa/img/UserDefault.png';
					} else {
						$foto = '/storage/guru/profile/' . $foto_guru->guru_image;
					}
				} else {
					$foto = 'assets/siswa/img/UserDefault.png';
				}

				$output .= '
				<div class="media border p-3 mb-2">
					<img src="'. base_url($foto) .'" alt="foto-user" class="mr-3 mt-6 rounded-circle" style="width:40px;">
					<div class="media-body">
						<div class="row">
							<div class="col-sm-10">
								<h6><b class="font-weight-bold">'. $val->nama_user .'</b><small class="text-info"> Posted on <i>'. $val->tanggal .'</i></small></h6>
								<p>'. $val->diskusi .'</p>
							</div>
							<div class="col-sm-2" align="right">
								<button type="button" class="btn btn-sm btn-info reply" id-forum="'. $val->diskusi_id .'">Balas</button>
							</div>
						</div>
					</div>
				</div> ';
			  $output .= $this->ambil_reply($val->diskusi_id);
			}
	
			echo json_encode([$output]);
	
		}

		public function ambil_reply($parent_id = 0, $marginleft = 0) {
			$output='';
			$where_diskusi = array(
				'diskusi.parent_diskusi_id' => $parent_id
			);
			$query 	= $this->siswa->diskusi_forum($where_diskusi, 'parent_diskusi_id', 'DESC');
			$result	= $query->result();
	
			$count = $query->num_rows();
			  if($parent_id == 0) {
				$marginleft = 0;
			} else {
				$marginleft = $marginleft + 48;
			}
	
			$tingkat = $marginleft/48+1;
			if ($count > 0) {
				foreach ($query->result() as $key => $val) {
					$foto_siswa = $this->siswa->get_fotosiswa($val->id_user)->row();
					$foto_guru	= $this->siswa->get_fotoguru($val->id_user)->row();
					if($foto_siswa) {
						if($foto_siswa->siswa_image == 'default.png' ) {
							$foto = 'assets/siswa/img/UserDefault.png';
						} else {
							$foto = '/storage/siswa/profile/' . $foto_siswa->siswa_image;
						}
					} elseif($foto_guru) {
						if($foto_guru->guru_image == 'default.png' ) {
							$foto = 'assets/siswa/img/UserDefault.png';
						} else {
							$foto = '/storage/guru/profile/' . $foto_guru->guru_image;
						}
					} else {
						$foto = 'assets/siswa/img/UserDefault.png';
					}

					$output .= '
					<div class="media border rounded-lg p-3 mb-2" style="margin-left:'.$marginleft.'px">
						<img src="'. base_url($foto) .'" alt="foto-user" class="mr-3 mt-6 rounded-circle" style="width:40px;">
						<div class="media-body">
							<div class="row">
								<div class="col-sm-10">
									<h6><b class="font-weight-bold">'. $val->nama_user .'</b><small class="text-info"> Posted on <i>'. $val->tanggal .'</i></small></h6>
									<p>'. $val->diskusi .'</p>
								</div>
					';
			
					if($tingkat < 2){
						$output .= '
					  		<div class="col-sm-2" align="right">
					  			<button class="btn btn-sm btn-info reply" id-forum="'. $val->diskusi_id .'">Balas</button>
				  			</div>';
					}
			
					$output .= '    
							</div>
						</div>
					</div>';
				 $output .= $this->ambil_reply($val->diskusi_id, $marginleft);
				
				}
			}
			return $output;
		}

    }

?>

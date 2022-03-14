<?php 
    class RuangDiskusi extends CI_Controller {
        
		public function __construct() {
			parent::__construct();
			$this->load->model('GuruModel', 'guru', true);
			$this->load->model('AdminModel', 'admin', true);
			$this->load->model('SiswaModel', 'siswa', true);
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

        // Ruang Diskusi
        public function index(){
            is_guru();
			$guru = $this->get_guru;
			$ParseData = [
				'title' => 'Guru Wiayta E-Learning | Ruang Diskusi',
				'data_guru' => $this->guru->get_gurumapel($guru['guru_nip'])->row_array(),
				'getBab' 	=>	$this->guru->get_datatable('tb_bab')->result_object(),
                'getkelas' 	=>	$this->db->get_where('tb_kelas', ['id_guru' => $this->get_guru['id_guru']])->result(),
			];

            $this->load->view('guru/layouts/header',$ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData);
            $this->load->view('guru/ruang_diskusi/cek_rd', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
        }

		public function cek_diskusi() {
			$bab 	= $this->input->post('bab', true);
			$kelas 	= $this->input->post('kelas', true);
			$validation = [
				[
					'field'	=> 'kelas',
					'Label'	=> 'Kelas Siswa',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'You must provide a %s.', 'xss_clean' => 'Please check your form on %s.']
				],
				[
					'field'	=> 'bab',
					'Label'	=> 'Bab Materi',
					'rules' => 'trim|required|xss_clean',
					'error'	=> ['required' => 'You must provide a %s.', 'xss_clean' => 'Please check your form on %s.']
				]
			];
			$this->form_validation->set_rules($validation);
			if($this->form_validation->run() == FALSE) {
				$this->message('Ada Kesalahan Saat Cek Forum Diskusi', 'cek kembali pada form tambah diskusi baru' , 'error');
				redirect('Guru/RuangDiskusi/index/');
			} else {
				redirect('Guru/RuangDiskusi/cekRuangDiskusi/'.$bab. '/'. $kelas);
				$this->message('Forum Diskusi Tersedia', 'Silahkan memulai diskusi sesuai materi yang diajar', 'success');
			}
			
		}

		public function submit_forum() {
			$kelas = $this->input->post('id_kelas');
			$nama_kelas = $this->db->select('kelas_nama')->from('tb_kelas')->where(['id_kelas' => $kelas])->get()->row_array();
			$bab = $this->input->post('id_bab');
			$bab_ke = $this->db->select('bab_ke')->from('tb_bab')->where(['id_bab' => $bab])->get()->row_array();
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
				redirect('Guru/RuangDiskusi/cekRuangDiskusi/'. $bab_ke['bab_ke'] . '/' . $nama_kelas['kelas_nama']);
			} else {
				$this->guru->input_forum();
				$this->message('Forum Diskusi Berhasil Dibuat', 'Silahkan memulai diskusi sesuai materi yang diajar', 'success');
				redirect('Guru/RuangDiskusi/cekRuangDiskusi/'. $bab_ke['bab_ke'] . '/' . $nama_kelas['kelas_nama']);
			}
		}

        // Ruang Diskusi
        public function cekRuangDiskusi($bab = null, $kelas = null){
            is_guru();
			$guru = $this->get_guru;
			$bab_ 	= $bab;
			$kelas_ = $kelas;
			
			$kelas 	= $this->db->get_where('tb_kelas', ['kelas_nama' => $kelas_])->row_array();
			$bab 	= $this->db->get_where('tb_bab', ['bab_ke' => $bab_])->row_array();

			if(!empty($kelas) AND !empty($bab)) {
				$where	= array(
					'diskusi.id_bab' => $bab['id_bab'],
					'diskusi.id_kelas' => $kelas['id_kelas']
				);
				$diskusi = $this->guru->get_diskusi($where, 'id_info', 'DESC')->result();
			} else {
				$diskusi = null;
			}
			
			$ParseData = [
				'title' => 'Guru Wiayta E-Learning | Ruang Diskusi',
				'data_guru' => $guru,
				'diskusi' => $diskusi,
				'kelas' => $kelas,
				'get_bab' => $bab
			];

			$this->load->view('guru/layouts/header',$ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData);
            $this->load->view('guru/ruang_diskusi/rd', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
        }

        // Ruang Diskusi
        public function ruangDiskusiDetail($id){
			is_guru();
			$guru = $this->get_guru;
			$id 	= $this->secure->decrypt_url($id);
			$forum	= $this->db->get_where('tb_info_diskusi', ['id_info' => $id])->row_array();
			$get_kelas	= $this->db->get_where('tb_kelas', ['id_kelas' => $forum['id_kelas']])->row_array();
			$get_bab	= $this->db->get_where('tb_bab', ['id_bab' => $forum['id_bab']])->row_array();
			$ParseData = [
				'title' => 'Guru Wiayta E-Learning | Ruang Diskusi',
				'data_guru' => $guru,
				'forum_diskusi' => $forum,
				'kelas' => $get_kelas,
				'bab' => $get_bab,
				'diskusi' => $this->siswa->get_diskusi(['diskusi.id_info' => $id], 'id_info', 'DESC')->row()
			];

			$this->load->view('guru/layouts/header',$ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData);
            $this->load->view('guru/ruang_diskusi/rd_detail', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
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

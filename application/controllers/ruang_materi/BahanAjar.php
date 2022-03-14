<?php 
    class BahanAjar extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('SiswaModel', 'siswa', true);
			$this->userSiswa = $this->db->get_where('tb_siswa', ['siswa_nis' => $this->session->userdata('nis')])->row_array();
			is_siswa_login();

		}

        public function unit_materi($id_unit) {
			is_siswa();
			$id_unit_bab = $this->secure->decrypt_url($id_unit);
			$ParseData = [
				'title' => 'Wiyata E-Learning | Unit Materi',
				'get_unit' => $this->siswa->getUnitById(['tb_unit_bab.id_unit_bab' => $id_unit_bab])->row_object()
			];
            
            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar', $ParseData);
            $this->load->view('siswa/bahan_ajar/unit1', $ParseData);
            $this->load->view('siswa/layouts/footer', $ParseData);
        }

        public function rangkuman_bab($id_bab) {
			is_siswa();
			$rangkuman_id = $this->secure->decrypt_url($id_bab);
			$ParseData = [
				'title' => 'Wiyata E-Learning | Rangkuman BAB',
				'get_rangkuman' => $this->siswa->getRangkumanByBab($rangkuman_id)->row_object()
			];  

            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar', $ParseData);
            $this->load->view('siswa/bahan_ajar/rangkuman', $ParseData);
            $this->load->view('siswa/layouts/footer', $ParseData);
        }

        public function latihan_tugas($id_bab) {
			is_siswa();
			$latihan_id = $this->secure->decrypt_url($id_bab);
			$siswa = $this->userSiswa;
			$ParseData = [
				'title' => 'Wiyata E-Learning | Rangkuman BAB',
				'get_latihan' => $this->siswa->getLatihanByBAB(['tb_bab.id_bab' => $latihan_id])->result(),
				'data_siswa' => $siswa,
				'id_bab' => $latihan_id
			]; 
            
            $this->load->view('siswa/layouts/header', $ParseData);
            $this->load->view('siswa/layouts/navbar', $ParseData);
            $this->load->view('siswa/bahan_ajar/latihan', $ParseData);
            $this->load->view('siswa/layouts/footer', $ParseData);
        }

		public function unduh_tugas($id_bab, $id_latihan) {
			$this->load->helper('download');
			$tugas_id	= $this->secure->decrypt_url($id_latihan);
			$where	=	array(
				'tb_bab.id_bab' => $id_bab,
				'id_tugas' => $tugas_id
			);
			$data_tugas = $this->siswa->getLatihanByBAB($where)->row_array();
			$path_tugas = './storage/bahanajar/BAB_' . $data_tugas['bab_ke'] . '/latihan/' . $data_tugas['file_tugas'];
			force_download($path_tugas, NULL);
		}

		public function lihat_tugas($tugas_siswa) {
			$tugas_siswa = $this->secure->decrypt_url($tugas_siswa); 
			$ParseData = [
				'title' => 'Tugas Siswa',
				'tugas_siswa' => $this->db->get_where('tb_tugas_siswa', ['id_tugas_siswa' => $tugas_siswa])->row_array()
			];
            $this->load->view('guru/data_tugas/tugas_siswa', $ParseData);
		}

		public function cek_deadline(){
			$date_now = date('Y-m-d');
			$tugas_siswa = $this->db->get_where('tb_pemb_tugas', ['id_pemb_tugas' => $this->input->post('id_deadline', true)])->row_array();
			if(empty($tugas_siswa['deadline_tugas'])) {
				$response = [
					'csrfName' => $this->security->get_csrf_token_name(),
					'csrfHash' => $this->security->get_csrf_hash(),
					'success' => true,
					'msgabsen' => '<div class="alert alert-danger text-center" role="alert">Waktu Pengumpulan Tugas</div>'
				];
			} else {
				if(strtotime($date_now) > strtotime($tugas_siswa['deadline_tugas']) && strtotime($tugas_siswa['deadline_tugas']) <= strtotime($date_now)  ) {
					$response = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => false,
						'msgabsen' => '<div class="alert alert-danger text-center" role="alert">Waktu Pengumpulan Sudah Berakhir</div>'
					];
				} elseif(strtotime($date_now) <= strtotime($tugas_siswa['deadline_tugas'])) {
					$response = [
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
						'success' => true,
						'msgabsen' => '<div class="alert alert-danger text-center" role="alert">Waktu Pengumpulan Tugas</div>'
					];
				}
			}
			echo json_encode($response);
		}
		public function crud_tugassiswa() {
            $typesend = $this->input->get('type');
            $response = [
                'csrfName'	=> $this->security->get_csrf_token_name(),
                'csrfHash'	=> $this->security->get_csrf_hash(),
            ];
			if($typesend =='upload_tugas') {
				$data['id_tugas'] = $this->input->post('id_tugas', TRUE);
				$data['data_siswa'] = $this->userSiswa;
                $html = $this->load->view('siswa/bahan_ajar/upload_tugas', $data);
                $response = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash()
                ];
			} elseif ($typesend == 'do_upload') {
				$response = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => false,
                    'messages' => []
                ];

                if (empty($_FILES['file_tugas']['name'])) {
                    $validation = $this->form_validation->set_rules('file_tugas', 'File Tugas', 'required');
                    $this->form_validation->set_rules($validation);
                    if ($this->form_validation->run() == false) {
                        $response['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
                    }
                } else {
                    $this->siswa->crud_tugassiswa($typesend);
                    $response = [
                        'csrfName' => $this->security->get_csrf_token_name(),
                        'csrfHash' => $this->security->get_csrf_hash(),
                        'success' => true
                    ];
                }
		
			} else if($typesend == 'update_tugas') {
				$data['id_tugas_siswa'] = $this->input->post('id_tugas_siswa', TRUE);
                $html = $this->load->view('siswa/bahan_ajar/update_tugas', $data);
                $response = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash()
                ];
			} elseif ($typesend == 'do_update') {
				$response = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => false,
                    'messages' => []
                ];

                if (empty($_FILES['update_file']['name'])) {
                    $validation = $this->form_validation->set_rules('update_file', 'File Tugas', 'required');
                    $this->form_validation->set_rules($validation);
                    if ($this->form_validation->run() == false) {
                        $response['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
                    }
                } else {
                    $this->siswa->crud_tugassiswa($typesend);
                    $response = [
                        'csrfName' => $this->security->get_csrf_token_name(),
                        'csrfHash' => $this->security->get_csrf_hash(),
                        'success' => true
                    ];
                }
		
			}
			echo json_encode($response);
		}
		
		public function get_tabletugas() {
			$data_siswa = $this->userSiswa;
			$id_bab 	= $this->input->post('id_bab', true);
			$draw = intval($this->input->get("draw"));
			$data = array();
			$no   = 1;
			$query = $this->siswa->getLatihanByBAB(['tb_bab.id_bab' => $id_bab]);
			foreach ($query->result() as $row) {
				
				$sub_array	= array();
				$pemb_tugas = $this->db->get_where('tb_pemb_tugas', [
					'id_kelas' => $data_siswa['id_kelas'],
					'id_tugas' => $row->id_tugas
				])->row();
				
				$tugas_siswa = $this->db->get_where('tb_tugas_siswa', [
					'id_tugas' => $row->id_tugas,
					'id_siswa' => $data_siswa['id_siswa']
				])->row();
				$sub_array[]	=	$no++;
				$sub_array[]	= 'BAB' . $row->bab_ke;
				$sub_array[]	=	$row->latihan_tugas_ke;
				
				$sub_array[]	=  (empty($pemb_tugas->pemberitahuan)) ? $row->deskripsi_tugas : $pemb_tugas->pemberitahuan;
				
				if(empty($pemb_tugas->deadline_tugas)) :
					$sub_array[]	=  '-';
				else :
					$sub_array[]	= ($pemb_tugas->deadline_tugas == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($pemb_tugas->deadline_tugas));
				endif;

				if(empty($tugas_siswa->tanggal_upload)) :
					$sub_array[]	=  '-';
				else :
					$sub_array[]	= ($tugas_siswa->tanggal_upload == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($tugas_siswa->tanggal_upload));
				endif;

				if(empty($tugas_siswa->tanggal_edit)) :
					$sub_array[]	=  '-';
				else :
					$sub_array[]	= ($tugas_siswa->tanggal_edit == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($tugas_siswa->tanggal_edit));
				endif;

				if ($tugas_siswa) :
					if ($tugas_siswa->tipe_file == '.pdf') : 
						$sub_array[]	=  '<a target="blank" href="'. base_url('ruang_materi/BahanAjar/lihat_tugas/' . $this->secure->encrypt_url($tugas_siswa->id_tugas_siswa)) .'"><img src="' .base_url('assets/guru/icons/pdficon.png') .'" style="width:50px"></a>';
					elseif (empty($tugas_siswa->file_tugas)) :
						$sub_array[]	= '<div class="text-center">tidak ada file tugas</div>';
					else : 
						$sub_array[]	=  '<a target="blank" href="'. base_url('ruang_materi/BahanAjar/lihat_tugas/' . $this->secure->encrypt_url($tugas_siswa->id_tugas_siswa)) .'"><img src="'. base_url('storage/tugas_siswa/' . $tugas_siswa->file_tugas) .'" alt="Gambar Tugas" width="100px"></a>';
					endif;
				else : 
					$sub_array[]= '<div class="text-center">-</div>';
				endif; 
				
				$sub_array[]= (empty($tugas_siswa->komentar_guru)) ? ' - ' : $tugas_siswa->komentar_guru;
				$sub_array[]= (empty($tugas_siswa->nilai_tugas)) ? ' - ' : $tugas_siswa->nilai_tugas;

				if (!empty($tugas_siswa)) :
					if ($tugas_siswa->nilai_tugas) :
						$sub_array[]=  '<div class="text-center">Tugas sudah dinilai</div>';
					else :
						$sub_array[]= '<div class="text-center"><button class="btn btn-success rounded edit-tugas" data-upload-id="'. $tugas_siswa->id_tugas_siswa . '" deadline-tugas-id="'. $pemb_tugas->id_pemb_tugas .'" data-bab-id="' . $id_bab .'">Edit</button></div>';
					endif;
				else :
					$sub_array[]= '<div class="text-center">belum mengumpulkan tugas</div>';
				endif;

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
		public function unduh_panduan()
    	{
    		$ParseData = [
    			'title' => 'Unduh Panduan',
    		];
    		$this->load->view('siswa/bahan_ajar/unduh_panduan', $ParseData);
    	}
    }

?>

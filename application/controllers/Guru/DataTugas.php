<?php 
    class DataTugas extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('GuruModel', 'guru', true);
            $this->load->model('AdminModel', 'admin', true);
			$this->load->model('SiswaModel', 'siswa', true);
            $this->get_guru = $this->db->get_where('tb_guru', ['guru_nip' =>
            $this->session->userdata('nip')])->row_array();
            is_guru_login();
        }

        // Latihan Siswa
        public function latihanSiswa()
        {
            is_guru();
            $dataGuru = $this->get_guru;
            $ParseData = [
                'title' 	=>	'Guru Wiayta E-Learning | Tugas Latihan Siswa',
                'data_guru' =>	$this->guru->get_gurumapel($this->get_guru['guru_nip'])->row_array(),
                'getBab' 	=>	$this->guru->get_datatable('tb_bab')->result_object(),
                'kelas' 	=>	$this->db->get_where('tb_kelas', ['id_guru' => $this->get_guru['id_guru']])->result_object(),
                'get_tugas' =>	$this->guru->get_pemberitahuan_tugas()->result_array()
            ];

            $this->load->view('guru/layouts/header', $ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData);
            $this->load->view('guru/data_tugas/latihan_siswa', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
        }

        // Latihan Siswa Detail
        public function latihanSiswaDetail($kelas, $bab, $id_pemb_tugas)
        {
            is_guru();
            $dataGuru 	= $this->get_guru;
            $cek_tugas 	= $this->secure->decrypt_url($id_pemb_tugas);
            
            # get pemberitahuan tugas
            $get_tugas = $this->guru->get_pemb_tugas(['id_pemb_tugas' => $cek_tugas])->row_array();
            # get data siswa
            $data_siswa = $this->db->get_where('tb_siswa', ['id_kelas' => $get_tugas['id_kelas']]);
            # jumlah mengumpulkan
            $jml_mengumpulkan =  $this->guru->get_tugas_siswa([
                'id_kelas' => $get_tugas['id_kelas'],
                'id_tugas' => $get_tugas['id_tugas'],
                'keterangan' => '1'
            ])->num_rows();

            # jumlah siswa sudah dinilai
            $jml_dinilai =  $this->guru->get_tugas_siswa([
                'id_kelas' => $get_tugas['id_kelas'],
                'id_tugas' => $get_tugas['id_tugas'],
                'keterangan' => '2'
            ])->num_rows();

            # jumlah siswa belum mengumpulkan
            $jml_belum = $data_siswa->num_rows() - ($jml_mengumpulkan + $jml_dinilai);

            $ParseData = [
                'title'	=>	'Guru Wiayta E-Learning | Tugas Latihan Siswa',
                'data_guru'	=> 	$dataGuru,
                'get_tugas'	=> 	$get_tugas,
                'data_siswa' 	=>	$data_siswa->result_array(),
                'jumlah_siswa'	=>	$data_siswa->num_rows(),
                'mengumpulkan'	=>	$jml_mengumpulkan,
                'dinilai'		=>	$jml_dinilai,
                'belum_mengumpulkan'	=>	$jml_belum,
            ];


            $this->load->view('guru/layouts/header', $ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData);
            $this->load->view('guru/data_tugas/latihan_siswa_detail', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
        }

        // Cek File Latihan
        public function cek_FileLatihan($id_tugas)
        {
            $latihan_tugas = $this->secure->decrypt_url($id_tugas);
            $ParseData = [
                'title' => 'Latihan Tugas',
                'latihanTugas' => $this->admin->getLatihanbyID(['id_tugas' => $latihan_tugas])->row_object()
            ];
            $this->load->view('guru/data_tugas/cek_file_latihan', $ParseData);
        }


        public function cek_latihan_siswa()
        {
            $typesend = $this->input->get('type');
            $response = [
                'csrfName'	=> $this->security->get_csrf_token_name(),
                'csrfHash'	=> $this->security->get_csrf_hash(),
            ];

            if ($typesend == 'cek_tugas') {
                $response = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => false,
                    'messages' => []
                ];

                $validation = [
                    [
                        'field' => 'kelas',
                        'label' => 'Kelas',
                        'rules' => 'trim|required|xss_clean',
                        'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                    [
                        'field' => 'bab',
                        'label' => 'BAB',
                        'rules' => 'trim|required|xss_clean',
                        'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                    [
                        'field' => 'latihan_ke',
                        'label' => 'Latihan Ke',
                        'rules' => 'trim|required|xss_clean',
                        'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                ];

                $this->form_validation->set_rules($validation);
                if ($this->form_validation->run() == false) {
                    $response['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
                } else {
                    $id_bab 	= $this->input->post('bab', true);
					$latihan_ke = $this->input->post('latihan_ke', true);
					$get_latihan = $this->db->where('id_bab', $id_bab)->where_in('latihan_tugas_ke', $latihan_ke)->get('tb_latihan_tugas')->row_array();
					$pemb_tugas = $this->db->get_where('tb_pemb_tugas', [
						'id_kelas' => $this->input->post('kelas', true),
						'id_bab'	=> $id_bab,
						'id_tugas' => $get_latihan['id_tugas']
					])->num_rows();


					if(!empty($pemb_tugas)) {
						$response = [
							'csrfName' => $this->security->get_csrf_token_name(),
							'csrfHash' => $this->security->get_csrf_hash(),
							'success' => false,
							'messages' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">Latihan Tugas Siswa <strong>Sudah Tersedia</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
						];
					} else {
						$this->guru->crud_cektugas($typesend);
						$response = [
							'csrfName' => $this->security->get_csrf_token_name(),
							'csrfHash' => $this->security->get_csrf_hash(),
							'success' => true,
						];
					}
                }
            } elseif ($typesend == 'update_pemb') {
                $data['pemb_tugas'] = $this->guru->get_pemb_tugas(['id_pemb_tugas' => $this->input->post('id_pemb_tugas')])->row_array();
                $html = $this->load->view('guru/data_tugas/edit_pemb_tugas', $data);
                $response = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash()
                ];
            }
            echo json_encode($response);
        }

        public function update_pemberitahuan()
        {
            $typesend = $this->input->get('type');
            $response = [
                'csrfName'	=> $this->security->get_csrf_token_name(),
                'csrfHash'	=> $this->security->get_csrf_hash(),
            ];
            $response = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => false,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'pemberitahuan_edit',
                    'label' => 'Pemberitahuan',
                    'rules' => 'trim|required|xss_clean',
                    'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                ],
                [
                    'field' => 'deadline_tugas',
                    'label' => 'Deadline Tugas',
                    'rules' => 'trim|required|xss_clean',
                    'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                ],
            ];

            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == false) {
                $response['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else {
                $this->guru->crud_cektugas($typesend);
                $response = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
            echo json_encode($response);
        }

        public function nilai_tugas_siswa()
        {
            $typesend = $this->input->get('type');
            $response = [
                'csrfName'	=> $this->security->get_csrf_token_name(),
                'csrfHash'	=> $this->security->get_csrf_hash(),
            ];

            if ($typesend == 'view_nilai01') {
                $tugas_siswa	= $this->guru->get_tugas_siswa([
					'id_tugas_siswa' => $this->input->post('id_tugas_siswa')
				])->row_array();
				$kelas_siswa	= $this->siswa->get_datasiswa($tugas_siswa['siswa_nis'])->row_array();
                $latihan_tugas	= $this->admin->getLatihanbyID(['id_tugas' => $tugas_siswa['id_tugas']])->row_array();
                $data = [
                    'tugas_siswa' => $tugas_siswa,
                    'latihan_tugas' => $latihan_tugas,
					'kelas_siswa' => $kelas_siswa
                ];
                $html = $this->load->view('guru/data_tugas/nilai_tugas', $data);
                $response = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash()
                ];
            } elseif ($typesend == 'input_nilai01') {
                $response = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => false,
                    'messages' => []
                ];

                $validation = [
                    [
                        'field' => 'nilai_tugas',
                        'label' => 'Nilai Tugas',
                        'rules' => 'trim|required|xss_clean',
                        'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                    [
                        'field' => 'komentar_guru',
                        'label' => 'Komentar Tugas',
                        'rules' => 'trim|required|xss_clean',
                        'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                ];
    
                $this->form_validation->set_rules($validation);
                if ($this->form_validation->run() == false) {
                    $response['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
                } else {
                    $this->guru->insert_nilai_tugas($typesend);
                    $response = [
                        'csrfName' => $this->security->get_csrf_token_name(),
                        'csrfHash' => $this->security->get_csrf_hash(),
                        'success' => true
                    ];
                }
            } elseif($typesend == 'view_nilai02') {
				$siswa = $this->siswa->get_datasiswa($this->input->post('nis_siswa', true))->row_array();;
				$tugas = $this->input->post('id_tugas', true);
				$latihan_tugas = $this->admin->getLatihanbyID(['id_tugas' => $tugas])->row_array();
				$data = [
					'siswa' => $siswa,
					'tugas' => $tugas,
					'latihan_tugas' => $latihan_tugas
				];
				$html = $this->load->view('guru/data_tugas/tambah_nilai_tugas', $data);
                $response = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash()
                ];
			} elseif ($typesend == 'input_nilai02') {
				$response = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => false,
                    'messages' => []
                ];

                $validation = [
                    [
                        'field' => 'input_nilai_tugas',
                        'label' => 'Nilai Tugas',
                        'rules' => 'trim|required|xss_clean',
                        'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                    [
                        'field' => 'input_komentar_guru',
                        'label' => 'Komentar Tugas',
                        'rules' => 'trim|required|xss_clean',
                        'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                ];
    
                $this->form_validation->set_rules($validation);
                if ($this->form_validation->run() == false) {
                    $response['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
                } else {
                    $this->guru->insert_nilai_tugas($typesend);
                    $response = [
                        'csrfName' => $this->security->get_csrf_token_name(),
                        'csrfHash' => $this->security->get_csrf_hash(),
                        'success' => true
                    ];
                }
			}
            echo json_encode($response);
        }

		public function lihat_tugas_siswa($tugas_siswa) {
			$tugas_siswa = $this->secure->decrypt_url($tugas_siswa); 
			$ParseData = [
				'title' => 'Tugas Siswa',
				'tugas_siswa' => $this->db->get_where('tb_tugas_siswa', ['id_tugas_siswa' => $tugas_siswa])->row_array()
			];
            $this->load->view('guru/data_tugas/tugas_siswa', $ParseData);
		}

        // Uji Kompetensi
        public function ujiKompetensi()
        {
            is_guru();
            $dataGuru = $this->get_guru;
            $ParseData = [
                'title' => 'Guru Wiayta E-Learning | Tugas Latihan Siswa',
                'data_guru' => $dataGuru,
                'pemberitahuan_uk' => $this->guru->get_pemberitahuan_uk()->result_array(),
                'getBab' 	=>	$this->guru->get_datatable('tb_bab')->result_object(),
                'kelas' 	=>	$this->db->get_where('tb_kelas', ['id_guru' => $this->get_guru['id_guru']])->result_object(),
            ];

            $this->load->view('guru/layouts/header', $ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData);
            $this->load->view('guru/data_tugas/uji_kompetensi', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
        }

        // Uji Kompetensi Detail
        public function ujiKompetensiDetail($kelas, $bab, $id_pemb_uk)
        {
            is_guru();
            $dataGuru 	= $this->get_guru;
            $cek_uk 	= $this->secure->decrypt_url($id_pemb_uk);

            // get data siswa
            $get_uk 	= $this->guru->pemb_kompetensi_id(['id_pemb_uk' => $cek_uk])->row_array();
            $data_siswa	= $this->db->get_where('tb_siswa',['id_kelas' => $get_uk['id_kelas']]);
            // siswa mengerjakan
            $siswa_mengerjakan =  $this->guru->get_uk_siswa([
                'id_kelas' => $get_uk['id_kelas'],
                'id_bab' => $get_uk['id_bab'],
                'keterangan' => '1'
            ])->num_rows();

            // siswa tidak mengerjakan
            $belum_mengerjakan = $data_siswa->num_rows() - $siswa_mengerjakan;

            $ParseData = [
                'title' 			=>	'Guru Wiayta E-Learning | Tugas Latihan Siswa',
                'data_guru' 		=> 	$dataGuru,
                'get_uk'			=> 	$get_uk,
                'jumlah_siswa'		=> 	$data_siswa->num_rows(),
                'siswa_mengerjakan'	=> 	$siswa_mengerjakan,
                'belum_mengerjakan'	=>	$belum_mengerjakan,
                'data_siswa'		=>	$data_siswa->result_array()
            ];

            $this->load->view('guru/layouts/header', $ParseData);
            $this->load->view('guru/layouts/sidebar', $ParseData);
            $this->load->view('guru/layouts/topbar', $ParseData);
            $this->load->view('guru/data_tugas/uji_kompetensi_detail', $ParseData);
            $this->load->view('guru/layouts/footer', $ParseData);
        }


        public function cek_ujikompetensi()
        {
            $typesend = $this->input->get('type');
            $response = [
                'csrfName'	=> $this->security->get_csrf_token_name(),
                'csrfHash'	=> $this->security->get_csrf_hash(),
            ];
            if ($typesend == 'cek_uk') {
                $response = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => false,
                    'messages' => []
                ];

                $validation = [
                    [
                        'field' => 'kelas',
                        'label' => 'Kelas',
                        'rules' => 'trim|required|xss_clean',
                        'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                    [
                        'field' => 'bab_ke',
                        'label' => 'BAB',
                        'rules' => 'trim|required|xss_clean',
                        'error'	=> ['required' => 'field %s harus diisi!', 'xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                ];

                $this->form_validation->set_rules($validation);
                if ($this->form_validation->run() == false) {
                    $response['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
                } else {
                    $query = $this->db->get_where('tb_pemb_uk', [
						'id_kelas' => $this->input->post('kelas', true),
						'id_bab'=> $this->input->post('bab_ke', true)
					])->num_rows();

					if(!empty($query)) {
						$response = [
							'csrfName' => $this->security->get_csrf_token_name(),
							'csrfHash' => $this->security->get_csrf_hash(),
							'success' => false,
							'messages' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
											Uji Kompetensi Siswa <strong>Sudah Tersedia</strong>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 	 				<span aria-hidden="true">&times;</span>
											</button>
										</div>'
						];
					} else {
						$this->guru->crud_cekkompetensi($typesend);
						$response = [
							'csrfName' => $this->security->get_csrf_token_name(),
							'csrfHash' => $this->security->get_csrf_hash(),
							'success' => true,
						];
					}
                }
            } elseif ($typesend == 'update_uk') {
				$data['pemb_uk'] = $this->guru->pemb_kompetensi_id(['id_pemb_uk' => $this->input->post('id_pemb_uk', TRUE)])->row_array();
                $html = $this->load->view('guru/data_tugas/edit_pemb_uk', $data);
                $response = [
                    'html' => $html,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash()
                ];
			} elseif ($typesend == 'do_updateuk') {
				$response = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => false,
                    'messages' => []
                ];

                $validation = [
                    [
                        'field' => 'tanggal_mulai',
                        'label' => 'Tanggal Mulai',
                        'rules' => 'trim|xss_clean',
                        'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                    [
                        'field' => 'jam_mulai',
                        'label' => 'Jam Mulai',
                        'rules' => 'trim|xss_clean',
                        'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                    [
                        'field' => 'jam_selesai',
                        'label' => 'Jam Selesai',
                        'rules' => 'trim|xss_clean',
                        'error'	=> ['xss_clean' => 'cek kembali pada form %s %s.']
                    ],
                ];

                $this->form_validation->set_rules($validation);
                if ($this->form_validation->run() == false) {
                    $response['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
                } else {
                    $this->guru->crud_cekkompetensi($typesend);
                    $response = [
                        'csrfName' => $this->security->get_csrf_token_name(),
                        'csrfHash' => $this->security->get_csrf_hash(),
                        'success' => true
                    ];
                }
			}
			echo json_encode($response);
        }
        
        // ajax get table cek tugas siswa
		public function get_datatable() {
		    $dataGuru = $this->get_guru;
			$datatable = $this->input->get('type');
			$draw = intval($this->input->get("draw"));
			$data = array();
			$no   = 1;
			
			$id_pemb = $this->input->post('id_pemb', true);
			$pemb_tugas = $this->guru->get_pemb_tugas(['id_pemb_tugas' => $id_pemb]);
			
			if($datatable == 'cek_tugas') {
				$query = $this->guru->get_pemb_tugas(['tb_kelas.id_guru' => $dataGuru['id_guru']]);
				foreach ($query->result() as $row) {
					$sub_array	= array();
					$sub_array[] = 	$no++;
					$sub_array[] = 	$row->kelas_nama;
					$sub_array[] = 	$row->mapel;
					$sub_array[] = 	'BAB ' . $row->bab_ke;
					$sub_array[] = 	$row->latihan_tugas_ke;
					$sub_array[] = 	(empty($row->deadline_tugas)) ? '<div class="text-center"> - </div>' : '<div class="text-center">' . date('d-m-Y', strtotime($row->deadline_tugas)) .'</div>';
					$sub_array[] = 	($row->tanggal_dibuat == '0000-00-00') ? '<div class="text-center"> - </div>' : '<div class="text-center">' . date('d-m-Y', strtotime($row->tanggal_dibuat)) .'</div>';
					$sub_array[] = 	($row->tanggal_diedit == '0000-00-00') ? '<div class="text-center"> - </div>' : '<div class="text-center">' . date('d-m-Y', strtotime($row->tanggal_diedit)) .'</div>';
					$sub_array[] = 	'<div class="text-center"><a href="' . base_url('Guru/DataTugas/latihanSiswaDetail/' . $row->kelas_nama . '/' . $row->bab_ke . '/' . $this->secure->encrypt_url($row->id_pemb_tugas)) .'"><button class="btn btn-sm btn-info pl-3 pr-4"><i class="fa fa-search ml-3"></i> Cek Latihan</button></a></div>';

					$data[] = $sub_array;
				}
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $query->num_rows(),
					'recordFiltered' 	=> $query->num_rows(),
					'data' => $data
				);
			} elseif ($datatable == 'pemb_tugas') {
				foreach ($pemb_tugas->result() as $row) {
					$sub_array	= array();
					$sub_array[] = 	$no++;
					$sub_array[] = 	$row->kelas_nama;
					$sub_array[] = 	$row->mapel;
					$sub_array[] = 	'BAB ' . $row->bab_ke;
					$sub_array[] = 	$row->latihan_tugas_ke;
					$sub_array[] = 	$row->pemberitahuan;
					$sub_array[] = 	(empty($row->deadline_tugas)) ? ' - ' : date('d-m-Y', strtotime($row->deadline_tugas));
					$sub_array[] = 	($row->tanggal_dibuat == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($row->tanggal_dibuat));
					$sub_array[] = 	($row->tanggal_diedit == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($row->tanggal_diedit));
					$sub_array[] =	'<div class="text-center"><a target="blank" href="'. base_url('Guru/DataTugas/cek_filelatihan/' . $this->secure->encrypt_url($row->id_tugas)).'"><button class="btn btn-sm btn-primary pl-3 pr-4"><i class="fa fa-search ml-3"></i>Latihan</button></a><button class="btn btn-sm btnGreen pl-5 pr-5 mt-2 edit-pemb-tugas" data-tugas-id="'. $row->id_pemb_tugas .'" title="Edit Pemberitahuan Tugas">Edit</button></div>';
					$data[] = $sub_array;
				}
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $pemb_tugas->num_rows(),
					'recordFiltered' 	=> $pemb_tugas->num_rows(),
					'data' => $data
				);
			} elseif ($datatable == 'tugas_siswa') {
			    $info 	= $pemb_tugas->row_object();
				$student= $this->db->get_where('tb_siswa', ['id_kelas' => $info->id_kelas]);
				foreach($student->result() as $row) {
					$nilai_siswa = $this->db->get_where('tb_tugas_siswa', [
						'id_tugas' => $info->id_tugas,
						'id_siswa' => $row->id_siswa
					])->row_object();
					$sub_array	= array();
					$sub_array[] = 	$no++;
					$sub_array[] = 	$row->siswa_nama;
					$sub_array[] = 	$row->siswa_nis;
					$sub_array[] = 	$row->siswa_jenis_kelamin;
					if(!empty($nilai_siswa)) {
						# tanggal upload
						$sub_array[] = ($nilai_siswa->tanggal_upload == '0000-00-00') ? '-' : date('d-m-Y', strtotime($nilai_siswa->tanggal_upload));
						# file tugas
						if($nilai_siswa->tipe_file == '.pdf') {
							$sub_array[] = '<a target="blank" href="'. base_url('Guru/DataTugas/lihat_tugas_siswa/' . $this->secure->encrypt_url($nilai_siswa->id_tugas_siswa)) .'"><img src="'. base_url('assets/guru/icons/pdficon.png') .'"width="25px" class="ml-2"></a>';
						} elseif (empty($nilai_siswa->file_tugas)) {
							$sub_array[] = '<div class="text-center">tidak ada file tugas</div>';
						} else {
							$sub_array[] = '<a target="blank" href="'. base_url('Guru/DataTugas/lihat_tugas_siswa/' . $this->secure->encrypt_url($nilai_siswa->id_tugas_siswa)) .'"><img src="'. base_url('storage/tugas_siswa/'. $nilai_siswa->file_tugas) .'" alt="Gambar Tugas" width="100px"></a>';
						}
						# komentar guru
						$sub_array[] = (empty($nilai_siswa->komentar_guru)) ? '-' : $nilai_siswa->komentar_guru;
						# nilai tugas
						$sub_array[] = '<div class="text-center">' .$nilai_siswa->nilai_tugas .'</div>';
						# keterangan tugas
						$sub_array[] = ($nilai_siswa->keterangan == 1) ? 'Tugas Sudah Dikumpulkan' : (($nilai_siswa->keterangan == 2) ? 'Tugas Sudah Dinilai' : '-');
						# button tugas
						$btn = ($nilai_siswa->keterangan == 1) ? 'btn-success' : (($nilai_siswa->keterangan == 2) ? 'btn-primary' : 'btn-success');
						$button = ($nilai_siswa->keterangan == 1) ? 'Nilai Dan Komentar' : (($nilai_siswa->keterangan == 2) ? 'Edit Nilai' : 'Nilai Dan Komentar');
						$sub_array[] = '<button class="btn btn-sm '. $btn .' nilai-siswa mr-3" tugas-siswa-id="' .$nilai_siswa->id_tugas_siswa .'"  pemb-tugas-id="'. $id_pemb .'" title="NIlai Tugas Siswa">'. $button .'</button>';
					} else {
						$sub_array[] = '<div class="text-center">-</div>';
						$sub_array[] = '<div class="text-center">belum upload tugas</div>';
						$sub_array[] = '<div class="text-center">-</div>';
						$sub_array[] = '<div class="text-center">-</div>';
						$sub_array[] = '<div class="text-center">belum mengumpulkan tugas</div>';
						$sub_array[] = '<div class="text-center"><button class="btn btn-sm  btn-outline-success tambah-nilai mr-3" tugas-id="'. $info->id_tugas .'" data-siswa-id="'. $row->siswa_nis .'" pemb-tugas-id="'. $id_pemb .'">Nilai dan Komentar</button></div>';
					}

					$data[] = $sub_array;
				}
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $student->num_rows(),
					'recordFiltered' 	=> $student->num_rows(),
					'data' => $data
				);
			}

			echo json_encode($result);
		}
		
		# Ajax table uji kompetensi siswa
		public function get_tabeluk() {
			$dataGuru = $this->get_guru;
			$datatable = $this->input->get('type');
			$draw = intval($this->input->get("draw"));
			$data = array();
			$no   = 1;
			$id_uk = $this->input->post('id_uk', true);
			$pemb_uk = $this->guru->pemb_kompetensi_id(['id_pemb_uk' => $id_uk]);
			if($datatable == 'info_uk') {
				$query = $this->guru->pemb_kompetensi_id(['tb_kelas.id_guru' => $dataGuru['id_guru']]);
				foreach($query->result() as $row => $value) {
					$sub_array = array();
					$sub_array[] = 	$no++;
					$sub_array[] = 	$value->kelas_nama;
					$sub_array[] = 	$value->mapel;
					$sub_array[] = 	'BAB ' . $value->bab_ke;
					$sub_array[] = 	($value->tanggal_mulai == null) ? ' - ' : date('d-m-Y', strtotime($value->tanggal_mulai));
					$sub_array[] = 	($value->tanggal_dibuat == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($value->tanggal_dibuat));
					$sub_array[] = 	($value->tanggal_diedit == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($value->tanggal_diedit));
					$sub_array[] =	'<div class="text-center"><a href="'. base_url('Guru/DataTugas/ujiKompetensiDetail/' . $value->kelas_nama . '/' . $value->bab_ke . '/' . $this->secure->encrypt_url($value->id_pemb_uk)) .'"><button class="btn btn-sm btn-info pl-3 pr-4"><i class="fa fa-search ml-3"></i> Cek UK</button></a></div>';
					$data[] = $sub_array;
				}
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $query->num_rows(),
					'recordFiltered' 	=> $query->num_rows(),
					'data' => $data
				);
			} elseif($datatable == 'info_uk_detail') {
				foreach($pemb_uk->result() as $row => $value) {
					$sub_array = array();
					$sub_array[] = 	$no++;
					$sub_array[] = 	$value->kelas_nama;
					$sub_array[] = 	$value->mapel;
					$sub_array[] = 	'BAB ' . $value->bab_ke;
					$sub_array[] =	(empty($value->tanggal_mulai)) ? '-' : date('d-m-Y', strtotime($value->tanggal_mulai));
					$sub_array[] =	(empty($value->waktu_mulai)) ? '-' : date('H:i', strtotime($value->waktu_mulai)) . ' WIB';
					$sub_array[] =	(empty($value->waktu_selesai)) ? '-' : date('H:i', strtotime($value->waktu_selesai)) . ' WIB';
					$sub_array[] =	($value->tanggal_dibuat == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($value->tanggal_dibuat));
					$sub_array[] =	($value->tanggal_diedit == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($value->tanggal_diedit));
					$sub_array[] =	'<div class="text-center"><button class="btn btn-sm btnGreen pl-5 pr-5 mt-2 edit-pemb-uk" data-uk-id="'. $value->id_pemb_uk .'" title="Edit Pemberitahuan UK">Edit</button></div>';
					$data[] = $sub_array;
				}
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $pemb_uk->num_rows(),
					'recordFiltered' 	=> $pemb_uk->num_rows(),
					'data' => $data
				);
			} elseif($datatable == 'data_uk_siswa') {
				$info 	= $pemb_uk->row_object();
				$student= $this->db->get_where('tb_siswa', ['id_kelas' => $info->id_kelas]);
				foreach($student->result() as $row => $value) {
					$nilai_siswa = $this->db->get_where('tb_uk_siswa', [
						'id_bab' => $info->id_bab,
						'id_siswa' => $value->id_siswa
					])->row_object();
					$sub_array	= array();
					$sub_array[] = 	$no++;
					$sub_array[] = 	$value->siswa_nama;
					$sub_array[] = 	$value->siswa_nis;
					$sub_array[] = 	$value->siswa_jenis_kelamin;
					if($nilai_siswa) {
						$sub_array[] =	(empty($nilai_siswa->jumlah_soal)) ? '<div class="text-center">-</div>' : $nilai_siswa->jumlah_soal;
						$sub_array[] =	(empty($nilai_siswa->jumlah_benar)) ? '<div class="text-center">-</div>' : $nilai_siswa->jumlah_benar;
						$sub_array[] =	(empty($nilai_siswa->jumlah_salah)) ? '<div class="text-center">-</div>' : $nilai_siswa->jumlah_salah;
						$sub_array[] =	(empty($nilai_siswa->tidak_dijawab)) ? '<div class="text-center">-</div>' : $nilai_siswa->tidak_dijawab;
						$sub_array[] =	(empty($nilai_siswa->nilai_uk)) ? '<div class="text-center">-</div>' : $nilai_siswa->nilai_uk;
					} else {
						$sub_array[] = '<div class="text-center">-</div>';
						$sub_array[] = '<div class="text-center">-</div>';
						$sub_array[] = '<div class="text-center">-</div>';
						$sub_array[] = '<div class="text-center">-</div>';
						$sub_array[] = '<div class="text-center">-</div>';
					}
					$data[] = $sub_array;
				}
				$result = array(
					'draw' 	=> $draw,
					'recordTotal' => $student->num_rows(),
					'recordFiltered' 	=> $student->num_rows(),
					'data' => $data
				);
			}
			echo json_encode($result);
		}
    }  

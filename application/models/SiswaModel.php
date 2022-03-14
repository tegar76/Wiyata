<?php

	class SiswaModel extends CI_Model {

		public function get_datatable($table) {
			return $this->db->get($table);
		}
		
		public function get_datasiswa($nis_siswa) {
			$query = $this->db->select("*")
				->from('tb_siswa')
				->join('tb_kelas', 'tb_kelas.id_kelas=tb_siswa.id_kelas')
				->where('siswa_nis', $nis_siswa)
				->get();
			return $query;
		}
		
	
		public function get_materibab() {
			$query = $this->db->get('tb_bab');
			return $query->result_array();
		}
		
		public function get_datakelas($nis_siswa) {
			$query = $this->db->select('tb_kelas.id_kelas, tb_kelas.kelas_nama, tb_guru.id_guru, tb_guru.guru_nama, tb_siswa.id_siswa, tb_siswa.id_kelas, tb_siswa.siswa_nis, tb_siswa.siswa_nama')
				->from('tb_kelas')
				->join('tb_guru', 'tb_guru.id_guru=tb_kelas.id_guru')
				->join('tb_siswa', 'tb_siswa.id_kelas=tb_kelas.id_kelas')
				->where('tb_siswa.siswa_nis', $nis_siswa)
				->get();
			if( !empty($query->num_rows()) ) {
				return $query->row_array();
			} else {
				return false;
			}
		}
		
		public function getUnitById($id_unit_bab = null) {
			$query = $this->db->select("*")
						->from('tb_unit_bab')
						->join('tb_bab', 'tb_bab.id_bab=tb_unit_bab.id_bab')
						->where($id_unit_bab)
						->get();
			return $query;	
		}
	
		public function getUnitByBab($id_bab = null) {
			$query = $this->db->where('id_bab', $id_bab)->get('tb_unit_bab');
			return $query->result_array();	
		}

		public function getRangkumanByBab($id_bab = null) {
			$query = $this->db->where('id_bab', $id_bab)->get('tb_bab');
			return $query;
		}

		public function getPemberitahuanBAB($where = null) {
			$query = $this->db->where($where)->get('tb_pemberitahuan');
			return $query;
		}

		public function getLatihanByBAB($id_bab = null) {
			$query = $this->db->select("*")
						->from('tb_latihan_tugas')
						->join('tb_bab', 'tb_bab.id_bab=tb_latihan_tugas.id_bab')
						->where($id_bab)
						->get();
			return $query;
		}

		public function get_infouk($where = null) {
			$query = $this->db->select("*")
				->from('tb_pemb_uk')
				->join('tb_bab', 'tb_bab.id_bab=tb_pemb_uk.id_bab', 'left')
				->join('tb_kelas', 'tb_kelas.id_kelas=tb_pemb_uk.id_kelas', 'left')
				->where($where)->get();
			return $query;
		}

		public function get_videoID($where = null){
			$query = $this->db->select("*")
				->from('tb_videopembelajaran')
				->join('tb_bab', 'tb_bab.id_bab=tb_videopembelajaran.id_bab')
				->where($where)->get();
			return $query;
		}
		
		public function crud_tugassiswa($typesend) {
			if($typesend == 'do_upload') {
				$this->db->trans_start();
				$path_upload = './storage/tugas_siswa/';
				$file_tugas = $_FILES['file_tugas']['name'];
				if($file_tugas) {
					$config['allowed_types'] = 'pdf|jpg|png|jpeg';
					$config['max_size']      = '2048';
					$config['encrypt_name'] = true;
					$config['upload_path'] = $path_upload;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					$_FILES['file']['name']		= $_FILES['file_tugas']['name'];
					$_FILES['file']['type'] 	= $_FILES['file_tugas']['type'];
					$_FILES['file']['tmp_name'] = $_FILES['file_tugas']['tmp_name'];
					$_FILES['file']['error'] 	= $_FILES['file_tugas']['error'];
					$_FILES['file']['size'] 	= $_FILES['file_tugas']['size'];
					if($this->upload->do_upload('file')) {
						$file_tugas = $this->upload->data();
						$upload_tugas = array(
							'file_tugas' => $file_tugas['file_name'],
							'tipe_file'	=> $file_tugas['file_ext'],
							'ukuran_file' => $file_tugas['file_size']
						);
						$this->db->set($upload_tugas);
					}
				} else {
					$this->db->set('file_tugas', 'default');
				}
				$insert_tugas = [
					'id_tugas' => $this->input->post('id_tugas', true),
					'id_siswa' => $this->input->post('id_siswa', true),
					'tanggal_upload' => date('Y-m-d'),
					'keterangan' => 1
				];

				$this->db->insert('tb_tugas_siswa', $insert_tugas);
				$this->db->trans_complete();
			} elseif($typesend == 'do_update') {
				$this->db->trans_start();
				$tugas_siswa = $this->db->get_where('tb_tugas_siswa', ['id_tugas_siswa' => $this->input->post('id_tugas_siswa_edit', true)])->row_object();
				$date_edited = date('Y-m-d');
				$path_upload = './storage/tugas_siswa/';
				$update_file = $_FILES['update_file']['name'];
				if($update_file) {
					$config['allowed_types'] = 'pdf|jpg|png|jpeg';
					$config['max_size']      = '2048';
					$config['encrypt_name'] = true;
					$config['upload_path'] = $path_upload;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					$_FILES['file']['name']		= $_FILES['update_file']['name'];
					$_FILES['file']['type'] 	= $_FILES['update_file']['type'];
					$_FILES['file']['tmp_name'] = $_FILES['update_file']['tmp_name'];
					$_FILES['file']['error'] 	= $_FILES['update_file']['error'];
					$_FILES['file']['size'] 	= $_FILES['update_file']['size'];

					
					if($this->upload->do_upload('file')) {
						$file_tugassiswa = $tugas_siswa->file_tugas;
                        if ($file_tugassiswa) {
                            @unlink(FCPATH . $path_upload . $file_tugassiswa);
                        }
						$update_file = $this->upload->data();
						$upload_tugas = array(
							'file_tugas' => $update_file['file_name'],
							'tipe_file'	=> $update_file['file_ext'],
							'ukuran_file' => $update_file['file_size'],
							'tanggal_edit' => $date_edited
						);
						$this->db->set($upload_tugas);
						$this->db->where('id_tugas_siswa', htmlspecialchars($this->input->post('id_tugas_siswa_edit', true)));
						$this->db->update('tb_tugas_siswa');
	
					}
				}
				$this->db->trans_complete();

			}
		}
		
		public function input_forum() {
			$data = array(
				'id_bab' => $this->input->post('id_bab', true),
				'id_kelas'	=> $this->input->post('id_kelas', true),
				'pembuat' => $this->input->post('nama_user', true),
				'judul' => $this->input->post('judul_diskusi', true),
				'deskripsi' => $this->input->post('deskripsi_diskusi', true),
			);
			$this->db->insert('tb_info_diskusi', $data);
		}

		public function insert_diskusi() {
			$data = array(
				'parent_diskusi_id' => $this->input->post('parent_diskusi_id', true),
				'id_info'	=> $this->input->post('id_info', true),
				'id_user' => $this->input->post('id_user', true),
				'nama_user' => $this->input->post('nama_user', true),
				'diskusi' => $this->input->post('diskusi', true),
			);
			$this->db->insert('tb_diskusi', $data);
		}

		public function join_diskusi() {
			$this->db->select('*');
			$this->db->from('tb_diskusi');
			$this->db->join('tb_info_diskusi', 'tb_diskusi.id_info = tb_info_diskusi.id_info');
			$this->db->join('tb_bab', 'tb_info_diskusi.id_bab = tb_bab.id_bab');
			return $this->db->get();
		}

		public function get_diskusi($where = null, $order, $desc) {
			$this->db->select(
				'bab.id_bab, bab.bab_ke, bab.bab_judul,
				diskusi.id_info, diskusi.id_bab, diskusi.id_kelas, diskusi.pembuat, diskusi.judul, diskusi.deskripsi, diskusi.tanggal'
			)
			->from('tb_info_diskusi as diskusi')
			->join('tb_bab as bab', 'bab.id_bab=diskusi.id_bab')
			->where($where)
			->order_by('diskusi.'.$order, $desc);
			$query = $this->db->get();
			return $query;
		}

		public function diskusi_forum($where = null, $order, $desc) {
			$this->db->select(
				'forum.id_info, forum.id_bab, forum.id_kelas, forum.pembuat, forum.judul, forum.deskripsi, forum.tanggal,
				diskusi.id_info, diskusi.diskusi_id, diskusi.parent_diskusi_id, diskusi.id_user, diskusi.nama_user, diskusi.diskusi, diskusi.tanggal'
			)
			->from('tb_diskusi as diskusi')
			->join('tb_info_diskusi as forum', 'forum.id_info=diskusi.id_info')
			->where($where)
			->order_by('diskusi.'.$order, $desc);
			$query = $this->db->get();
			return $query;
		}

		
		public function get_fotosiswa($nis) {
			$this->db->select('siswa.siswa_nis, siswa.siswa_image');
			$this->db->from('tb_siswa as siswa');
			$this->db->where('siswa.siswa_nis', $nis);
			$query = $this->db->get();
			return $query;
		}

		public function get_fotoguru($sub_nip) {
			$this->db->select('guru.sub_nip, guru.guru_image');
			$this->db->from('tb_guru as guru');
			$this->db->where('guru.sub_nip', $sub_nip);
			$query = $this->db->get();
			return $query;
		}
	}

?>

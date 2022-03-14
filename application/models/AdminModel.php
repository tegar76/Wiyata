<?php

	class AdminModel extends CI_Model {

		// get data table
		public function get_datatable($table = null)
		{
			$query = $this->db->get($table);
			return $query;
		}

		// query hitung jumlah data table pada halaman dashboard
		public function get_jumlahdata($typehitung = null)
		{
			if ($typehitung == 'sum_guru') {
				$query = $this->get_datatable('tb_guru');
				if ($query->num_rows() > 0) {
					return $query->num_rows();
				} else {
					return 0;
				}
			} elseif ($typehitung == 'sum_kelas') {
				$query = $this->get_datatable('tb_kelas');
				if ($query->num_rows() > 0) {
					return $query->num_rows();
				} else {
					return 0;
				}
			} elseif ($typehitung == 'sum_siswa') {
				$query = $this->get_datatable('tb_siswa');
				if ($query->num_rows() > 0) {
					return $query->num_rows();
				} else {
					return 0;
				}
			} elseif ($typehitung == 'sum_pesan') {
				$query = $this->get_datatable('tb_pesan');
				if ($query->num_rows() > 0) {
					return $query->num_rows();
				} else {
					return 0;
				}
			}
		}

		public function get_siswa($where = null)
		{
			$this->db->select("*");
			$this->db->from('tb_siswa');
			$this->db->join('tb_kelas', 'tb_siswa.id_kelas=tb_kelas.id_kelas');
			$this->db->where($where);
			return $this->db->get();
		}
	

		public function get_guru()
		{
			$this->db->select("*");
			$this->db->from('tb_guru');
			$this->db->join('tb_mapel', 'tb_mapel.id_mapel=tb_guru.id_mapel');
			return $this->db->get();
		}

		public function get_guru_id($where = null)
		{
			$this->db->select("*");
			$this->db->from('tb_guru');
			$this->db->join('tb_mapel', 'tb_mapel.id_mapel=tb_guru.id_mapel');
			$this->db->where($where);
			return $this->db->get();
		}
	
		public function getKelasByGuru($where = null)
		{
			$query	= $this->db->where($where)->get('tb_kelas');
			return $query;
		}
		
		public function getKelasGuru() {
			$this->db->select('tb_kelas.id_kelas, tb_kelas.kelas_nama, tb_guru.id_guru, tb_guru.guru_nama, tb_mapel.id_mapel, tb_mapel.mapel_nama');
			$this->db->from('tb_kelas');
			$this->db->join('tb_guru', 'tb_guru.id_guru=tb_kelas.id_guru');
			$this->db->join('tb_mapel', 'tb_mapel.id_mapel=tb_guru.id_mapel');
			return $this->db->get();
		}

		public function getGuruMapel()
		{
			$this->db->select("*");
			$this->db->from('tb_guru');
			$this->db->join('tb_mapel', 'tb_mapel.id_mapel=tb_guru.id_mapel');
			return $this->db->get();
		}

		public function getUnitByBAB($where = null) {
			$query = $this->db->where('id_bab', $where)->get('tb_unit_bab');
			return $query;
		}
		
		public function getUnitByID($where = null) {
			$query = $this->db->select("*")
						->from('tb_unit_bab')
						->join('tb_bab', 'tb_bab.id_bab=tb_unit_bab.id_bab')
						->where($where)
						->get();
			return $query;
		}
		
		public function getBabID($where = null) {
			$query = $this->db->where('id_bab', $where)->get('tb_bab');
			return $query;
		}

		public function getLatihanByBAB($where = null) {
			$query = $this->db->where('id_bab', $where)->get('tb_latihan_tugas');
			return $query;
		}
		
		public function getLatihanbyID($where = null) {
			$query = $this->db->select("*")
				->from('tb_latihan_tugas')
				->join('tb_bab', 'tb_bab.id_bab=tb_latihan_tugas.id_bab')
				->where($where)
				->get();
			return $query;
		}

		public function get_videoBAB(){
			$query = $this->db->select("*")
				->from('tb_videopembelajaran')
				->join('tb_bab', 'tb_bab.id_bab=tb_videopembelajaran.id_bab')
				->get();
			return $query;
		}

		public function get_videoID($where = null){
			$query = $this->db->select("*")
				->from('tb_videopembelajaran')
				->join('tb_bab', 'tb_bab.id_bab=tb_videopembelajaran.id_bab')
				->where($where)->get();
			return $query;
		}

		public function crudPesanAduan($typesend)
		{
			if ($typesend == 'addpesan') {
				$inputDate = date('Y-m-d H:i:s');
				$dataPesan = [
					'nama' => $this->input->post('nama_user', true),
					'subject' 	=> $this->input->post('subject_name', true),
					'ket' 	=> $this->input->post('message', true),
					'input_date' 	=> $inputDate
				];
		
				$this->db->insert('tb_pesan', $dataPesan);
			} elseif ($typesend == 'deletepesan') {
				$this->db->delete('tb_pesan', ['pesan_id' => $this->input->post('id_pesan', true)]);
			}
		}

	    // CRUD DATA GURU
		public function crudguru($typesend)
		{
			if ($typesend == 'addguru') {
				$this->db->trans_start();
				
				$guru_nip = $this->input->post('nip_guru', true);
				$sub_nip  = substr($guru_nip, 0, 6);

				$upload_image = $_FILES['foto_guru']['name'];
	
				if ($upload_image) {
					$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
					$config['max_size']      = '2048';
					$config['encrypt_name'] = true;
					$config['upload_path'] = './storage/guru/profile';
	
					$this->load->library('upload', $config);
	
					if ($this->upload->do_upload('foto_guru')) {
						$gambar = $this->upload->data();
						$config['image_library'] = 'gd2';
						$config['source_image'] = './storage/guru/profile/' . $gambar['file_name'];
						$config['create_thumb'] = false;
						$config['maintain_ratio'] = false;
						$config['width'] = 300;
						$config['height'] = 300;
						$config['new_image'] = './storage/guru/profile/' . $gambar['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
	
						$new_image = $this->upload->data('file_name');
						$this->db->set('guru_image', $new_image);
					} else {
						return "default.png";
					}
				} else {
					$this->db->set('guru_image', 'default.png');
				}
	
				$savedata = [
					'guru_nip'			=> $this->input->post('nip_guru', true),
					'sub_nip' => $sub_nip,
					'guru_nama' 	=> $this->input->post('nama_guru', true),
					'guru_jenis_kelamin'	=> $this->input->post('jenis_kelamin_guru', true),
					'guru_tempat_lahir'	=> $this->input->post('tempat_lahir', true),
					'guru_tanggal_lahir' => $this->input->post('tanggal_lahir', true),
					'guru_agama'			=> $this->input->post('agama_guru', true),
					'guru_alamat'		=> $this->input->post('alamat_guru', true),
					'guru_phone'		=> $this->input->post('no_telp_guru', true),
					'guru_password'		=> $this->input->post('pass_guru', true),
					'created_at'	=> date('Y-m-d H:i:s'),
					'id_role'		=> $this->input->post('role_guru', true),
					'id_mapel'		=> $this->input->post('guru_mapel', true)
				];
	
				$this->db->insert('tb_guru', $savedata);
				//GET ID GURU
				$guru_id = $this->db->insert_id();
				$kelas	 = $this->input->post('guru_kelas');
				$result	 = array();
				
				if(!empty($kelas)) {
					foreach ($kelas as $row => $value) {
						$result[] = array(
							'id_kelas' => $_POST['guru_kelas'][$row],
							'id_guru'	=> $guru_id
						);
					}
					//MULTIPLE INSERT TO TABEL KELAS
					$this->db->update_batch('tb_kelas', $result, 'id_kelas');
					$this->db->trans_complete();
				} else {
					$this->db->trans_complete();
				}
			} elseif ($typesend == 'updatedataguru') {
				$this->db->trans_start();
				$query_guru = $this->get_guru_id(['id_guru' => $this->input->post('id_guru_edit', true)])->row_object();
				$date_edited = date('Y-m-d H:i:s');
	
				if (!empty(htmlspecialchars($this->input->post('pass_guru_conf')))) {
					$this->db->set('guru_password', md5($this->input->post('pass_guru_conf'), PASSWORD_DEFAULT));
				}
	
			   $upload_image = $_FILES['foto_guru']['name'];
				if ($upload_image) {
					$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
					$config['max_size']      = '2048';
					$config['encrypt_name'] = true;
					$config['upload_path'] = './storage/guru/profile/';
	
					$this->load->library('upload', $config);
	
					if ($this->upload->do_upload('foto_guru')) {
						$gambar = $this->upload->data();
						$config['image_library'] = 'gd2';
						$config['source_image'] = './storage/guru/profile/' . $gambar['file_name'];
						$config['create_thumb'] = false;
						$config['maintain_ratio'] = false;
						$config['width'] = 300;
						$config['height'] = 300;
						$config['new_image'] = './storage/guru/profile/' . $gambar['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
	
						$old_image = $query_guru->guru_image;
						if ($old_image != 'default.png') {
							unlink(FCPATH . './storage/guru/profile/' . $old_image);
						}
						$new_image = $this->upload->data('file_name');
						$this->db->set('guru_image', $new_image);
					} else {
						return "default.png";
					}
				}
	
				$sendsave = [
					'guru_nip'	=> htmlspecialchars($this->input->post('nip_guru_edit', true)),
					'guru_nama'	=> htmlspecialchars($this->input->post('nama_guru_edit', true)),
					'guru_jenis_kelamin'	=> htmlspecialchars($this->input->post('jenis_kelamin_guru_edit', true)),
					'guru_tempat_lahir'	=> htmlspecialchars($this->input->post('tempat_lahir_edit', true)),
					'guru_tanggal_lahir'	=> htmlspecialchars($this->input->post('tanggal_lahir_edit', true)),
					'guru_agama'	=> htmlspecialchars($this->input->post('agama_guru_edit', true)),
					'guru_alamat'	=> htmlspecialchars($this->input->post('alamat_guru_edit', true)),
					'guru_phone'	=> htmlspecialchars($this->input->post('telp_guru_edit', true)),
					'update_at'	=> $date_edited,
					'id_mapel'	=> htmlspecialchars($this->input->post('guru_mapel_edit', true))
				];
	
				$this->db->set($sendsave);
				$this->db->where('id_guru', htmlspecialchars($this->input->post('id_guru_edit', true)));
				$this->db->update('tb_guru');
	
				//GET ID GURU
				$guru_id = $this->input->post('id_guru_edit', true);
				$kelas	 = $this->input->post('guru_kelas_edit');
				$result	 = array();
				
				if(!empty($kelas)) {
					foreach ($kelas as $row => $value) {
						$result[] = array(
							'id_kelas' => $_POST['guru_kelas_edit'][$row],
							'id_guru'	=> $guru_id
						);
					}
					//MULTIPLE INSERT TO TABEL KELAS
					$this->db->update_batch('tb_kelas', $result, 'id_kelas');
					$this->db->trans_complete();
				} else {
					$this->db->trans_complete();
				}
			} elseif ($typesend == 'hapusguru') {
				$this->db->delete('tb_guru', ['id_guru' => htmlspecialchars($this->input->post('guru_id', true))]);
			}
		}


		public function crudsiswa($typesend = null) 
		{
			if ($typesend == 'tambahsiswa') {
				$date_created	= date("Y-m-d");
				$date_edited	= null;
	
				$upload_image = $_FILES['foto_siswa']['name'];
	
				if ($upload_image) {
					$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
					$config['max_size']      = '2048';
					$config['encrypt_name'] = true;
					$config['upload_path'] = './storage/siswa/profile/';
	
					$this->load->library('upload', $config);
	
					if ($this->upload->do_upload('foto_siswa')) {
						$gambar = $this->upload->data();
						$config['image_library'] = 'gd2';
						$config['source_image'] = './storage/siswa/profile/' . $gambar['file_name'];
						$config['create_thumb'] = false;
						$config['maintain_ratio'] = false;
						$config['width'] = 300;
						$config['height'] = 300;
						$config['new_image'] = './storage/siswa/profile/' . $gambar['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
	
						$new_image = $this->upload->data('file_name');
						$this->db->set('siswa_image', $new_image);
					} else {
						return "default.png";
					}
				} else {
					$this->db->set('siswa_image', 'default.png');
				}
	
				
				$savedata = [
					'id_kelas'	=> $this->input->post('kelas_siswa', true),
					'siswa_nis'		=> $this->input->post('nis_siswa', true),
					'siswa_nisn'		=> $this->input->post('nisn_siswa', true),
					'siswa_nama' 		=> $this->input->post('nama_siswa', true),
					'siswa_tempat_lahir'	=> $this->input->post('tempat_lahir', true),
					'siswa_tanggal_lahir'	=> $this->input->post('tanggal_lahir', true),
					'siswa_agama'	=> $this->input->post('agama_siswa', true),
					'siswa_jenis_kelamin'	=> $this->input->post('jenis_kelamin_siswa', true),
					'siswa_alamat'	=> $this->input->post('alamat_siswa', true),
					'siswa_phone'	=> $this->input->post('no_telp_siswa', true),
					'siswa_ortu'	=> $this->input->post('nama_ortu_siswa', true),
					'siswa_ortu_phone'	=> $this->input->post('no_telp_ortu', true),
					'siswa_ortu_alamat'	=> $this->input->post('alamat_ortu', true),
					'siswa_password'	=> $this->input->post('pass_siswa_conf', true),
					'created_at'	=> $date_created
				];
	
				$this->db->insert('tb_siswa', $savedata);
			} elseif ($typesend == 'updatedatasiswa') {
				$query_siswa = $this->get_siswa([
					'tb_siswa.id_siswa'	=>	$this->input->post('id_siswa_edit', true),
					'tb_kelas.id_kelas'	=>	$this->input->post('kelas_siswa_edit', true)
				])->row_object();
	
				$query_image = $query_siswa;
				$update_at	= date('Y-m-d H:i:s');
	
				if (!empty(htmlspecialchars($this->input->post('pass_siswa_conf')))) {
					$this->db->set('siswa_password', md5($this->input->post('pass_siswa_conf'), PASSWORD_DEFAULT));
				}
	
				$upload_image = $_FILES['foto_siswa']['name'];
				if ($upload_image) {
					$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
					$config['max_size']      = '2048';
					$config['encrypt_name'] = true;
					$config['upload_path'] = './storage/siswa/profile/';
	
					$this->load->library('upload', $config);
	
					if ($this->upload->do_upload('foto_siswa')) {
						$gambar = $this->upload->data();
						$config['image_library'] = 'gd2';
						$config['source_image'] = './storage/siswa/profile/' . $gambar['file_name'];
						$config['create_thumb'] = false;
						$config['maintain_ratio'] = false;
						$config['width'] = 300;
						$config['height'] = 300;
						$config['new_image'] = './storage/siswa/profile/' . $gambar['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
	
						$old_image = $query_image->siswa_image;
						if ($old_image != 'default.png') {
							@unlink(FCPATH . './storage/siswa/profile/' . $old_image);
						}
						$new_image = $this->upload->data('file_name');
						$this->db->set('siswa_image', $new_image);
					} else {
						return "default.png";
					}
				}
	
				$savedata = [
					'id_kelas'	=> $this->input->post('kelas_siswa_edit', true),
					'siswa_nis'		=> $this->input->post('nis_siswa_edit', true),
					'siswa_nisn'		=> $this->input->post('nisn_siswa_edit', true),
					'siswa_nama' 		=> $this->input->post('nama_siswa_edit', true),
					'siswa_tempat_lahir'	=> $this->input->post('tempat_lahir_edit', true),
					'siswa_tanggal_lahir'	=> $this->input->post('tanggal_lahir_edit', true),
					'siswa_agama'	=> $this->input->post('agama_siswa_edit', true),
					'siswa_jenis_kelamin'	=> $this->input->post('jenis_kelamin_siswa_edit', true),
					'siswa_alamat'	=> $this->input->post('alamat_siswa_edit', true),
					'siswa_phone'	=> $this->input->post('no_telp_siswa_edit', true),
					'siswa_ortu'	=> $this->input->post('ortu_siswa_edit', true),
					'siswa_ortu_phone'	=> $this->input->post('telp_ortu_edit', true),
					'siswa_ortu_alamat'	=> $this->input->post('alamat_ortu_edit', true),
					'siswa_password'	=> $this->input->post('pass_siswa', true),
					'update_at'	=> $update_at
				];
	
				$this->db->set($savedata);
				$this->db->where('id_siswa', htmlspecialchars($this->input->post('id_siswa_edit', true)));
				$this->db->update('tb_siswa');
			} elseif ($typesend == 'hapussiswa') {
				$this->db->delete('tb_siswa', ['id_siswa' => $this->input->post('id_siswa', true)]);
			}
		}


		public function crudBahanAjar($typesend)
    	{
			if ($typesend == 'tambah') {

				// Input BAB dan rangkuman BAB
				$this->db->trans_start();
				$bab_ke	= $this->input->post('bab_ke', true);
				$path_upload = './storage/bahanajar/BAB_' . $bab_ke . '/rangkuman/';
				$uploadRangkuman = $_FILES['rangkuman_bab']['name'];
				if($uploadRangkuman) {
					$config['allowed_types'] = 'pdf';
					$config['max_size']      = '2048';
					$config['encrypt_name'] = true;
					$config['upload_path'] = $path_upload;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('rangkuman_bab')) {
						$dataRangkuman = $this->upload->data('file_name');
						$this->db->set('rangkuman_bab', $dataRangkuman);
					} else {
						return 'default.pdf';
					}
					
				} else {
					$this->db->set('rangkuman_bab', 'default.pdf');
				}

				$dataBAB = [
					'id_mapel' 	=> $this->input->post('mapel_bab', true),
					'bab_ke'	=> $bab_ke,
					'bab_judul'	=> 	$this->input->post('judul_bab', true),
					'created_at' => date('Y-m-d')
				];

				$this->db->insert('tb_bab', $dataBAB);
				$id_bab = $this->db->insert_id();
				$this->upload_unitbab($id_bab, $bab_ke);
				$this->upload_latihan($id_bab, $bab_ke);
				$this->db->trans_complete();
			} else if($typesend == 'update') {
				$this->db->trans_start();
    			$update_at = date('Y-m-d');
    			$query_bab = $this->db->get_where('tb_bab', ['id_bab' => $this->input->post('id_bab_edit',  true)])->row_array();
    			// updatate rangkuman
    			$path_rangkuman = './storage/bahanajar/BAB_' . $query_bab['bab_ke'] . '/rangkuman/';
    			$upload_rangkuman = $_FILES['rangkuman_bab']['name'];
    			if ($upload_rangkuman) {
    				$config['allowed_types'] = 'pdf';
    				$config['max_size']      = '2048';
    				$config['encrypt_name'] = true;
    				$config['upload_path'] = $path_rangkuman;
    
    				$this->load->library('upload', $config);
    				$this->upload->initialize($config);
    
    				if ($this->upload->do_upload('rangkuman_bab')) {
    					$rangkuman_lama = $query_bab['rangkuman_bab'];
    					if ($rangkuman_lama != 'default.pdf') {
    						@unlink(FCPATH . $path_rangkuman . $rangkuman_lama);
    					}
    					$rangkuman_name = $this->upload->data('file_name');
    					$this->db->set('rangkuman_bab', $rangkuman_name);
    				} else {
    					return 'default.pdf';
    				}
    			}
    
    			$update_bab = [
    				'bab_judul'	=> 	$this->input->post('judul_bab_edit', true),
    				'update_at' => $update_at
    			];
    			$this->db->set($update_bab);
    			$this->db->where('id_bab', htmlspecialchars($this->input->post('id_bab_edit')));
    			$this->db->update('tb_bab');
    
    			// update unit
    			$path_unit = './storage/bahanajar/BAB_' . $query_bab['bab_ke'] . '/unit/';
    			$update_unitbab = $_FILES['unit_bab']['name'];
    			if ($update_unitbab) {
    				$config['allowed_types'] = 'pdf';
    				$config['max_size']      = '2048';
    				$config['encrypt_name'] = true;
    				$config['upload_path'] = $path_unit;
    
    				$this->load->library('upload', $config);
    				$this->upload->initialize($config);
    
    				$id_unit = $this->input->post('id_unit_edit', true);
    				foreach ($id_unit as $row => $value) {
    					if (!empty($_FILES['unit_bab']['name'][$row])) {
    						$query_unit = $this->db->get_where('tb_unit_bab', ['id_unit_bab' => $_POST['id_unit_edit'][$row]])->row_array();
    						$_FILES['file']['name']		= $_FILES['unit_bab']['name'][$row];
    						$_FILES['file']['type'] 	= $_FILES['unit_bab']['type'][$row];
    						$_FILES['file']['tmp_name'] = $_FILES['unit_bab']['tmp_name'][$row];
    						$_FILES['file']['error'] 	= $_FILES['unit_bab']['error'][$row];
    						$_FILES['file']['size'] 	= $_FILES['unit_bab']['size'][$row];
    						if ($this->upload->do_upload('file')) {
    							@unlink(FCPATH . $path_unit . $query_unit['unit_upload']);
    							$updateUnit = $this->upload->data();
    							$result = array(
    								'unit_upload' => $updateUnit['file_name'],
    								'tipe_berkas' => $updateUnit['file_ext'],
    								'ukuran_berkas'	=> $updateUnit['file_size'],
    							);
    							$this->db->where('id_unit_bab',  $_POST['id_unit_edit'][$row]);
    							$this->db->update('tb_unit_bab', $result);
    						}
    					}
    				}
    			}
    
    			$path_latihan = './storage/bahanajar/BAB_' . $query_bab['bab_ke'] . '/latihan/';
    			$update_latihan = $_FILES['latihan_bab']['name'];
    			if ($update_latihan) {
    				$config['allowed_types'] = 'pdf';
    				$config['max_size']      = '2048';
    				$config['encrypt_name'] = true;
    				$config['upload_path'] = $path_latihan;
    
    				$this->load->library('upload', $config);
    				$this->upload->initialize($config);
    
    				$id_tugas = $this->input->post('id_tugas', true);
    				foreach ($id_tugas as $row => $value) {
    					if (!empty($_FILES['latihan_bab']['name'][$row])) {
    						$query_latihan =  $this->db->get_where('tb_latihan_tugas', ['id_tugas' => $_POST['id_tugas'][$row]])->row_array();
    						$_FILES['file']['name']		= $_FILES['latihan_bab']['name'][$row];
    						$_FILES['file']['type'] 	= $_FILES['latihan_bab']['type'][$row];
    						$_FILES['file']['tmp_name'] = $_FILES['latihan_bab']['tmp_name'][$row];
    						$_FILES['file']['error'] 	= $_FILES['latihan_bab']['error'][$row];
    						$_FILES['file']['size'] 	= $_FILES['latihan_bab']['size'][$row];
    						if ($this->upload->do_upload('file')) {
    							@unlink(FCPATH . $path_latihan . $query_latihan['file_tugas']);
    							$updateLatihan = $this->upload->data();
    							$result = array(
    								'deskripsi_tugas'	=> $_POST['deskripsi_latihan'][$row],
    								'file_tugas'	=> $updateLatihan['file_name'],
    								'tipe_berkas'	=> $updateLatihan['file_ext'],
    								'ukuran_berkas'	=> $updateLatihan['file_size'],
    							);
    							$this->db->where('id_tugas', $_POST['id_tugas'][$row]);
    							$this->db->update('tb_latihan_tugas', $result);
    						}
    					}
    				}
    			}
    
    			$this->db->trans_complete();
				
			} else if($typesend == 'hapus') {

				// get data bab
				$id_bab = $this->input->post('id_bab', true);
				$data_bab = $this->getBabID($id_bab)->row_array();

				// path upload bahan ajar
				$path_latihan = './storage/bahanajar/BAB_' . $data_bab['bab_ke'] .'/latihan/';
				$path_unit = './storage/bahanajar/BAB_' . $data_bab['bab_ke'] .'/unit/';
				$path_rangkuman = './storage/bahanajar/BAB_' . $data_bab['bab_ke'] .'/rangkuman/';

				// delete rangkuman bab 
				if (!empty($data_bab)) {
					@unlink(FCPATH . $path_rangkuman . $data_bab['rangkuman_bab']);
					// hapus bab
					$this->db->where_in('id_bab', $id_bab);
					$this->db->delete('tb_bab');
				}

				// delete latihan tugas
				$latihan_tugas = $this->getLatihanByBAB($id_bab)->result_array();
				if(!empty($latihan_tugas)) {
					foreach ($latihan_tugas as $row ) {
						@unlink(FCPATH . $path_latihan . $row['file_tugas']);
					}
					// hapus latihan tugas
					$this->db->where_in('id_bab', $id_bab);
					$this->db->delete('tb_latihan_tugas');
				}

				// delete unit bab
				$unit_bab = $this->getUnitByBAB($id_bab)->result_array();
				if (!empty($unit_bab)) {
					foreach ($unit_bab as $row ) {
						@unlink(FCPATH . $path_unit . $row['unit_upload']);
					}
					// hapus unit bab
					$this->db->where_in('id_bab', $id_bab);
					$this->db->delete('tb_unit_bab');
				}
			}
		}


		// Upload Unit BAB
		public function upload_unitbab($id_bab = null, $bab_ke = null)
		{	
			$this->db->trans_start();
			$upload_path = 	'./storage/bahanajar/BAB_' . $bab_ke .'/unit/';
			$upload_unitbab = $_FILES['unit_bab']['name'];
			if ($upload_unitbab) {
				$config['allowed_types'] = 'pdf';
				$config['max_size']      = '2048';
				$config['encrypt_name'] = true;
				$config['upload_path'] = $upload_path ;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				$jumlah_unit = count($_FILES['unit_bab']['name']);
				for ($i = 0; $i < $jumlah_unit; $i++) {
					if (!empty($_FILES['unit_bab']['name'][$i])) {
						$_FILES['file']['name']		= $_FILES['unit_bab']['name'][$i];
						$_FILES['file']['type'] 	= $_FILES['unit_bab']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['unit_bab']['tmp_name'][$i];
						$_FILES['file']['error'] 	= $_FILES['unit_bab']['error'][$i];
						$_FILES['file']['size'] 	= $_FILES['unit_bab']['size'][$i];

						if ($this->upload->do_upload('file')) {
							$uploadUnitBAB = $this->upload->data();
							$j = $i + 1;
							$data = [
								'id_bab' => $id_bab,
								'unit_ke' => 'Unit ' . $j,
								'unit_upload' => $uploadUnitBAB['file_name'],
								'tipe_berkas' => $uploadUnitBAB['file_ext'],
								'ukuran_berkas'	=> $uploadUnitBAB['file_size'],
							];
							$this->db->insert('tb_unit_bab', $data);
						}
					}
				}
			}
			$this->db->trans_complete();
		}

		// Upload latihan tugas
		public function upload_latihan($id_bab, $bab_ke)
		{
			$this->db->trans_start();
			$upload_path = 	'./storage/bahanajar/BAB_' . $bab_ke .'/latihan/';
			$upload_latihan = $_FILES['latihan_bab']['name'];
            if ($upload_latihan) {
                $config['allowed_types'] = 'pdf';
                $config['max_size']      = '2048';
                $config['encrypt_name'] = true;
                $config['upload_path'] = $upload_path;

                $this->load->library('upload', $config);
				$this->upload->initialize($config);

                $jumlah_latihan = count($_FILES['latihan_bab']['name']);
                $deskripsi_tugas = $this->input->post('deskripsi_latihan', true);
                for ($i = 0; $i < $jumlah_latihan; $i++) {
                    if (!empty($_FILES['latihan_bab']['name'][$i])) {
                        $_FILES['file']['name']		= $_FILES['latihan_bab']['name'][$i];
                        $_FILES['file']['type'] 	= $_FILES['latihan_bab']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['latihan_bab']['tmp_name'][$i];
                        $_FILES['file']['error'] 	= $_FILES['latihan_bab']['error'][$i];
                        $_FILES['file']['size'] 	= $_FILES['latihan_bab']['size'][$i];

                        if ($this->upload->do_upload('file')) {
                            $dataLatihan = $this->upload->data();
							$j = $i+1;
							$data = [
								'id_bab'	=> $id_bab,
								'latihan_tugas_ke'	=> 'Latihan ' . $j,
								'deskripsi_tugas'	=> $deskripsi_tugas[$i],
								'file_tugas'	=> $dataLatihan['file_name'],
								'tipe_berkas'	=> $dataLatihan['file_ext'],
								'ukuran_berkas'	=> $dataLatihan['file_size'],
							];
							$this->db->insert('tb_latihan_tugas', $data);
                        }
                    }
                }
            }
			$this->db->trans_complete();
		}


		public function crud_video($typesend = null) {
			if ($typesend == 'tambah_video') {

				$date_created = date('Y-m-d');
				$url_video = $this->input->post('link_video', true);
				$youtube = preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url_video,$url_match);
				$embed_url = 'https://www.youtube.com/embed/'.$url_match[1];
				$insert_video = array(
					'id_bab' => $this->input->post('video_bab', true),
					'judul_video' => $this->input->post('judul_video', true),
					'link_video' => $embed_url,
					'dibuat_pada' => $date_created
				);
				$this->db->insert('tb_videopembelajaran', $insert_video);

			} elseif ($typesend == 'update_video') {
				$date_edit	= date('Y-m-d');
				$id_video 	= $this->input->post('id_video_edit', true);
				$data_video = $this->db->get_where('tb_videopembelajaran', ['id_video' => $id_video])->row_array();

				$url_video 	= $this->input->post('link_video_edit', true);
				if($url_video == $data_video['link_video']) {
					$this->db->set('link_video', $url_video);
				} else {
					$youtube 	= preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url_video,$url_match);
					$embed_url = 'https://www.youtube.com/embed/'.$url_match[1];
					$this->db->set('link_video', $embed_url);
				}
				$update_video = array(
					'judul_video' => $this->input->post('judul_video_edit', true),
					'diubah_pada' => $date_edit
				);
				$this->db->set($update_video);
				$this->db->where('id_video', $id_video);
				$this->db->update('tb_videopembelajaran');

			} elseif ($typesend == 'hapus_video') {

				$this->db->delete('tb_videopembelajaran', ['id_video' => $this->input->post('id_video', true)]);

			}
		}
	}

?>

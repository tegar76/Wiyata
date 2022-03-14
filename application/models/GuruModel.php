<?php

	class GuruModel extends CI_Model {
		
		// get data table
		public function get_datatable($table = null)
		{
			$query = $this->db->get($table);
			return $query;
		}

		public function get_gurumapel($guru_nip = null)
		{
			$this->db->select("*");
			$this->db->from('tb_guru');
			$this->db->join('tb_mapel', 'tb_mapel.id_mapel=tb_guru.id_mapel');
			$this->db->where('guru_nip', $guru_nip);
			return $this->db->get();
		}

		public function get_pemberitahuan($id_guru = null)
		{
			$this->db->select("*");
			$this->db->from('tb_pemberitahuan');
			$this->db->join('tb_kelas', 'tb_kelas.id_kelas=tb_pemberitahuan.id_kelas');
			$this->db->join('tb_bab', 'tb_bab.id_bab=tb_pemberitahuan.id_bab');
			$this->db->where('tb_kelas.id_guru', $id_guru);
			return $this->db->get();
		}

		public function get_KelasByGuru($id_guru = null) 
		{	
			$query = $this->db->get_where('tb_kelas', ['id_guru' => $id_guru ]);
			return $query;
		}

		public function get_pemberitahuanID($where = null)
		{
			$query = $this->db->select("*")
						->from('tb_pemberitahuan')
						->join('tb_kelas', 'tb_kelas.id_kelas=tb_pemberitahuan.id_kelas')
						->where($where)
						->get();
			return $query;
		}

		public function crud_pemberitahuan($typesend = null) 
		{
			if($typesend == 'tambah') {
				$this->db->trans_start();
				$kelas	 = $this->input->post('kelas', true);
				$result	 = array();
				foreach ($kelas as $row => $value) {
					$result[] = array(
						'id_kelas' 	=> $_POST['kelas'][$row],
						'id_bab'	=> $this->input->post('bab', true),
						'pemberitahuan' 	=> $this->input->post('pemberitahuan', true),
						'link_pemberitahuan' => $this->input->post('link_pemberitahuan', true),
						'dibuat_pada'	=> date('Y-m-d'),
					);
				}
				$this->db->insert_batch('tb_pemberitahuan', $result);
				$this->db->trans_complete();
			} elseif ($typesend == 'update') {
				$diupdate_pada = date('Y-m-d');
				$update_data = [
					'id_bab'	=> $this->input->post('bab_edit', true),
					'pemberitahuan' 	=> $this->input->post('pemberitahuan_edit', true),
					'link_pemberitahuan' => $this->input->post('link_pemberitahuan_edit', true),
					'diubah_pada'	=> $diupdate_pada,
				];
				$this->db->where('id_pemberitahuan', htmlspecialchars($this->input->post('id_pemberitahuan_edit', true)));
				$this->db->update('tb_pemberitahuan', $update_data);
			} elseif ($typesend == 'hapus') {
				$this->db->delete('tb_pemberitahuan', ['id_pemberitahuan' => $this->input->post('id_pemberitahuan', true)]);
			}
		}

		// Get Siswa
		public function getAllStudent($class = null) {
			$this->db->order_by('tb_siswa.siswa_nama', 'asc');
			$this->db->where('tb_siswa.id_kelas', $class);
			$this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas', 'left');
			return $this->db->get('tb_siswa')->result_object();
		}

		// Get Kelas By Guru
		public function getKelasByGuru($id_guru) {
			$query = $this->db->get_where('tb_kelas', ['id_guru' => $id_guru]);
			if( !empty($query) ) {
				return $query->result_array();
			} else {
				return false;
			}
		}


		public function get_pemb_tugas($where = null) {
			$query = $this->db->select('*')
				->from('tb_pemb_tugas')
				->join('tb_latihan_tugas', 'tb_latihan_tugas.id_tugas = tb_pemb_tugas.id_tugas', 'left')
				->join('tb_kelas', 'tb_kelas.id_kelas = tb_pemb_tugas.id_kelas', 'left')
				->join('tb_bab', 'tb_bab.id_bab = tb_pemb_tugas.id_bab', 'left')
				->where($where)
				->get();
			return $query;
		}

		public function get_pemberitahuan_tugas() {
			$query = $this->db->select('*')
				->from('tb_pemb_tugas')
				->join('tb_latihan_tugas', 'tb_latihan_tugas.id_tugas = tb_pemb_tugas.id_tugas', 'left')
				->join('tb_kelas', 'tb_kelas.id_kelas = tb_pemb_tugas.id_kelas', 'left')
				->join('tb_bab', 'tb_bab.id_bab = tb_pemb_tugas.id_bab', 'left')
				->get();
			return $query;
		}

		public function get_tugas_siswa($where= null) {
			$this
			->db
			->select('*')
			->from('tb_siswa')
			->join('tb_tugas_siswa', 'tb_tugas_siswa.id_siswa= tb_siswa.id_siswa', 'left outer')
			->where($where);
			$q = $this->db->get();
			return $q;
		}

		public function crud_cektugas($typesend = null) {
			
			if($typesend == 'cek_tugas') {
				$id_bab = $this->input->post('bab', true);
				$latihan_ke = $this->input->post('latihan_ke', true);
				$get_latihan = $this->db->where('id_bab', $id_bab)
				->where_in('latihan_tugas_ke', $latihan_ke)->get('tb_latihan_tugas')->row_array();

				$insert_data = [
					'id_kelas' 	=> $this->input->post('kelas', true),
					'id_bab'	=> $id_bab,
					'id_tugas'	=> $get_latihan['id_tugas'],
					'mapel'		=> $this->input->post('mapel', true),
					'pemberitahuan' => $get_latihan['deskripsi_tugas'],
					'tanggal_dibuat'	=> date('Y-m-d')
				];

				$this->db->insert('tb_pemb_tugas', $insert_data);

			} else if($typesend == 'update_pemb') {
				$id_pemb_tugas = htmlspecialchars($this->input->post('id_pemb_tugas', true));
				$update_data = [
					'pemberitahuan' =>	$this->input->post('pemberitahuan_edit',true),
					'deadline_tugas'	=>	$this->input->post('deadline_tugas', true),
					'tanggal_diedit'	=> date('Y-m-d') 	
				];
				$this->db->where('id_pemb_tugas', $id_pemb_tugas);
				$this->db->update('tb_pemb_tugas', $update_data);
			}
		}

		public function insert_nilai_tugas($typesend = null)
		{
			if($typesend == 'input_nilai01') {
				$id_tugas_siswa = htmlspecialchars($this->input->post('id_tugas_siswa', true));
				$update_data = [
					'komentar_guru' =>	$this->input->post('komentar_guru',true),
					'nilai_tugas'	=>	$this->input->post('nilai_tugas', true),
					'keterangan'	=> 2 	
				];
				$this->db->where('id_tugas_siswa', $id_tugas_siswa);
				$this->db->update('tb_tugas_siswa', $update_data);
			} elseif($typesend == 'input_nilai02') {
				$id_siswa = htmlspecialchars($this->input->post('id_siswa', true));
				$id_tugas = htmlspecialchars($this->input->post('id_tugas', true));
				$insert_nilai = array(
					'id_tugas'	=> $id_tugas,
					'id_siswa' => $id_siswa,
					'komentar_guru' => $this->input->post('input_komentar_guru', true),
					'nilai_tugas'	=> $this->input->post('input_nilai_tugas', true),
					'keterangan' => 2
				);
				$this->db->insert('tb_tugas_siswa', $insert_nilai);
			}
		}

		public function get_pemberitahuan_uk() {
			$query = $this->db->select('*')
				->from('tb_pemb_uk')
				->join('tb_kelas', 'tb_kelas.id_kelas = tb_pemb_uk.id_kelas', 'left')
				->join('tb_bab', 'tb_bab.id_bab = tb_pemb_uk.id_bab', 'left')
				->get();
			return $query;
		}

		public function pemb_kompetensi_id($where = null) {
			$query = $this->db->select('*')
				->from('tb_pemb_uk')
				->join('tb_kelas', 'tb_kelas.id_kelas = tb_pemb_uk.id_kelas', 'left')
				->join('tb_bab', 'tb_bab.id_bab = tb_pemb_uk.id_bab', 'left')
				->where($where)
				->get();
			return $query;
		}

		public function get_uk_siswa($where= null) {
			$query = $this->db->select('*')
				->from('tb_siswa')
				->join('tb_uk_siswa', 'tb_uk_siswa.id_siswa= tb_siswa.id_siswa', 'left outer')
				->where($where)->get();
			return $query;
		}

		public function crud_cekkompetensi($typesend) {
			if($typesend == 'cek_uk') {
				$insert_data = [
					'id_kelas'	=> $this->input->post('kelas', true),
					'id_bab'	=> $this->input->post('bab_ke', true),
					'mapel'		=> $this->input->post('mapel', true),
					'keterangan' => 1,
					'tanggal_dibuat'	=> date('Y-m-d')
				];
				$this->db->insert('tb_pemb_uk', $insert_data);
			} elseif ($typesend == 'do_updateuk') {
				$id_pemb_uk = htmlspecialchars($this->input->post('id_pemb_uk', true));

				$tanggal_mulai = $this->input->post('tanggal_mulai',true);
				if(empty($tanggal_mulai)) {
					$this->db->set('tanggal_mulai', null);
				} else {
					$this->db->set('tanggal_mulai', $tanggal_mulai);
				}

				$waktu_mulai = $this->input->post('jam_mulai', true);
				if($waktu_mulai == '00:00') {
					$this->db->set('waktu_mulai', null);
				} else {
					$this->db->set('waktu_mulai', $waktu_mulai);
				}

				$waktu_selesai = $this->input->post('jam_selesai', true);
				if($waktu_selesai == '00:00') {
					$this->db->set('waktu_selesai', null);
				} else {
					$this->db->set('waktu_selesai', $waktu_selesai);
				}

				$date_edit = ['tanggal_diedit'	=> date('Y-m-d')];
				$this->db->set($date_edit);
				$this->db->where('id_pemb_uk', $id_pemb_uk);
				$this->db->update('tb_pemb_uk');
			}
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
		
		public function ekspor_latihan($id)
    	{
    		$this->db->select('
    			bab.id_bab, bab.bab_ke, bab.bab_judul,
    			kelas.id_kelas, kelas.kelas_nama,
    			tugas.id_tugas, tugas.latihan_tugas_ke,
    			info.id_pemb_tugas, info.id_bab, info.id_kelas, info.id_tugas, info.mapel')
    			->from('tb_pemb_tugas as info')
    			->join('tb_bab as bab', 'bab.id_bab=info.id_bab')
    			->join('tb_kelas as kelas', 'kelas.id_kelas=info.id_kelas')
    			->join('tb_latihan_tugas as tugas', 'tugas.id_tugas=info.id_tugas')
    			->where(['info.id_pemb_tugas' => $id]);
    		$query = $this->db->get();
    		return $query;
    	}
    
    	public function ekspor_kompetensi($id)
    	{
    		$this->db->select('
    			bab.id_bab, bab.bab_ke, bab.bab_judul,
    			kelas.id_kelas, kelas.kelas_nama,
    			info.id_pemb_uk, info.id_bab, info.id_kelas, info.mapel, info.tanggal_mulai')
    			->from('tb_pemb_uk as info')
    			->join('tb_bab as bab', 'bab.id_bab=info.id_bab')
    			->join('tb_kelas as kelas', 'kelas.id_kelas=info.id_kelas')
    			->where(['info.id_pemb_uk' => $id]);
    		$query = $this->db->get();
    		return $query;
    	}
	}
?>

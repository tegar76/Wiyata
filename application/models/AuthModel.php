<?php

	class AuthModel extends CI_Model {
		
		// fungsi mengambil data guru untuk login berdasarkan NIP Guru
		public function getGuruByNIP($nipGuru = null) {
			$query = $this->db->where('sub_nip', $nipGuru)
					->get('tb_guru')->row_object();
			return $query;
		}

		// fungsi mengambil data siswa untuk login berdasarkan NIS Siswa
		public function getSiswaByNIS($nisSiswa) {
			$query = $this->db->where('siswa_nis', $nisSiswa)
			->get('tb_siswa')->row_object();
			return $query;
		}

		// fungsi mengambil data admin untuk login berdasarkan username admin
		public function getAdminByUsername($username) {
			$query = $this->db->where('username', $username)
			->get('tb_admin')->row_object();
			return $query;
		}
	}
?>

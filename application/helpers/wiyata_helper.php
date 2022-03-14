<?php

	function is_admin_login()
	{
		$ci = get_instance();
		$username	= $ci->session->userdata('username');
		$dataAdmin	= $ci->db->get_where('tb_admin', ['username' => $username])->row_array();

		if( !$ci->session->userdata('logged_in')) {
			redirect('Admin/AuthAdmin');
		} elseif(empty($dataAdmin)) {
			$ci->session->sess_destroy();
			redirect('Admin/AuthAdmin');
		}
	}

	function is_admin()
	{
		$ci = get_instance();
		$leveluser = $ci->session->userdata('level');
		
		if ($leveluser != "admin") {
			redirect('block');
		} 
	}
	
	function is_guru_login()
	{
		$ci = get_instance();
		$nip	= $ci->session->userdata('nip');
		$dataGuru	= $ci->db->get_where('tb_guru', ['guru_nip' => $nip])->row_array();

		if( !$ci->session->userdata('logged_in')) {
			redirect('auth');
		} elseif(empty($dataGuru)) {
			$ci->session->sess_destroy();
			redirect('Auth');
		}
	}

	function is_guru()
	{
		$ci = get_instance();
		$leveluser = $ci->session->userdata('level');
		
		if ($leveluser != "guru") {
			redirect('block');
		} 
	}

	function is_siswa_login()
	{
		$ci = get_instance();
		$nis	= $ci->session->userdata('nis');
		$userSiswa	= $ci->db->get_where('tb_siswa', ['siswa_nis' => $nis])->row_array();

		if( !$ci->session->userdata('logged_in')) {
			redirect('auth');
		} elseif(empty($userSiswa)) {
			$ci->session->sess_destroy();
			redirect('Auth');
		}
	}

	function is_siswa()
	{
		$ci = get_instance();
		$leveluser = $ci->session->userdata('level');
		
		if ($leveluser != "siswa") {
			redirect('block');
		}
	}
?>

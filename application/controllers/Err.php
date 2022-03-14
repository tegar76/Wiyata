<?php

class Err extends CI_Controller {

    public function  __construct() {
        parent::__construct();

    }

    public function block(){
		
        $data = [
            'title' => 'Access Denied'
        ];
		$this->load->view('error/block', $data);
    }

	public function notfound() {
		$data = [
			'title' => '404 - Halaman Tidak Ditemukan'
		];
		$this->load->view('error/error_404', $data);
	}
}

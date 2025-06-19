<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		// $this->load->view('welcome_message');
		$data = [
			"status" => "200",
			"msg"    => "Welcome to backend API"
		];
		echo json_encode($data);
	}
}

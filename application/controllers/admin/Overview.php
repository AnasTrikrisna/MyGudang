<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model("Model_user");
		if($this->Model_user->NotLogin()) redirect(site_url('admin/login'));
	}

	public function index()
	{
        // load view admin/overview.php
        $this->load->view("admin/menu");
	}
}

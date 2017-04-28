<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barrier extends CI_Controller
{
	  public function __construct()
	  {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
	  }

	  public function landing_page()
	  {
		$this->load->view('landing_page.php');
	  }

}

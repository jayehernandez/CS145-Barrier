<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barrier extends CI_Controller
{
  public function __construct()
  {
	parent::__construct();
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
	$this->load->library('session');
	$this->load->helper('security');
	$this->load->helper('form');
	$this->load->helper('url');
	$this->load->helper('html');
	$this->load->database();
	$this->load->model('Barrier_model');
  }

  public function landing_page()
  {
	$markers = $this->Barrier_model->get_markers();
	$data = array(
		'markers' => $markers
		);
	$this->load->view('landing_page.php', $data);
  }

	public function add_marker()
	{
	$barrier_id = $this->security->xss_clean($this->input->post("ajax_barrier_id"));
	$latitude = $this->security->xss_clean($this->input->post("ajax_latitude"));
	$longitude = $this->security->xss_clean($this->input->post("ajax_longitude"));
	$data = array(
     	'barrier_id' => $barrier_id,
     	'barrier_longitude' => $longitude,
     	'barrier_latitude' => $latitude,
		'barrier_status' => 1
  		);
	$this->Barrier_model->insert_marker($data);
	}
}

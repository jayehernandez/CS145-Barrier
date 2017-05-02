<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barrier_model extends CI_Model
{
  function __construct()
  {
   	parent::__construct();
  }

  function insert_marker($data)
  {
   	$this->db->insert('barrier_data', $data);
  }

  function get_markers()
  {
  	$this->db->select('*');
	$this->db->from('barrier_data');
	$query = $this->db->get();
	$markers = $query->result_array();
	return $markers;
  }

}

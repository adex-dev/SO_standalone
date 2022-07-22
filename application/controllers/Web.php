<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {
  function __construct(){
  parent::__construct();
  $this->load->model(array('auth_model'));
  }

	public function index()
	{
    if ($this->session->userdata('tanggal')) {
      redirect('home');
    }
    $data['store']= $this->db->select('kode_store,nama_store')->order_by('nama_store','ASC')->get('prm_store')->result();
		$this->load->view('login',$data);
	}
}

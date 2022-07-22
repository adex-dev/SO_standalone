<?php 
class Home extends CI_Controller { 
  function __construct(){
  parent::__construct();
  
  }
  public function index (){ 
    $this->template->load('home/template', 'home/index');
   }
  public function rekapdata (){ 
    $this->template->load('home/template', 'home/rekap');
   }
 } 
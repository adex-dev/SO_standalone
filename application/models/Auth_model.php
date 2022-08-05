<?php 
class Auth_model extends CI_Model { 
  function __construct(){
  parent::__construct();
  
  }
  var $tableDummy = 'dummydata'; //nama tabel dari database
  var $searchdummy = array('ean');
  var $tableData = 'inventorisdata';
  var $searchdata = array('ean');
  public function cekuser ($nik,$password){ 
    $this->db->where('nik',$nik);
    $this->db->where('password',$password);
    return $this->db->get('users');
   }
   private function _getTabledumy()
   {
    $nik = $this->session->userdata('nik');
    $tanggal = $this->session->userdata('tanggal');
    $store = $this->session->userdata('store');
     $this->db->select('ean,flor,onhand_scan,nik');
     $this->db->where(['tanggal'=>$tanggal,'kode_store'=>$store,'nik'=>$nik]);
     $this->db->order_by('ean', 'ASC');
     $this->db->from($this->tableDummy);
     $i = 0;
 
     foreach ($this->searchdummy as $item) // looping awal
     {
       if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
       {
 
         if ($i === 0) // looping awal
         {
           $this->db->group_start();
           $this->db->like($item, $_POST['search']['value']);
         } else {
           $this->db->or_like($item, $_POST['search']['value']);
         }
 
         if (count($this->searchdummy) - 1 == $i) {
           $this->db->group_end();
         }
       }
       $i++;
     }
   }
 
   function getdatadummy()
   {
     $this->_getTabledumy();
     if ($_POST['length'] != -1)
       $this->db->limit($_POST['length'], $_POST['start']);
     $query = $this->db->get();
     return $query->result();
   }
 
   function hitungFilterDummy()
   {
     $this->_getTabledumy();
     $query = $this->db->get();
     return $query->num_rows();
   }
 
   public function hitung_semuaDummy()
   {
     $this->db->from($this->tableDummy);
     return $this->db->count_all_results();
   }
   private function _getTablData()
   {
    $tanggal = $this->session->userdata('tanggal');
    $store = $this->session->userdata('store');
     $this->db->select('ean,flor,onganscan,nik');
     $this->db->where(['tanggal'=>$tanggal,'kode_store'=>$store]);
     $this->db->order_by('ean', 'ASC');
     $this->db->from($this->tableData);
     $i = 0;
 
     foreach ($this->searchdata as $item) // looping awal
     {
       if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
       {
 
         if ($i === 0) // looping awal
         {
           $this->db->group_start();
           $this->db->like($item, $_POST['search']['value']);
         } else {
           $this->db->or_like($item, $_POST['search']['value']);
         }
 
         if (count($this->searchdata) - 1 == $i) {
           $this->db->group_end();
         }
       }
       $i++;
     }
   }
 
   function getdatainventori()
   {
     $this->_getTablData();
     if ($_POST['length'] != -1)
       $this->db->limit($_POST['length'], $_POST['start']);
     $query = $this->db->get();
     return $query->result();
   }
 
   function hitungFilterData()
   {
     $this->_getTablData();
     $query = $this->db->get();
     return $query->num_rows();
   }
 
   public function hitung_semuaData()
   {
     $this->db->from($this->tableData);
     return $this->db->count_all_results();
   }
 } 
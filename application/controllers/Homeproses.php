<?php
class Homeproses extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('upload');
    $this->load->model(array('auth_model'));
    $this->db = $this->load->database('default', TRUE);
    $this->db_server = $this->load->database('db_server', TRUE);
  }
  public function gettabledummy()
  {
    $list = $this->auth_model->getdatadummy();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $dt) {
      $nama = $this->db->select('nama')->where('nik', $dt->nik)->get('users')->row()->nama;
      $no++;
      $row   = array();
      $row[] = $dt->ean;
      $row[] = $dt->onhand_scan;
      $row[] = $dt->flor;
      $row[] = $nama;
      $data[] = $row;
    }
    $output = array(
      "draw"            =>  intval($_POST["draw"]),
      "recordsTotal"    =>  $this->auth_model->hitung_semuaDummy(),
      "recordsFiltered" => $this->auth_model->hitungFilterDummy(),
      "data"            => $data,
    );
    echo json_encode($output);
  }
  public function gettableinvetori()
  {
    $list = $this->auth_model->getdatainventori();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $dt) {
      $nama = $this->db->select('nama')->where('nik', $dt->nik)->get('users')->row()->nama;
      $no++;
      $row   = array();
      $row[] = $dt->ean;
      $row[] = $dt->onhand_scan;
      $row[] = $dt->flor;
      $row[] = $nama;
      $row[] = $this->session->userdata('namastore');
      $data[] = $row;
    }
    $output = array(
      "draw"            =>  intval($_POST["draw"]),
      "recordsTotal"    =>  $this->auth_model->hitung_semuaData(),
      "recordsFiltered" => $this->auth_model->hitungFilterData(),
      "data"            => $data,
    );
    echo json_encode($output);
  }
  public function insertchiperlab()
  {
    $config['upload_path'] = './content/sampel/upload/';
    $config['allowed_types'] = 'txt';
    $config['max_size'] = 10000;
    $config['max_width'] = 0;
    $config['max_height'] = 0;
    $this->upload->initialize($config);
    if (!$this->upload->do_upload('namafile')) {
      $error = array('error' => $this->upload->display_errors());
      $cek = implode('', $error);
      $msg = ['gagal' => 'Only Accepts txt Files'];
    } else {
      $flor = $this->input->post('namaflor', true);
      $nik = $this->session->userdata('nik');
      $tanggal = $this->session->userdata('tanggal');
      $store = $this->session->userdata('store');
      $images = $this->upload->data();
      $imagess = $images['file_name'];
      $file_data = fopen("./content/sampel/upload/" . $imagess, 'r');
      fgets($file_data);
      $wheredelete = ['kode_store' => $store];
      $this->db->delete('dummydata', $wheredelete);
      while ($row = fgets($file_data)) {
        $insert_data = ['tanggal' => $tanggal, 'kode_store' => $store, 'nik' => $nik, 'flor' => $flor, 'ean' => trim($row), 'onhand_scan' => 1];
        $insert_data2 = ['tanggal' => $tanggal, 'kode_store' => $store, 'nik' => $nik, 'flor' => $flor, 'ean' => trim($row), 'onganscan' => 1];
        $where = ['tanggal' => $tanggal, 'kode_store' => $store, 'nik' => $nik, 'flor' => $flor, 'ean' => trim($row)];
        $where2 = ['tanggal' => $tanggal, 'kode_store' => $store, 'nik' => $nik, 'flor' => $flor, 'ean' => trim($row)];
        $cek = $this->db->get_where('dummydata', $where);
        $cek2 = $this->db->get_where('inventorisdata', $where2);
        if ($cek2->num_rows() > 0) {
          $b = $cek2->row()->onganscan + 1;
          $this->db->update('inventorisdata', ['onganscan' => $b], $where2);
        } else {
          $this->db->insert('inventorisdata', $insert_data2);
        };
        if ($cek->num_rows() > 0) {
          $a = $cek->row()->onhand_scan + 1;
          $sukses = $this->db->update('dummydata', ['onhand_scan' => $a], $where);
        } else {
          $sukses = $this->db->insert('dummydata', $insert_data);
        }
      }
      if ($sukses) {
        if (file_exists("./content/sampel/upload/" . $imagess)) {
          unlink("./content/sampel/upload/" . $imagess);
          $msg = ['sukses' => 'Success Added Data'];
        }
      } else {
        if (file_exists("./content/sampel/upload/" . $imagess)) {
          unlink("./content/sampel/upload/" . $imagess);
          $msg = ['sukses' => 'Success Added Data'];
        }
      }
    }
    echo json_encode($msg);
  }
  public function kirimdataserver()
  {
    if ($this->session->userdata('store')) {
      $connected = @fsockopen('www.inventory.ptscu.net', 80);
      $is_conn = '';
      if ($connected) {
        $store = $this->session->userdata('store');
        $nik = $this->session->userdata('nik');
        $namastore = $this->session->userdata('namastore');
        $tanggal = $this->session->userdata('tanggal');
        $getlokaldata = $this->db->select('ean,tanggal,kode_store,onganscan')->where(['kode_store' => $store, 'tanggal' => $tanggal])->get('inventorisdata')->result();
        if ($this->db_server->get_where('prm_auditor', ['periode_audit' => $tanggal, 'kode_store' => $store, 'status_audit' => 'SELESAI'])->num_rows() > 0) {
          $msg = ['gagal' => 'the audit status period    ' . $tanggal . ' is complete'];
        } else {
          foreach ($getlokaldata as $value) {
            $cek = $this->db_server->get_where('prm_stock', ['periode' => $value->tanggal, 'kode_store' => $value->kode_store]);
            if ($cek->num_rows() > 0) {
              $cek2 = $this->db_server->get_where('prm_stock', ['periode' => $value->tanggal, 'kode_store' => $value->kode_store, 'ean' => $value->ean]);
              if ($cek2->num_rows() > 0) {
                $jmlah = (int) $cek2->row()->onhand_scan + $value->onganscan;
                $sukses = $this->db_server->update('prm_stock', ['onhand_scan' => $jmlah], ['periode' => $value->tanggal, 'kode_store' => $value->kode_store, 'ean' => $value->ean]);
              } else {
                $dbinsert = ['periode' => $value->tanggal, 'ean' => $value->ean, 'kode_store' => $value->kode_store, 'nama_store' => $namastore, 'onhand_scan' => $value->onganscan];
                $sukses = $this->db_server->insert('prm_stock', $dbinsert);
              }
              if ($this->db_server->get_where('temp_stock', ['periode' => $tanggal, 'kode_store' => $store, 'ean' => $value->ean, 'state' => $value->flor, 'status_audit' => 'SELESAI'])->num_rows() > 0) {
              } else {
                $rs = $this->db_server->get_where('temp_stock', ['periode' => $tanggal, 'kode_store' => $store, 'ean' => $value->ean, 'state' => $value->flor, 'nik' => $nik]);
                if ($rs->num_rows() > 0) {
                  $jmlah2 = (int) $rs->row()->onhand_scan + $value->onganscan;
                  $this->db_server->update('', ['onhand_scan' => $jmlah2], ['periode' => $tanggal, 'kode_store' => $store, 'ean' => $value->ean, 'state' => $value->flor, 'nik' => $nik]);
                } else {
                  $this->db_server->insert('temp_stock', ['periode' => $tanggal, 'kode_store' => $store, 'nik' => $nik, 'ean' => $value->ean, 'onhand_scan' => $value->onganscan, 'state' => $value->flor]);
                }
              }
            } else {
              $msg = ['gagal' => 'Master Has not been uploaded to the server'];
            }
          }
          if ($sukses) {

            $msg = ['sukses' => 'Success'];
          }
        }
        fclose($connected);
      } else {
        $msg = ['gagal' => 'Please Check Your Internet Connection'];
        $is_conn = false;
      }
      echo json_encode($msg);
      return $is_conn;
    }
  }
}

<?php
class Auth extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model(array('auth_model'));
    $this->db = $this->load->database('default', TRUE);
    $this->db_server = $this->load->database('db_server', TRUE);
  }
  public function ambildataserverstore()
  {
    $connected = @fsockopen('www.inventory.ptscu.net', 80);
    $is_conn = '';
    if ($connected) {
      $apikey = file_get_contents("https://inventory.ptscu.net/api/allstore");

      $apikeystore = json_decode($apikey);
      foreach ($apikeystore as $value) {
        if ($this->db->get_where('prm_store', ['kode_store' => $value->kode_store])->num_rows() > 0) {
          $sukses = $this->db->update('prm_store', ['kode_store' => $value->kode_store, 'nama_store' => $value->nama_store], ['kode_store' => $value->kode_store]);
        } else {
          $sukses = $this->db->insert('prm_store', ['kode_store' => $value->kode_store, 'nama_store' => $value->nama_store]);
        }
      }
      if ($sukses) {
        $msg = ['sukses' => 'Success Added Store'];
      } else {
        $msg = ['gagal' => 'Failed Added Store'];
      }
      fclose($connected);
    } else {
      $msg = ['gagal' => 'Please Check Your Internet Connection'];
      $is_conn = false;
    }
    echo json_encode($msg);
    return $is_conn;
  }


  public function ambildataserveruser()
  {
    $connected = @fsockopen('www.inventory.ptscu.net', 80);
    $is_conn = '';
    if ($connected) {
      $apikey = file_get_contents("https://inventory.ptscu.net/api/alluser");

      $apikeyuser = json_decode($apikey);
      foreach ($apikeyuser as $value) {
        if ($this->db->get_where('users', ['nik' => $value->nik])->num_rows() > 0) {
          $sukses = $this->db->update('users', ['nik' => $value->nik, 'nama' => $value->nama, 'password' => $value->password, 'status' => $value->status, 'level' => $value->level], ['kode_store' => $value->kode_store]);
        } else {
          $sukses = $this->db->insert('users', ['nik' => $value->nik, 'nama' => $value->nama, 'password' => $value->password, 'status' => $value->status, 'level' => $value->level]);
        }
      }
      if ($sukses) {
        $msg = ['sukses' => 'Success Added User'];
      } else {
        $msg = ['gagal' => 'Failed Added User'];
      }
      fclose($connected);
    } else {
      $msg = ['gagal' => 'Please Check Your Internet Connection'];
      $is_conn = false;
    }
    echo json_encode($msg);
    return $is_conn;
  }

  public function ambiltanggal()
  {
    if ($this->input->post()) {
      $tanggal = $this->input->post('tanggallogin', true);
      $this->session->set_userdata('tanggal', $tanggal);
      $msg = ['sukses' => 'ok', 'audit' => base_url('home')];
      echo json_encode($msg);
    }
  }
  public function loginproses()
  {
    $store = $this->input->post('storelogin', true);
    $nik = $this->input->post('niklogin', true);
    $password = md5($this->input->post('passwordlogin', true));
    $cek = $this->auth_model->cekuser($nik, $password);
    $rowstore = $this->db->select('kode_store,nama_store')->where('kode_store', $store)->get('prm_store')->row();
    if ($cek->num_rows() > 0) {
      $a = $cek->row();
      if ($a->status == 'aktif') {
        $datasesion = [
          'store' => $rowstore->kode_store,
          'namastore' => $rowstore->nama_store,
          'nik' => $nik,
          'nama' => $a->nama,
          'level' => $a->level,
        ];
        $this->session->set_userdata($datasesion);
        $msg = ['sukses' => '.'];
      } else {
        $msg = ['gagal' => 'User Sudah Tidak Aktif Lagi'];
      }
    } else {
      $msg = ['gagal' => 'password atau nik salah'];
    }
    echo json_encode($msg);
  }
  public function logout()
  {
    $this->session->sess_destroy();
    redirect('');
  }
  public function hapusfile()
  {
    $dir = './content/sampel/upload/';
    array_map('unlink', glob("{$dir}*.csv"));
    $msg = 'ok';
    echo json_encode($msg);
  }
}

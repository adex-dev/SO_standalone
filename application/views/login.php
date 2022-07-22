<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Audit</title>
  <link rel="shortcut icon" href="<?= base_url() ?>content/src/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/build/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/bootstrap-datetimepicker/css/jquery.datetimepicker.css">
  <script src="<?= base_url() ?>content/vendor/jquery/jquery.min.js"></script>
  <script>
    var hostname = "<?= base_url() ?>"
  </script>
</head>

<body class="bgroundhome">
  <div class="container">
    <div class="row d-md-flex align-content-md-center align-items-md-center min-vh-100">
      <div class="col-md-6 d-none d-md-block">
        <div class="card">
          <div class="card-header bg-none">
            <h1 class="font-interbold">Jaygee Group</h1>
          </div>
          <div class="card-body">
            <video class="w-100" playsinline="" autoplay="" muted="" loop="" __idm_id__="3555329">
              <source src="<?= base_url() ?>content/src/video/bg.mp4" type="video/mp4">
            </video>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body d-flex justify-content-center">
            <img src='<?= base_url() ?>content/src/images/bg.jpg' alt='icon bg' class='w-100 loginbg position-relative' loading='lazy'>
            <div class="position-absolute w-50" style="bottom: 25%;">
              <div class="row">
                <div class="col-12">
                  <form class="formlogin">
                    <div class="mb-3">
                      <select required name="storelogin" class="form-control form-control-sm visitor" id="">
                        <option value="">Choose</option>
                        <?php foreach ($store as $value) : ?>
                          <option value="<?= $value->kode_store ?>"><?= $value->nama_store ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <input autocomplete="empty" name="niklogin" autofocus required type="text" class="form-control font-interitalic" placeholder="Nik">
                    </div>
                    <div class="mb-3">
                      <input autocomplete="empty" name="passwordlogin" required type="password" class="form-control font-interitalic" placeholder="Password">
                    </div>
                    <div class="mb-3">
                      <button type="submit" class="btn btn-success btn-sm w-100 font-interbold">Login</button>
                    </div>
                  </form>
                  <div class="mb-3">
                      <button type="button" class="btn btn-info btn-sm w-100 text-white font-interbold btnsyncrondata">Syncronize data</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="modal fade modallogin" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pilih Tanggal Audit</h5>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="tanggallogin" class="form-label">Tanggal</label>
            <input type="text" class="form-control clock" value="<?= date('Y-m-d') ?>" name="tanggallogin" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btnlogintanggal">Simpan</button>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url() ?>content/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/popper/umd/popper.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/select2/js/select2.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/bootstrap-datetimepicker/js/jquery.datetimepicker.full.js"></script>
  <script src="<?= base_url() ?>content/build/js/style.js"></script>
  <script src="<?= base_url() ?>content/build/js/jslogin.js"></script>
</body>

</html>
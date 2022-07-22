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
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/bootstrap-datetimepicker/css/jquery.datetimepicker.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/DataTables/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/DataTables/rowGroup.dataTables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/DataTables/Buttons-2.2.3/css/buttons.bootstrap5.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/DataTables/FixedHeader-3.2.3/css/fixedHeader.bootstrap.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/DataTables/Scroller-2.0.6/css/scroller.bootstrap.css">
  <link rel="stylesheet" href="<?= base_url() ?>content/vendor/bootstrap-datetimepicker/css/jquery.datetimepicker.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('content/vendor/DataTables/FixedColumns-4.1.0/css/fixedColumns.dataTables.min.css') ?>" />


  <script src="<?= base_url() ?>content/vendor/jquery/jquery.min.js"></script>
  <script>
    var hostname = "<?= base_url() ?>"
    var storename = "<?=$this->session->userdata('namastore'); ?>"
  </script>
</head>

<body class="bgroundhome" style="overflow-x: hidden;">
  <?= $contents ?>
  <div class="viewModal" style="display: none;"></div>
  <script src="<?= base_url() ?>content/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/bootstrap-datetimepicker/js/jquery.datetimepicker.full.js"></script>
  <script src="<?= base_url() ?>content/vendor/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/popper/umd/popper.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/select2/js/select2.min.js"></script>
  <script src="<?= base_url() ?>content/vendor/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>content/build/js/style.js"></script>
    <script src="<?= base_url() ?>content/vendor/DataTables/datatables.min.js"></script>
    <script src="<?= base_url() ?>content/vendor/DataTables/Buttons-2.2.3/js/buttons.html5.js"></script>
    <script src="<?= base_url() ?>content/vendor/DataTables/FixedHeader-3.2.3/js/fixedHeader.bootstrap.js"></script>
    <script src="<?= base_url() ?>content/vendor/DataTables/dataTables.rowGroup.min.js"></script>
    <script src="<?= base_url() ?>content/vendor/DataTables/Scroller-2.0.6/js/scroller.bootstrap.js"></script>
    <script src="<?= base_url() ?>content/vendor/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="<?= base_url() ?>content/build/js/custometable.js"></script>
    <script src="<?= base_url() ?>content/build/js/prosesing.js"></script>
    <!-- <script src="<?= base_url() ?>content/build/js/modal.js"></script> -->
</body>

</html>
<div class="container-flex py-4" style="overflow-x: hidden;">
  <div class="row d-md-flex">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-none">
          <h1 class="font-interbold">Jaygee Group</h1>
          <div class="d-flex justify-content-end"><button onclick="window.location.href='<?= site_url('logout') ?>'" type="button" class="btn btn-danger btn-sm">Logout</button><button onclick="window.location.href='<?= site_url('rekap') ?>'" type="button" class="btn btn-info btn-sm mx-2"><i class="fa fa-envelope"></i> Rekap</button></div>
        </div>
        <div class="card-body" style="min-height: 600px;">
          <div class="row">
            <div class="col-md-12 mb-3">
              <table class="table table-bordered table-hover tabledummy w-100">
                <thead>
                  <tr>
                    <th>Ean</th>
                    <th>QTY</th>
                    <th>State</th>
                    <th>Nama</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6  d-none d-md-block">
      <div class="card">
        <div class="card-header">
          <h1 class="font-interbold"><?= $this->session->userdata('namastore'); ?></h1>

        </div>
        <div class="card-body px-3">
          <table class="table" style="border: none !important;">
            <tbody>
              <tr>
                <td>Name Auditor : </td>
                <td><?= $this->session->userdata('nama'); ?></td>
              </tr>
              <tr>
                <td>Level Auditor : </td>
                <td><?= $this->session->userdata('level'); ?></td>
              </tr>
              <tr>
                <td>Date Stock Of Name : </td>
                <td><?= $this->session->userdata('tanggal'); ?></td>
              </tr>
              <form class="importciperlab" enctype="multipart/form-data">
              <tr style="border: none;border-style: none;border-color: snow; ">
                  <td>Floor : </td>
                  <td><select required name="" class="form-select form-select-sm visitor selectflor">
                      <option value="">Choose Floor</option><?php for ($i = 1; $i <= 100; $i++) : ?><option value="floor- <?= $i ?>">Floor-<?= $i ?></option> <?php endfor ?>
                    </select></td>
                </tr>
                <tr style="border: none;border-style: none;border-color: snow; ">
                  <td>Import Chiperlab : </td>
                  <td>
                    <div class="mb-3">
                      <input class="form-control" type="file" id="formFile">
                    </div>
                  </td>
                </tr>
                <tr style="border: none;border-style: none;border-color: snow; ">
                  <td></td>
                  <td><button type="submit" class="w-100 btn btn-primary"><i class="fa fa-upload"></i> Upload Chiperlab</button></td>
                </tr>
              </form>
              <?php if ($this->session->userdata('level')=='auditor' || $this->session->userdata('level')=='admin') : ?>
              <tr style="border: none;border-style: none;border-color: snow; ">
                  <td></td>
                  <td><button type="button" class="w-100 btn btn-warning btnposserver">Post To Server Online</button></td>
                </tr>
                <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
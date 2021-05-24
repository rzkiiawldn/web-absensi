<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="row">
    <div class="col">
      <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
    </div>
    <?php if ($user->id_level == 3) {
    } else { ?>
    <div class="col">
      <a href="" class="btn btn-primary mb-3 float-right" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah</a>
    </div>
    <?php } ?>
  </div>
  <div class="row">
    <div class="col">
      <?= $this->session->flashdata('pesan'); ?>
    </div>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th>Masuk</th>
              <th>Pulang</th>
              <th>Jadwal Kerja</th>
              <?php if ($user->id_level == 3) {
              } else { ?>
                <th width="20%">Aksi</th>
              <?php } ?>
            </tr>
          </thead>
          <?php
          $no = 1;
          foreach ($jam_kerja as $jam) { ?>
            <tbody>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $jam->masuk; ?></td>
                <td><?= $jam->pulang; ?></td>
                <td><?= $jam->jadwal; ?></td>
                <?php if ($user->id_level == 3) {
                } else { ?>
                  <td>
                    <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit<?= $jam->id_jam; ?>">edit</a>
                  </td>
                <?php } ?>
              </tr>
            </tbody>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>

</div>

<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('absensi/tambah_jam_kerja'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="masuk">masuk</label>
            <input type="time" class="form-control" id="masuk" name="masuk">
          </div>
          <div class="form-group">
            <label for="pulang">pulang</label>
            <input type="time" class="form-control" id="pulang" name="pulang">
          </div>
          <div class="form-group">
            <label for="jadwal_kerja">jadwal_kerja</label>
            <input type="text" class="form-control" id="jadwal_kerja" name="jadwal_kerja">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>



<?php foreach ($jam_kerja as $jam) { ?>
  <!-- Modal -->
  <div class="modal fade" id="edit<?= $jam->id_jam; ?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('absensi/edit_jam_kerja/' . $jam->id_jam); ?>" method="post">
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id_jam" name="id_jam" value="<?= $jam->id_jam; ?>">
            <div class="form-group">
              <label for="masuk">masuk</label>
              <input type="time" class="form-control" id="masuk" name="masuk" value="<?= $jam->masuk; ?>">
            </div>
            <div class="form-group">
              <label for="pulang">pulang</label>
              <input type="time" class="form-control" id="pulang" name="pulang" value="<?= $jam->pulang; ?>">
            </div>
            <div class="form-group">
              <label for="jadwal_kerja">jadwal_kerja</label>
              <input type="text" class="form-control" id="jadwal_kerja" name="jadwal_kerja" value="<?= $jam->jadwal_kerja; ?>">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>
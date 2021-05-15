<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="row">
    <div class="col">
      <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
    </div>
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
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Keterangan</th>
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
                <td><?= $jam->mulai; ?></td>
                <td><?= $jam->selesai; ?></td>
                <td><?= $jam->keterangan; ?></td>
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
            <label for="mulai">Mulai</label>
            <input type="time" class="form-control" id="mulai" name="mulai">
          </div>
          <div class="form-group">
            <label for="selesai">Selesai</label>
            <input type="time" class="form-control" id="selesai" name="selesai">
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan">
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
              <label for="mulai">mulai</label>
              <input type="time" class="form-control" id="mulai" name="mulai" value="<?= $jam->mulai; ?>">
            </div>
            <div class="form-group">
              <label for="selesai">selesai</label>
              <input type="time" class="form-control" id="selesai" name="selesai" value="<?= $jam->selesai; ?>">
            </div>
            <div class="form-group">
              <label for="keterangan">keterangan</label>
              <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $jam->keterangan; ?>">
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
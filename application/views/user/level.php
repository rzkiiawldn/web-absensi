<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="row">
    <div class="col">
      <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
    </div>
    <div class="col">
      <a href="" class="btn btn-primary mb-3 float-right" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah</a>
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
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th>Level</th>
              <th width="20%">Aksi</th>
            </tr>
          </thead>
          <?php
          $no = 1;
          foreach ($level as $l) { ?>
            <tbody>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $l->level; ?></td>
                <td>
                  <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit<?= $l->id_level; ?>">edit</a>
                  <a href="<?= base_url('user/hapus_level/' . $l->id_level); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus ?')">hapus</a>
                </td>
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
      <form action="<?= base_url('user/tambah_level'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="level">level</label>
            <input type="text" class="form-control" id="level" name="level">
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



<?php foreach ($level as $l) { ?>
  <!-- Modal -->
  <div class="modal fade" id="edit<?= $l->id_level; ?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('user/edit_level/' . $l->id_level); ?>" method="post">
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id_level" name="id_level" value="<?= $l->id_level; ?>">
            <div class="form-group">
              <label for="level">level</label>
              <input type="text" class="form-control" id="level" name="level" value="<?= $l->level; ?>">
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
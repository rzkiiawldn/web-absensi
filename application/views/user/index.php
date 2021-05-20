<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="row">
    <div class="col">
      <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
    </div>
    <div class="col">
      <!-- <a href="" class="btn btn-primary mb-3 float-right" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah</a> -->
      <a href="<?= base_url('user/tambah_user'); ?>" class="btn btn-primary mb-3 float-right"><i class="fas fa-plus"></i> Tambah</a>
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
              <th>#</th>
              <th>username</th>
              <th>Level</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <?php
          $no = 1;
          foreach ($data_user as $user) { ?>
            <tbody>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $user->username; ?></td>
                <td><?= $user->level; ?></td>
                <td>
                  <!-- <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit<?= $user->id_user; ?>">edit</a> -->
                  <a href="<?= base_url('user/edit_user/' . $user->id_user); ?>" class="btn btn-sm btn-success">edit</a>
                  <a href="<?= base_url('user/hapus_user/' . $user->id_user); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus ?')">hapus</a>
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
      <form action="" method="post">
        <div class="modal-body">
          <!-- <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" value="IT-<?= sprintf("%04s", $nik) ?>" readonly>
          </div> -->
          <div class="form-group">
            <label for="username">username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
            <label for="password1">Password</label>
            <input type="password" class="form-control" id="password1" name="password1">
          </div>
          <div class="form-group">
            <label for="password2">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password2" name="password2">
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



<?php foreach ($data_user as $user) { ?>
  <!-- Modal -->
  <div class="modal fade" id="edit<?= $user->id_user; ?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <!-- <div class="form-group">
              <label for="nik">NIK</label>
              <input type="text" class="form-control" id="nik" name="nik" value="<?= $user->nik; ?>" readonly>
            </div> -->
            <div class="form-group">
              <label for="username">username</label>
              <input type="text" class="form-control" id="username" name="username" value="<?= $user->username; ?>">
            </div>
            <div class="form-group">
              <label for="password1">Password</label>
              <input type="password" class="form-control" id="password1" name="password1">
            </div>
            <div class="form-group">
              <label for="password2">Konfirmasi Password</label>
              <input type="password" class="form-control" id="password2" name="password2">
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
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
              <th>#</th>
              <th>Submenu</th>
              <th>Menu</th>
              <th>is_active ?</th>
              <th>Urutan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <?php
          $no = 1;
          foreach ($submenu as $sub) { ?>
            <tbody>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $sub->submenu; ?></td>
                <td><?= $sub->menu; ?></td>
                <td><?= $sub->is_active == 1 ? 'Aktif' : 'Tidak aktif'; ?></td>
                <td><?= $sub->urutan_sub; ?></td>
                <td>
                  <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit<?= $sub->id_sub ?>">edit</a>
                  <a href="<?= base_url('pengaturan/hapus_submenu/' . $sub->id_sub); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus ?');">hapus</a>
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
      <form action="<?= base_url('pengaturan/tambah_submenu') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="id_menu">Menu</label>
            <select class="form-control" id="id_menu" name="id_menu" required="">
              <option value="">-- Pilih --</option>
              <?php foreach ($menu as $m) { ?>
                <option value="<?= $m->id_menu; ?>"><?= $m->menu; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="submenu">submenu</label>
            <input type="text" class="form-control" id="submenu" name="submenu" required="">
          </div>
          <div class="form-group">
            <label for="url">Url</label>
            <input type="text" class="form-control" id="url" name="url" required="">
          </div>
          <div class="form-group">
            <label for="icon">icon</label>
            <input type="text" class="form-control" id="icon" name="icon" required="">
          </div>
          <div class="form-group">
            <label for="urutan_sub">Urutan</label>
            <input type="number" min="1" class="form-control" id="urutan_sub" name="urutan_sub" required="">
          </div>
          <div class="form-group">
            <div class="form-check">
              <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active" checked>
              <label for="is_active" class="form-check-label">Aktif ?</label>
            </div>
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



<?php foreach ($submenu as $sub) { ?>
  <!-- Modal -->
  <div class="modal fade" id="edit<?= $sub->id_sub; ?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('pengaturan/edit_submenu/' . $sub->id_sub); ?>" method="post">
          <div class="modal-body">
            <input type="hidden" class="form-control" name="id_sub" required="" value="<?= $sub->id_sub; ?>">
            <div class="form-group">
              <label for="id_menu">Menu</label>
              <select class="form-control" id="id_menu" name="id_menu" required="" value="<?= $sub->id_menu; ?>">
                <option value="">-- Pilih --</option>
                <?php foreach ($menu as $m) { ?>
                  <?php if ($m->id_menu == $sub->id_menu) { ?>
                    <option value="<?= $m->id_menu; ?>" selected><?= $m->menu; ?></option>
                  <?php } else { ?>
                    <option value="<?= $m->id_menu; ?>"><?= $m->menu; ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="submenu">submenu</label>
              <input type="text" class="form-control" id="submenu" name="submenu" required="" value="<?= $sub->submenu; ?>">
            </div>
            <div class="form-group">
              <label for="url">Url</label>
              <input type="text" class="form-control" id="url" name="url" required="" value="<?= $sub->url; ?>">
            </div>
            <div class="form-group">
              <label for="icon">icon</label>
              <input type="text" class="form-control" id="icon" name="icon" required="" value="<?= $sub->icon; ?>">
            </div>
            <div class="form-group">
              <label for="urutan_sub">Urutan</label>
              <input type="number" min="1" class="form-control" id="urutan_sub" name="urutan_sub" required="" value="<?= $sub->urutan_sub; ?>">
            </div>
            <div class="form-group">
              <div class="form-check">
                <?php if ($sub->is_active == 1) { ?>
                  <input type="checkbox" value="<?= $sub->is_active ?>" class="form-check-input" name="is_active" id="is_active" checked>
                <?php } else { ?>
                  <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active">
                <?php } ?>
                <label for="is_active" class="form-check-label">Aktif ?</label>
              </div>
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
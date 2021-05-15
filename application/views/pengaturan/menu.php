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
                            <th>Menu</th>
                            <th>is_active ?</th>
                            <th>Urutan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php 
                    $no=1;
                    foreach($menu as $m) { ?>
                    <tbody>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $m->menu; ?></td>
                            <td><?= $m->is_active == 1 ? 'Aktif' : 'Tidak aktif'; ?></td>
                            <td><?= $m->urutan_menu; ?></td>
                            <td>
                            	<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit<?= $m->id_menu ?>">edit</a>
                            	<a href="<?= base_url('pengaturan/hapus_menu/'.$m->id_menu) ?>" class="btn btn-sm btn-danger" onclick="return confirm('yakin ingin menghapus ?');">hapus</a>
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
        <form action="<?= base_url('pengaturan/tambah_menu'); ?>" method="post">
          <div class="modal-body">
              <div class="form-group">
                <label for="menu">Menu</label>
                <input type="text" class="form-control" id="menu" name="menu">
              </div>
              <div class="form-group">
                <label for="urutan_menu">Urutan</label>
                <input type="number" min="1" class="form-control" id="urutan_menu" name="urutan_menu">
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




<?php foreach($menu as $m) { ?>
<!-- Modal -->
<div class="modal fade" id="edit<?= $m->id_menu; ?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="<?= base_url('pengaturan/edit_menu/'.$m->id_menu) ?>" method="post">
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id_menu" name="id_menu" value="<?= $m->id_menu; ?>">
              <div class="form-group">
                <label for="menu">Menu</label>
                <input type="text" class="form-control" id="menu" name="menu" value="<?= $m->menu; ?>">
              </div>
              <div class="form-group">
                <label for="urutan_menu">Urutan</label>
                <input type="number" min="1" class="form-control" id="urutan_menu" name="urutan_menu" value="<?= $m->urutan_menu; ?>">
              </div>
              <div class="form-group">
                            <div class="form-check">
                                <?php if ($m->is_active == 1) { ?>
                                    <input type="checkbox" value="<?= $m->is_active ?>" class="form-check-input" name="is_active" id="is_active" checked>
                                <?php } else { ?>
                                    <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active">
                                <?php } ?>
                                <label for="" class="form-check-label">Aktif ?</label>
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
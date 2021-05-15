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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php 
                    $no=1;
                    foreach($level as $l) { ?>
                    <tbody>
                        <tr>
                            <td width="10%"><?= $no++; ?></td>
                            <td><?= $l->level; ?></td>
                            <td width="20%">
                            	<a href="<?= base_url('pengaturan/hak_akses_menu/'. $l->id_level); ?>" class="btn btn-sm btn-danger">Kelola Akses</a>
                            </td>
                        </tr>
                    </tbody>
	                <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
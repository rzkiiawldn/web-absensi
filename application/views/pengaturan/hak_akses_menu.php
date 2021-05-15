<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col">
            <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
        </div>
        <div class="col">
            <a href="<?= base_url('pengaturan/hak_akses'); ?>" class="btn btn-primary mb-3 float-right"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5>Level : <?= $level->level; ?></h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Menu</th>
                            <th scope="col">SubMenu</th>
                            <th scope="col" class="text-center">Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($submenu as $m) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $m->menu; ?></td>
                                <td><?= $m->submenu; ?></td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <!-- mengirimkan data ke fungsi userAkses_helper.php yang ada di helper -->
                                        <!-- fungsi cek akses untuk fungsi checked -->
                                        <!-- data role dan data menu dikirimkan untuk jquery -->
                                        <input class="form-check-input" type="checkbox" <?= cek_akses($level->id_level, $m->id_menu, $m->id_sub); ?> data-level="<?= $level->id_level; ?>" data-menu="<?= $m->id_menu; ?>" data-submenu="<?= $m->id_sub; ?>">
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
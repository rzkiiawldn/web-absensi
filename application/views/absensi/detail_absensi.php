<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col">
            <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
        </div>
        <div class="col">
            <form action="" method="get">
                <div class="row">
                    <div class="col">
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="" disabled selected>-- Pilih Bulan --</option>
                            <?php foreach ($all_bulan as $bn => $bt) : ?>
                                <option value="<?= $bn ?>" <?= ($bn == $bulan) ? 'selected' : '' ?>><?= $bt ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col ">
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="" disabled selected>-- Pilih Tahun</option>
                            <?php for ($i = date('Y'); $i >= (date('Y') - 3); $i--) : ?>
                                <option value="<?= $i ?>" <?= ($i == $tahun) ? 'selected' : '' ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col ">
                        <button type="submit" class="btn btn-primary btn-fill btn-block">Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">

                            <h4 class="card-title mb-4">Absen Bulan : <?= bulan($bulan) . ' ' . $tahun ?></h4>
                        </div>
                        <div class="col-4">
                            <a href="<?= base_url('absensi/cetak_data_absensi/' . $data_user->id_user); ?>" class="btn btn-outline-secondary float-right" target="_blank"><i class="fas fa-print"></i> Cetak Data</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th width="5%">No</th>
                                <th width="20%">tgl</th>
                                <th width="20%">Jam Masuk</th>
                                <th width="20%">Jam Keluar</th>
                                <th width="20%">Jadwal Kerja</th>
                                <th width="5%">Aksi</th>
                            </thead>
                            <tbody>
                            <?php if ($absen) : ?>
                            <?php $no=1; foreach($absen_detail as $ad) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $ad->tanggal ?></td>
                                    <!-- <td><?= $ad->absen_masuk == null ? 'tidak hadir' : $ad->absen_masuk; ?></td> -->
                                    <td><?= check_jam($ad->absen_masuk, $ad->keterangan_jadwal) ?></td>
                                    <!-- <td><?= check_jam($ad->absen_pulang, $ad->keterangan_jadwal) ?></td> -->
                                    <td><span class='badge badge-success'><?= $ad->absen_pulang == null ? 'tidak hadir' : $ad->absen_pulang; ?></span></td>
                                    <td><?= $ad->keterangan_jadwal == null ? 'tidak hadir' : $ad->keterangan_jadwal; ?></td>
                                    <td>
                                    <a href="<?= base_url('absensi/detail/'. $ad->id_absen) ?>" class="btn btn-sm btn-info">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else : ?>
                                    <tr>
                                        <td class="bg-light text-center" colspan="8">Tidak ada data absen</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
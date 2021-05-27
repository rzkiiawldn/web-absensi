<!DOCTYPE html><html><head>
    <title><?= $judul; ?></title>
</head><body>
    <table>
        <tr>
            <th width="20%">username</th>
            <th width="10%">:</th>
            <th width="20%"><?= $data_user->username; ?></th>
        </tr>
        <tr>
            <th>Status</th>
            <th>:</th>
            <th><?= $data_user->level; ?></th>
        </tr>
    </table>
    <br>
    <h4 class="card-title mb-4">Absen Bulan : <?= bulan($bulan) . ' ' . $tahun ?></h4><br> <br>
    <table width="100%" align="center" border="1">
        <tr>
            <th width="10%">No</th>
            <th width="20%">tgl</th>
            <th width="35%">Jam Masuk</th>
            <th width="35%">Jam Keluar</th>
            <th>Jadwal Kerja</th>
        </tr>

        <?php if ($absen) : ?>
            <?php foreach ($hari as $i => $h) : ?>
                <?php
                $absen_harian = array_search($h['tgl'], array_column($absen, 'tgl')) !== false ? $absen[array_search($h['tgl'], array_column($absen, 'tgl'))] : '';
                ?>
                <tr <?= ($absen_harian == '') ? 'style="background-color: white"' : '' ?>>
                    <td width="10%" align="center"><?= ($i + 1) ?></td>
                    <td width="20%" align="center"><?= $h['hari'] . ', ' . $h['tgl'] ?></td>
                    <td width="35%" align="center"><?= check_jam(@$absen_harian['jam_masuk'], @$absen_harian['keterangan_jadwal']) ?></td>
                    <td width="35%" align="center"><?= check_jam(@$absen_harian['jam_pulang'], @$absen_harian['keterangan_jadwal']) ?></td>
                    <td><?= @$absen_harian['keterangan_jadwal']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td class="bg-light text-center" colspan="4" align="center" style="background-color: red">Tidak ada data absen</td>
            </tr>
        <?php endif; ?>

    </table>


</body></html>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?= $judul; ?></h4>
				</div>
                
				<div class="card-body">
                <div class="table-responsive">
					<table class="table">
							<tr>
                                <th width="30%">Nama Karyawan</th>
                                <td>: <?= $absen_detail->nama_karyawan ?></td>
                            </tr>
                            <?php if($absen_detail->keterangan_masuk == null){ ?>
                            <tr>
                                <th width="30%">Keterangan</th>
                                <td>: <?= $absen_detail->status ?></td>
                            </tr>
                            <tr>
                                <th width="30%">Alasan Tidak Hadir</th>
                                <td>: <?= $absen_detail->keterangan ?></td>
                            </tr>
                            <?php } else { ?>
                            <tr>
                                <th width="30%">Jadwal Kerja</th>
                                <td>: <?= $absen_detail->keterangan_jadwal ?></td>
                            </tr>
                            <tr>
                                <th width="30%">Absen Masuk</th>
                                <td>: <?= $absen_detail->absen_masuk ?></td>
                            </tr>                            
                            <tr>
                                <th width="30%">Foto Masuk</th>
                                <td>: <img src="<?= $absen_detail->foto_masuk ?>" alt="" width="200px"></td>
                            </tr>
                            <tr>
                                <th width="30%">Lokasi Masuk</th>
                                <td>: 
                                    <iframe 
                                        frameborder="0" 
                                        scrolling="no" 
                                        marginheight="0" 
                                        marginwidth="0" 
                                        src="https://maps.google.com/maps?q=+<?= $absen_detail->latitude_masuk ?>+,+<?= $absen_detail->longitude_masuk ?>+&output=embed"
                                       >
                                    </iframe>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%">Absen Pulang</th>
                                <td>: <?= $absen_detail->absen_pulang ?></td>
                            </tr>
                            <tr>
                                <th width="30%">Foto Pulang</th>
                                <td>: <img src="<?= $absen_detail->foto_pulang ?>" alt="" width="200px"></td>
                            </tr>  
                        <?php } ?>
					</table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
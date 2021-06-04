<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
		<div class="col">
			<h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
		</div>
		<div class="col">
			<a href="<?= base_url('user/data_user'); ?>" class="btn btn-primary mb-3 float-right"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">                
				<div class="card-body">
                <div class="table-responsive">
					<table class="table">
							<tr>
                                <th width="30%">NIK</th>
                                <td>: <?= $data_user->nik ?></td>
                            </tr>
							<tr>
                                <th width="30%">Nama Karyawan</th>
                                <td>: <?= $data_user->nama_karyawan ?></td>
                            </tr>
							<tr>
                                <th width="30%">Divisi</th>
                                <td>: <?= $data_user->id_divisi ?></td>
                            </tr>
                            <?php if($data_user->id_jabatan != 0) { ?>
							<tr>
                                <th width="30%">Jabatan</th>
                                <td>: <?= $data_user->id_jabatan ?></td>
                            </tr>
                            <?php } ?>
							<tr>
                                <th width="30%">Tempat Lahir</th>
                                <td>: <?= $data_user->tempat_lahir ?></td>
                            </tr>
							<tr>
                                <th width="30%">Tanggal Lahir</th>
                                <td>: <?= $data_user->tanggal_lahir ?></td>
                            </tr>
							<tr>
                                <th width="30%">Alamat Sekarang</th>
                                <td>: <?= $data_user->alamat_sekarang ?></td>
                            </tr>
							<tr>
                                <th width="30%">Kota Sekarang</th>
                                <td>: <?= $data_user->kota_sekarang ?></td>
                            </tr>
							<tr>
                                <th width="30%">Kode Pos Sekarang</th>
                                <td>: <?= $data_user->kode_pos_sekarang ?></td>
                            </tr>
							<tr>
                                <th width="30%">Alamat tetap</th>
                                <td>: <?= $data_user->alamat_tetap ?></td>
                            </tr>
							<tr>
                                <th width="30%">Kota tetap</th>
                                <td>: <?= $data_user->kota_tetap ?></td>
                            </tr>
							<tr>
                                <th width="30%">Kode Pos tetap</th>
                                <td>: <?= $data_user->kode_pos_tetap ?></td>
                            </tr>
							<tr>
                                <th width="30%">KTP / SIM</th>
                                <td>: <?= $data_user->ktp_sim ?></td>
                            </tr>
							<tr>
                                <th width="30%">NPWP</th>
                                <td>: <?= $data_user->npwp ?></td>
                            </tr>
							<tr>
                                <th width="30%">Agama</th>
                                <td>: <?= $data_user->agama ?></td>
                            </tr>
							<tr>
                                <th width="30%">Ibu Kandung</th>
                                <td>: <?= $data_user->ibu_kandung ?></td>
                            </tr>
							<tr>
                                <th width="30%">Golongan Darah</th>
                                <td>: <?= $data_user->golongan_darah ?></td>
                            </tr>
							<tr>
                                <th width="30%">No. Telpon</th>
                                <td>: <?= $data_user->no_telp ?></td>
                            </tr>
							<tr>
                                <th width="30%">Masuk Kerja</th>
                                <td>: <?= $data_user->masuk_kerja ?></td>
                            </tr>
							<tr>
                                <th width="30%">Status</th>
                                <td>: <?= $data_user->status ?></td>
                            </tr>
							<tr>
                                <th width="30%">Suami/Istri</th>
                                <td>: <?= $data_user->nama_pasangan ?></td>
                            </tr>
							<tr>
                                <th width="30%">BCA Cabang</th>
                                <td>: <?= $data_user->bca_cabang ?></td>
                            </tr>
							<tr>
                                <th width="30%">No Rekening</th>
                                <td>: <?= $data_user->no_rek ?></td>
                            </tr>
					</table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
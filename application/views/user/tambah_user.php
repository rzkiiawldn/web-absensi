<!-- Begin Page Content -->
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

	<!-- DataTales Example -->
	<div class="card shadow mb-4 text-uppercase">
		<div class="card-body">
			<form method="post" action="">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="id_level">Level</label>
							<select class="form-control" name="id_level" value="<?= set_value('id_level'); ?>">
								<option value="">-- pilih --</option>
								<?php foreach ($level as $l) { ?>
									<option value="<?= $l->id_level; ?>"><?= $l->level; ?></option>
								<?php } ?>
							</select>
							<?= form_error('id_level', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>					
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="username">username</label>
							<input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>">
							<?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="password1">Password</label>
							<input type="password" class="form-control" id="password1" name="password1">
							<?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="password2">Konfirmasi Password</label>
							<input type="password" class="form-control" id="password2" name="password2">
						</div>
					</div>
				</div><hr>

				<div class="form-group row">
				    <label for="nik" class="col-sm-2 col-form-label">nik</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="nik" name="nik"  value="EL-<?= sprintf("%04s", $nik) ?>" readonly>
				    </div>
					<?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="kantor" class="col-sm-2 col-form-label">kantor</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="kantor" name="kantor" value="<?= set_value('kantor') ?>">
				    </div>
					<?= form_error('kantor', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="<?= set_value('nama_karyawan') ?>">
				    </div>
					<?= form_error('nama_karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= set_value('tempat_lahir') ?>">
				    </div>
					<?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>">
				    </div>
					<?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="alamat_sekarang" class="col-sm-2 col-form-label">Alamat Sekarang</label>
				    <div class="col-sm-10">
			    	<textarea class="form-control" id="alamat_sekarang" name="alamat_sekarang"><?= set_value('alamat_sekarang') ?></textarea>
				    </div>
					<?= form_error('alamat_sekarang', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="kota_sekarang" class="col-sm-2 col-form-label">Kota</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="kota_sekarang" name="kota_sekarang" value="<?= set_value('kota_sekarang') ?>">
				    </div>
					<?= form_error('kota_sekarang', '<small class="text-danger pl-3">', '</small>'); ?>
					<label for="kode_pos_sekarang" class="col-sm-2 col-form-label">Kode Pos</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="kode_pos_sekarang" name="kode_pos_sekarang" value="<?= set_value('kode_pos_sekarang') ?>">
				    </div>
					<?= form_error('kode_pos_sekarang', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="alamat_tetap" class="col-sm-2 col-form-label">Alamat Tetap (sesuai KTP)	</label>
				    <div class="col-sm-10">
			    	<textarea class="form-control" id="alamat_tetap" name="alamat_tetap"><?= set_value('alamat_tetap') ?></textarea>
				    </div>
					<?= form_error('alamat_tetap', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="kota_tetap" class="col-sm-2 col-form-label">Kota</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="kota_tetap" name="kota_tetap" value="<?= set_value('kota_tetap') ?>">
				    </div>
					<?= form_error('kota_tetap', '<small class="text-danger pl-3">', '</small>'); ?>
					<label for="kode_pos_tetap" class="col-sm-2 col-form-label">Kode Pos</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="kode_pos_tetap" name="kode_pos_tetap" value="<?= set_value('kode_pos_tetap') ?>">
				    </div>
					<?= form_error('kode_pos_tetap', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="ktp_sim" class="col-sm-2 col-form-label">NO. KTP/SIM</label>
				    <div class="col-sm-10">
			    	<input type="number" class="form-control" id="ktp_sim" name="ktp_sim" value="<?= set_value('ktp_sim') ?>">
				    </div>
					<?= form_error('ktp_sim', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="npwp" class="col-sm-2 col-form-label">NO.NPWP</label>
				    <div class="col-sm-10">
			    	<input type="number" class="form-control" id="npwp" name="npwp" value="<?= set_value('npwp') ?>">
				    </div>
					<?= form_error('npwp', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="agama" class="col-sm-2 col-form-label">Agama</label>
				    <div class="col-sm-10">
			    	<input type="text" class="form-control" id="agama" name="agama" value="<?= set_value('agama') ?>">
				    </div>
					<?= form_error('agama', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="ibu_kandung" class="col-sm-2 col-form-label">Nama Ibu Kandung</label>
				    <div class="col-sm-10">
			    	<input type="text" class="form-control" id="ibu_kandung" name="ibu_kandung" value="<?= set_value('ibu_kandung') ?>">
				    </div>
					<?= form_error('ibu_kandung', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="golongan_darah" class="col-sm-2 col-form-label">Golongan Darah</label>
				    <div class="col-sm-10">
			    	<input type="text" class="form-control" id="golongan_darah" name="golongan_darah" value="<?= set_value('golongan_darah') ?>">
				    </div>
					<?= form_error('golongan_darah', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="no_telp" class="col-sm-2 col-form-label">NO.TELEPON RUMAH / HP</label>
				    <div class="col-sm-10">
			    	<input type="number" class="form-control" id="no_telp" name="no_telp" value="<?= set_value('no_telp') ?>">
				    </div>
					<?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="masuk_kerja" class="col-sm-2 col-form-label">MASUK KERJA</label>
				    <div class="col-sm-10">
				    	<input type="text" class="form-control" id="masuk_kerja" name="masuk_kerja" value="<?= set_value('masuk_kerja') ?>">
				    </div>
					<?= form_error('masuk_kerja', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="id_divisi" class="col-sm-2 col-form-label">DIVISI</label>
				    <div class="col-sm-10">
				    	<select class="form-control" name="id_divisi" value="<?= set_value('id_divisi'); ?>">
							<option value="">-- pilih --</option>
							<?php foreach ($divisi as $l) { ?>
								<option value="<?= $l->id_divisi; ?>"><?= $l->divisi; ?></option>
							<?php } ?>
						</select>
				    </div>
					<?= form_error('id_divisi', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="id_jabatan" class="col-sm-2 col-form-label">JABATAN</label>
				    <div class="col-sm-10">
				    	<select class="form-control" name="id_jabatan" value="<?= set_value('id_jabatan'); ?>">
							<option value="">-- pilih --</option>
							<?php foreach ($jabatan as $l) { ?>
								<option value="<?= $l->id_jabatan; ?>"><?= $l->jabatan; ?></option>
							<?php } ?>
						</select>
				    </div>
					<?= form_error('id_jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="status" class="col-sm-2 col-form-label">status</label>
				    <div class="col-sm-10">
				    	<select class="form-control" name="status" value="<?= set_value('status'); ?>">
							<option value="">-- pilih --</option>
							<option value="BELUM NIKAH">BELUM NIKAH</option>
							<option value="NIKAH">NIKAH</option>
							<option value="DUDA/JANDA">DUDA/JANDA</option>
						</select>
				    </div>
					<?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="nama_pasangan" class="col-sm-2 col-form-label">NAMA ISTRI/SUAMI</label>
				    <div class="col-sm-10">
				    	<input type="text" class="form-control" id="nama_pasangan" name="nama_pasangan" value="<?= set_value('nama_pasangan') ?>">
				    </div>
					<?= form_error('nama_pasangan', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="bca_cabang" class="col-sm-2 col-form-label">bca. cabang</label>
				    <div class="col-sm-10">
				    	<input type="text" class="form-control" id="bca_cabang" name="bca_cabang" value="<?= set_value('bca_cabang') ?>">
				    </div>
					<?= form_error('bca_cabang', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="no_rek" class="col-sm-2 col-form-label">NO.REK</label>
				    <div class="col-sm-10">
				    	<input type="number" class="form-control" id="no_rek" name="no_rek" value="<?= set_value('no_rek') ?>">
				    </div>
					<?= form_error('no_rek', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>				
				<button class="btn btn-primary float-right" type="submit">Simpan</button>
			</form>
		</div>
	</div>
</div>
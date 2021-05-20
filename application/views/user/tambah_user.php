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
	<div class="card shadow mb-4">
		<div class="card-body">
			<form method="post" action="">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="nik">NIK</label>
							<input type="text" class="form-control" id="nik" name="nik" value="EL-<?= sprintf("%04s", $nik) ?>" readonly>
							<?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
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
							<label for="nama_karyawan">Nama Karyawan</label>
							<input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="<?= set_value('nama_karyawan') ?>">
							<?= form_error('nama_karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="alamat_karyawan">Alamat Karyawan</label>
							<textarea class="form-control" id="alamat_karyawan" name="alamat_karyawan"><?= set_value('alamat_karyawan') ?></textarea>
							<?= form_error('alamat_karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="tahun_bergabung">Tahun Bergabung</label>
							<select class="form-control" name="tahun_bergabung" value="<?= set_value('tahun_bergabung'); ?>">
								<option value="">-- pilih --</option>
								<?php for ($i = date('Y'); $i - 1967; $i--) : ?>
									<option value="<?= $i ?>"><?= $i ?></option>
								<?php endfor; ?>
							</select>
							<?= form_error('tahun_bergabung', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
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
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="id_divisi">Divisi</label>
							<select class="form-control" name="id_divisi" value="<?= set_value('id_divisi'); ?>">
								<option value="">-- pilih --</option>
								<?php foreach ($divisi as $l) { ?>
									<option value="<?= $l->id_divisi; ?>"><?= $l->divisi; ?></option>
								<?php } ?>
							</select>
							<?= form_error('id_divisi', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="id_jabatan">Jabatan</label>
							<select class="form-control" name="id_jabatan" value="<?= set_value('id_jabatan'); ?>">
								<option value="">-- pilih --</option>
								<?php foreach ($jabatan as $l) { ?>
									<option value="<?= $l->id_jabatan; ?>"><?= $l->jabatan; ?></option>
								<?php } ?>
							</select>
							<?= form_error('id_jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
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
				</div>
				<button class="btn btn-primary float-right" type="submit">Simpan</button>
			</form>
		</div>
	</div>
</div>
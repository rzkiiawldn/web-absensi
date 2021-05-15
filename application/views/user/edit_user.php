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
				<input type="hidden" class="form-control" name="id_user" value="<?= $data_user->id_user; ?>" readonly>
				<div class="form-group">
					<label for="nik">NIK</label>
					<input type="text" class="form-control" id="nik" name="nik" value="<?= $data_user->nik; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" id="nama" name="nama" value="<?= $data_user->nama; ?>">
				</div>
				<?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
				<div class="form-group">
					<label for="id_level">Level</label>
					<select class="form-control" name="id_level" value="<?= set_value('id_level'); ?>">
						<?php foreach ($level as $l) { ?>
							<?php if ($l->id_level == $data_user->id_level) { ?>
								<option value="<?= $l->id_level; ?>" selected><?= $l->level; ?></option>
							<?php } else { ?>
								<option value="<?= $l->id_level; ?>"><?= $l->level; ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
				<hr>
				<small class="text-danger">Kosongkan jika password tidak diganti</small>
				<div class="form-group mt-3">
					<label for="password">Password Baru</label>
					<input type="password" class="form-control" id="password" name="password1">
					<?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>
				<button class="btn btn-primary float-right" type="submit">Simpan</button>
			</form>
		</div>
	</div>
</div>
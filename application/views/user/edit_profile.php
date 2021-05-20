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
			<form method="post" action="">
				<input type="hidden" class="form-control" name="id_user" value="<?= $user->id_user; ?>" readonly>
				<!-- <div class="form-group">
					<label for="nik">NIK</label>
					<input type="text" class="form-control" id="nik" name="nik" value="<?= $user->nik; ?>" readonly>
				</div> -->
				<div class="form-group">
					<label for="username">username</label>
					<input type="text" class="form-control" id="username" name="username" value="<?= $user->username; ?>">
				</div>
				<?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
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
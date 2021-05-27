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
			<input type="hidden" name="id_user" value="<?= $data_user['id_user'] ?>">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="id_level">Level</label>
							<select class="form-control" name="id_level" value="<?= $data_user['id_level']; ?>">
								<option value="">-- pilih --</option>
								<?php foreach ($level as $l) { ?>
								<?php if($data_user['id_level'] == $l->id_level) { ?>
									<option value="<?= $l->id_level; ?>" selected><?= $l->level; ?></option>
									<?php } else { ?>									
										<option value="<?= $l->id_level; ?>"><?= $l->level; ?></option>
									<?php } ?>
									<?php } ?>
							</select>
							<?= form_error('id_level', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>					
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="username">username</label>
							<input type="text" class="form-control" id="username" name="username" value="<?= $data_user['username'] ?>">
							<?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
				</div>
				<hr>

				<div class="form-group row">
				    <label for="nik" class="col-sm-2 col-form-label">nik</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="nik" name="nik"  value="<?= $data_user['nik'] ?>" readonly>
				    </div>
					<?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="kantor" class="col-sm-2 col-form-label">kantor</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="kantor" name="kantor" value="<?= $data_user['kantor'] ?>">
				    </div>
					<?= form_error('kantor', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="<?= $data_user['nama_karyawan'] ?>">
				    </div>
					<?= form_error('nama_karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $data_user['tempat_lahir'] ?>">
				    </div>
					<?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $data_user['tanggal_lahir'] ?>">
				    </div>
					<?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="alamat_sekarang" class="col-sm-2 col-form-label">Alamat Sekarang</label>
				    <div class="col-sm-10">
			    	<textarea class="form-control" id="alamat_sekarang" name="alamat_sekarang"><?= $data_user['alamat_sekarang'] ?></textarea>
				    </div>
					<?= form_error('alamat_sekarang', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="kota_sekarang" class="col-sm-2 col-form-label">Kota</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="kota_sekarang" name="kota_sekarang" value="<?= $data_user['kota_sekarang'] ?>">
				    </div>
					<?= form_error('kota_sekarang', '<small class="text-danger pl-3">', '</small>'); ?>
					<label for="kode_pos_sekarang" class="col-sm-2 col-form-label">Kode Pos</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="kode_pos_sekarang" name="kode_pos_sekarang" value="<?= $data_user['kode_pos_sekarang'] ?>">
				    </div>
					<?= form_error('kode_pos_sekarang', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="alamat_tetap" class="col-sm-2 col-form-label">Alamat Tetap (sesuai KTP)	</label>
				    <div class="col-sm-10">
			    	<textarea class="form-control" id="alamat_tetap" name="alamat_tetap"><?= $data_user['alamat_tetap'] ?></textarea>
				    </div>
					<?= form_error('alamat_tetap', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="kota_tetap" class="col-sm-2 col-form-label">Kota</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="kota_tetap" name="kota_tetap" value="<?= $data_user['kota_tetap'] ?>">
				    </div>
					<?= form_error('kota_tetap', '<small class="text-danger pl-3">', '</small>'); ?>
					<label for="kode_pos_tetap" class="col-sm-2 col-form-label">Kode Pos</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="kode_pos_tetap" name="kode_pos_tetap" value="<?= $data_user['kode_pos_tetap'] ?>">
				    </div>
					<?= form_error('kode_pos_tetap', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="ktp_sim" class="col-sm-2 col-form-label">NO. KTP/SIM</label>
				    <div class="col-sm-10">
			    	<input type="number" class="form-control" id="ktp_sim" name="ktp_sim" value="<?= $data_user['ktp_sim'] ?>">
				    </div>
					<?= form_error('ktp_sim', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="npwp" class="col-sm-2 col-form-label">NO.NPWP</label>
				    <div class="col-sm-10">
			    	<input type="number" class="form-control" id="npwp" name="npwp" value="<?= $data_user['npwp'] ?>">
				    </div>
					<?= form_error('npwp', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="agama" class="col-sm-2 col-form-label">Agama</label>
				    <div class="col-sm-10">
			    	<input type="text" class="form-control" id="agama" name="agama" value="<?= $data_user['agama'] ?>">
				    </div>
					<?= form_error('agama', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="ibu_kandung" class="col-sm-2 col-form-label">Nama Ibu Kandung</label>
				    <div class="col-sm-10">
			    	<input type="text" class="form-control" id="ibu_kandung" name="ibu_kandung" value="<?= $data_user['ibu_kandung'] ?>">
				    </div>
					<?= form_error('ibu_kandung', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="golongan_darah" class="col-sm-2 col-form-label">Golongan Darah</label>
				    <div class="col-sm-10">
			    	<input type="text" class="form-control" id="golongan_darah" name="golongan_darah" value="<?= $data_user['golongan_darah'] ?>">
				    </div>
					<?= form_error('golongan_darah', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="no_telp" class="col-sm-2 col-form-label">NO.TELEPON RUMAH / HP</label>
				    <div class="col-sm-10">
			    	<input type="number" class="form-control" id="no_telp" name="no_telp" value="<?= $data_user['no_telp'] ?>">
				    </div>
					<?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="masuk_kerja" class="col-sm-2 col-form-label">MASUK KERJA</label>
				    <div class="col-sm-10">
				    	<input type="date" class="form-control" id="masuk_kerja" name="masuk_kerja" value="<?= $data_user['masuk_kerja'] ?>">
				    </div>
					<?= form_error('masuk_kerja', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="id_divisi" class="col-sm-2 col-form-label">DIVISI</label>
				    <div class="col-sm-10">
				    	<select class="form-control" name="id_divisi" value="<?= $data_user['id_divisi']; ?>">
							<option value="">-- pilih --</option>
							<?php foreach ($divisi as $l) { ?>
							<?php if($l->id_divisi == $data_user['id_divisi']) { ?>
								<option value="<?= $l->id_divisi; ?>" selected><?= $l->divisi; ?></option>
								<?php } else { ?>
								<option value="<?= $l->id_divisi; ?>"><?= $l->divisi; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
				    </div>
					<?= form_error('id_divisi', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="id_jabatan" class="col-sm-2 col-form-label">JABATAN</label>
				    <div class="col-sm-10">
				    	<select class="form-control" name="id_jabatan" value="<?= $data_user['id_jabatan']; ?>">
							<option value="">-- pilih --</option>
							<?php foreach ($jabatan as $l) { ?>
							<?php if($l->id_jabatan == $data_user['id_jabatan']) { ?>
								<option value="<?= $l->id_jabatan; ?>" selected><?= $l->jabatan; ?></option>
								<?php } else { ?>
								<option value="<?= $l->id_jabatan; ?>"><?= $l->jabatan; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
				    </div>
					<?= form_error('id_jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="status" class="col-sm-2 col-form-label">status</label>
				    <div class="col-sm-10">
				    	<select class="form-control" name="status" value="<?= $data_user['status']; ?>">
							<option value="">-- pilih --</option>
							<?php if($data_user['status'] == 'BELUM NIKAH') { ?>
							<option value="BELUM NIKAH" selected>BELUM NIKAH</option>
							<option value="NIKAH">NIKAH</option>
							<option value="DUDA/JANDA">DUDA/JANDA</option>
							<?php } elseif($data_user['status'] == 'NIKAH') { ?>
							<option value="BELUM NIKAH" >BELUM NIKAH</option>
							<option value="NIKAH" selected>NIKAH</option>
							<option value="DUDA/JANDA">DUDA/JANDA</option>
							<?php } else { ?>
							<option value="BELUM NIKAH" >BELUM NIKAH</option>
							<option value="NIKAH" >NIKAH</option>
							<option value="DUDA/JANDA" selected>DUDA/JANDA</option>
							<?php } ?>
						</select>
				    </div>
					<?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="nama_pasangan" class="col-sm-2 col-form-label">NAMA ISTRI/SUAMI</label>
				    <div class="col-sm-10">
				    	<input type="text" class="form-control" id="nama_pasangan" name="nama_pasangan" value="<?= $data_user['nama_pasangan'] ?>">
				    </div>
					<?= form_error('nama_pasangan', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="bca_cabang" class="col-sm-2 col-form-label">bca. cabang</label>
				    <div class="col-sm-10">
				    	<input type="text" class="form-control" id="bca_cabang" name="bca_cabang" value="<?= $data_user['bca_cabang'] ?>">
				    </div>
					<?= form_error('bca_cabang', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group row">
				    <label for="no_rek" class="col-sm-2 col-form-label">NO.REK</label>
				    <div class="col-sm-10">
				    	<input type="number" class="form-control" id="no_rek" name="no_rek" value="<?= $data_user['no_rek'] ?>">
				    </div>
					<?= form_error('no_rek', '<small class="text-danger pl-3">', '</small>'); ?>
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
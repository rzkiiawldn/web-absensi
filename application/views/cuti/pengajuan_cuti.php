<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-10">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?= $judul; ?></h4>
				</div>
				<div class="card-body">
                <form action="<?= base_url('cuti/ajukan') ?>" method="post">
                    <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                    <div class="form-group">
                        <label for="tgl_cuti">Tanggal Cuti</label>
                        <input type="date" class="form-control" id="tgl_cuti" aria-describedby="emailHelp" name="tgl_cuti" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_selesai_cuti">Cuti Selesai</label>
                        <input type="date" class="form-control" id="tgl_selesai_cuti" aria-describedby="emailHelp" required name="tgl_selesai_cuti">
                    </div>
                    <div class="form-group">
                        <label for="alasan_cuti">Alasan Cuti</label>
                        <textarea name="alasan_cuti" id="alasan_cuti" rows="5" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
				</div>
			</div>
		</div>
	</div>
</div>
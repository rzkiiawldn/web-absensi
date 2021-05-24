<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?= $judul; ?></h4>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<th>No</th>
							<th>Karyawan</th>
							<th>Aksi</th>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($data_user as $u) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $u->nama_karyawan ?></td>
									<td>
										<a href="<?= base_url('absensi/detail_absensi/' . $u->id_user) ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
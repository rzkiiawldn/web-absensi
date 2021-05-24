<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?= $judul; ?></h4>
				</div>
				<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
                                <th>Karyawan</th>
								<th>Tanggal Mulai Cuti</th>
								<th>Tanggal Selesai Cuti</th>
								<th>Alasan Cuti</th>
                            </tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($cuti as $c) { ?>
							<tr>
                                <td><?= $no++ ?></td>
								<td><?= $c->nama_karyawan ?></td>
								<td><?= $c->tgl_cuti ?></td>
								<td><?= $c->tgl_selesai_cuti ?></td>
								<td><?= $c->alasan_cuti ?></td>
                            </tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
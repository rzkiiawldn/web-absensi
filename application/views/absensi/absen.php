<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-lg-10">
			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card-body">
					<div class="table-responsive">
						<div class="row">
							<div class="col-md-12 mb-3">
								Tanggal : <strong><?= tgl_hari(date('d-m-Y')) ?></strong>
							</div>
							<div class="col-md-12">
								<table class="table">
									<tr>
										<td>Absen Masuk</td>
										<td>Absen Pulang</td>
									</tr>
									<tr>
										<?php if (is_weekend()) : ?>
											<td class="bg-light text-danger" colspan="2">Hari ini libur. Tidak Perlu absen</td>
										<?php else : ?>
											<td>
												<?php if ($absen == 1 || $absen == 2 || date('H:i:s') < $jam_masuk->mulai) { ?>
													<a href="#" class="btn btn-sm btn-primary disabled">Absen Masuk</a>
												<?php } else { ?>
													<a href="<?= base_url('absensi/status/masuk/' . $user->id_user) ?>" class="btn btn-sm btn-primary">Absen Masuk</a>
												<?php } ?>
											</td>
											<td>
												<?php if ($absen !== 1 || $absen == 2 || date('H:i:s') < $jam_pulang->mulai) { ?>
													<a href="#" class="btn btn-sm btn-success disabled">Absen Pulang</a>
												<?php } else { ?>
													<a href="<?= base_url('absensi/status/pulang/' . $user->id_user) ?>" class="btn btn-sm btn-success">Absen Pulang</a>
												<?php } ?>
											</td>
										<?php endif; ?>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
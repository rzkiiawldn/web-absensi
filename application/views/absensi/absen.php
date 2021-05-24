<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row justify-content-center">
		<div class="col-lg-12">
			<h1 class="h3 mb-4 text-gray-800"><?= $act; ?></h1>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-lg-12">
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
                    <td>Tidak Hadir</td>
									</tr>
									<tr>
											
                      <?php if(empty($today)) { ?>
                        <td>
                          <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#masuk">Absen Masuk</a>
                        </td>
                        <td>
                          <div style="cursor: not-allowed"><a href="#" class="btn btn-sm btn-success disabled">Absen Pulang</a></div>
                        </td>
                        <td><a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#izin">Tidak Hadir</a></td>
                      <?php } elseif($today['absen_masuk'] != null AND $today['absen_pulang'] == null) { ?>
                        <td>
                          <div style="cursor: not-allowed"><a href="#" class="btn btn-sm btn-primary disabled">Absen Masuk</a></div>
                          </td>
                        <td>
                          <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#pulang">Absen Pulang</a>
                        </td>
                      <?php } else { ?>
                        <td colspan="3" class="bg-danger text-white">Hari ini kamu sudah absen</td>
                      <?php } ?>
									</tr>
								</table>

                <!-- <td>
                        <?php if ($absen['keterangan_masuk'] != null ) { ?>
                          <div style="cursor:not-allowed;"><a href="#" class="btn btn-sm btn-primary disabled">Absen Masuk</a></div>
                        <?php } else { ?>
                          <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#masuk">Absen Masuk</a>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if ($absen['keterangan_masuk'] == null || $absen['keterangan_masuk'] == 'Masuk') { ?>
                          <div style="cursor:not-allowed;"><a href="#" class="btn btn-sm btn-success disabled">Absen Pulang</a></div>
                        <?php } else { ?>
                          <?php $id = $this->db->query("SELECT * FROM absen WHERE id_user = '$user->id_user' ORDER BY id_absen DESC LIMIT 1")->row(); ?>
                          <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#pulang<?= $id->id_absen; ?>">Absen Pulang</a>
                        <?php } ?>
                      </td> -->
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="masuk" tabindex="-1" aria-labelledby="masukLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="masukLabel">Absen Masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="card-body">
                <video class="embed-responsive" id="webcam" style="display: none;" autoplay playsinline ></video>
                <img id="hasil_gambar" class="embed-responsive" style="display: none" src="">
                <canvas id="canvas" class="d-none"></canvas>
                <audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio>
                <button id="camera" onclick="picture()" type="button" class="btn btn-block btn-default mb-2">Open Camera</button>
                <button id="candak_gambar" style="display: none;" onclick="take_picture()" type="button" class="btn btn-block btn-default mb-2">Take Picture</button>
        				<form method="post" action="<?=site_url('absensi/status') ?>">
                  <select name="keterangan_jadwal" class="form-control" required="">
                    <option value="" disabled selected>-- Pilih Jadwal --</option>
                <?php foreach ($jadwal as $j) : ?>
                      <option value="<?= $j->jadwal; ?>"><?= $j->jadwal; ?></option>
                <?php endforeach; ?>
                </select><br>
                  <input type="hidden" required="true" name="act"  value="<?=$act?>">
                  <input type="hidden" required="true" name="id_absen" value="<?=$id_absen?>">
                  <input type="hidden" required="true" name="foto" id="foto">
                  <input type="hidden" required="true" name="long" id="long">
                  <input type="hidden" required="true" name="lat" id="lat">
                  <button class="btn btn-block btn-primary" type="submit">Submit</button>
                </form>
              </div>
        </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="masuk" tabindex="-1" aria-labelledby="masukLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="masukLabel">Absen masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="card-body">
                <video class="embed-responsive" id="webcam" style="display: none;" autoplay playsinline ></video>
                <img id="hasil_gambar" class="embed-responsive" style="display: none" src="">
                <canvas id="canvas" class="d-none"></canvas>
                <audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio>
                <button id="camera" onclick="picture()" type="button" class="btn btn-block btn-default mb-2">Open Camera</button>
                <button id="candak_gambar" style="display: none;" onclick="take_picture()" type="button" class="btn btn-block btn-default mb-2">Take Picture</button>
                <form method="post" action="<?=site_url('absensi/status') ?>">
                  <input type="hidden" required="true" name="act"  value="<?=$act?>">
                  <input type="hidden" required="true" name="id_absen" value="<?=$id_absen?>">
                  <input type="hidden" required="true" name="foto" id="foto">
                  <input type="hidden" required="true" name="long" id="long">
                  <input type="hidden" required="true" name="lat" id="lat"> 
                  <button class="btn btn-block btn-primary" type="submit">Submit</button>
                </form>
              </div>
        </div>
    </div>
  </div>
</div> -->

<div class="modal fade" id="pulang" tabindex="-1" aria-labelledby="pulangLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pulangLabel">Absen pulang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="card-body">
                <video class="embed-responsive" id="webcam_pulang" style="display: none;" autoplay playsinline ></video>
                <img id="hasil_gambar_pulang" class="embed-responsive" style="display: none" src="">
                <canvas id="canvas_pulang" class="d-none"></canvas>
                <audio id="snapSound_pulang" src="audio/snap.wav" preload = "auto"></audio>
                <button id="camera_pulang" onclick="picture_pulang()" type="button" class="btn btn-block btn-default mb-2">Open Camera</button>
                <button id="candak_gambar_pulang" style="display: none;" onclick="take_picture_pulang()" type="button" class="btn btn-block btn-default mb-2">Take Picture</button>
                <form method="post" action="<?=site_url('absensi/status') ?>">
                  <input type="hidden" required="true" name="act"  value="<?=$act?>">
                  <input type="hidden" required="true" name="id_absen" value="<?=$id_absen?>">
                  <input type="hidden" required="true" name="foto" id="foto_pulang">
                  <input type="hidden" required="true" name="long" id="long_pulang">
                  <input type="hidden" required="true" name="lat" id="lat_pulang"> 
                  <button class="btn btn-block btn-primary" type="submit">Submit</button>
                </form>
              </div>
        </div>
    </div>
  </div>
</div>


<!-- <div class="modal fade" id="pulang<?= $id->id_absen; ?>" tabindex="-1" aria-labelledby="pulangLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pulangLabel">Absen Pulang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="card-body">
                <video class="embed-responsive" id="webcam_pulang" style="display: none;" autoplay playsinline ></video>
                <img id="hasil_gambar_pulang" class="embed-responsive" style="display: none" src="">
                <canvas id="canvas_pulang" class="d-none"></canvas>
                <audio id="snapSound_pulang" src="audio/snap.wav" preload = "auto"></audio>
                <button id="camera_pulang" onclick="picture_pulang()" type="button" class="btn btn-block btn-default mb-2">Open Camera</button>
                <button id="candak_gambar_pulang" style="display: none;" onclick="take_picture_pulang()" type="button" class="btn btn-block btn-default mb-2">Take Picture</button>
        <form method="post" action="<?=site_url('absensi/pulang/' . $id->id_absen)?>">
                  <input type="hidden" name="id_absen" value="<?= $id->id_absen; ?>">
                  <input type="hidden" required="true" name="foto" id="foto_pulang">
                  <input type="hidden" required="true" name="long" id="long_pulang">
                  <input type="hidden" required="true" name="lat" id="lat_pulang">  
                  <button class="btn btn-block btn-primary" type="submit">Submit</button>
                </form>
              </div>
        </div>
    </div>
  </div>
</div> -->


<!-- Modal -->
<div class="modal fade" id="izin" tabindex="-1" aria-labelledby="izinLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="izinLabel">izin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="card-body">
        				<form method="post" action="<?=site_url('absensi/izin') ?>">
                <label for="">Keterangan</label>
                <select name="status" class="form-control" required="">
                    <option value="" disabled selected>---</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                </select><br>

                <label for="keterangan">Alasan</label>
                  <textarea name="keterangan" id="keterangan" required rows="5"  class="form-control"></textarea><br>
                  <button class="btn btn-block btn-primary" type="submit">Submit</button>
                </form>
              </div>
        </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  function picture() {
    // body...
    const webcamElement = document.getElementById('webcam');
    const canvasElement = document.getElementById('canvas');
    const snapSoundElement = document.getElementById('snapSound');
    const webcam = new Webcam(webcamElement, 'user', canvasElement);
      webcam.start()
    .then(result =>{
      console.log("webcam started");
      $("#hasil_gambar").css({ 'display' : 'none'});
      $("#webcam").css({ 'display' : 'block'});
      $("#camera").css({ 'display' : 'none'});
      $("#candak_gambar").css({ 'display' : 'block'});
      // let picture = webcam.snap();
      // alert(picture)
    })
    .catch(err => {
      console.log(err);
    });
  }
  function take_picture()
  {
    // alert('test')
    const webcamElement = document.getElementById('webcam');
    const canvasElement = document.getElementById('canvas');
    const snapSoundElement = document.getElementById('snapSound');
    const webcam = new Webcam(webcamElement, 'user', canvasElement);
    let picture = webcam.snap();
      $("#webcam").css({ 'display' : 'none'});
      $("#camera").css({ 'display' : 'block'});
      $("#candak_gambar").css({ 'display' : 'none'});
      $("#hasil_gambar").attr("src", picture);
      $("#hasil_gambar").css({ 'display' : 'block'});
      $('#foto').val(picture)
      webcam.stop()
  }
  getLocation()
  var x = document.getElementById("lat");
  function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  $('#lat').val(position.coords.latitude)
  $('#long').val(position.coords.longitude)
  // x.innerHTML = "Latitude: " + position.coords.latitude + 
  // "<br>Longitude: " + position.coords.longitude;
}
      // initMap();
    </script>

    <!-- Pulang -->

    <script type="text/javascript">
  function picture_pulang() {
    // body...
    const webcamElement = document.getElementById('webcam_pulang');
    const canvasElement = document.getElementById('canvas_pulang');
    const snapSoundElement = document.getElementById('snapSound_pulang');
    const webcam = new Webcam(webcamElement, 'user', canvasElement);
      webcam.start()
    .then(result =>{
      console.log("webcam started");
      $("#hasil_gambar_pulang").css({ 'display' : 'none'});
      $("#webcam_pulang").css({ 'display' : 'block'});
      $("#camera_pulang").css({ 'display' : 'none'});
      $("#candak_gambar_pulang").css({ 'display' : 'block'});
      // let picture = webcam.snap();
      // alert(picture)
    })
    .catch(err => {
      console.log(err);
    });
  }
  function take_picture_pulang()
  {
    // alert('test')
    const webcamElement = document.getElementById('webcam_pulang');
    const canvasElement = document.getElementById('canvas_pulang');
    const snapSoundElement = document.getElementById('snapSound_pulang');
    const webcam = new Webcam(webcamElement, 'user', canvasElement);
    let picture = webcam.snap();
      $("#webcam_pulang").css({ 'display' : 'none'});
      $("#camera_pulang").css({ 'display' : 'block'});
      $("#candak_gambar_pulang").css({ 'display' : 'none'});
      $("#hasil_gambar_pulang").attr("src", picture);
      $("#hasil_gambar_pulang").css({ 'display' : 'block'});
      $('#foto_pulang').val(picture)
      webcam.stop()
  }
  getLocation()
  var x = document.getElementById("lat_pulang");
  function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  $('#lat_pulang').val(position.coords.latitude)
  $('#long_pulang').val(position.coords.longitude)
  // x.innerHTML = "Latitude: " + position.coords.latitude + 
  // "<br>Longitude: " + position.coords.longitude;
}
      // initMap();
    </script>

    <script>
function myFunction() {
  var x = document.getElementById("jadwal").value;
  document.getElementById("keterangan_jadwal").value = x;
}
</script>
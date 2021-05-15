</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="<?= base_url() ?>assets/#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>assets/js/demo/datatables-demo.js"></script>

<!-- Custom Script -->
<script>
    var hoursLabel = document.getElementById("hours");
    var minutesLabel = document.getElementById("minutes");
    var secondsLabel = document.getElementById("seconds");
    setInterval(setTime, 1000);

    function setTime() {
        secondsLabel.innerHTML = pad(Math.floor(new Date().getSeconds()));
        minutesLabel.innerHTML = pad(Math.floor(new Date().getMinutes()));
        hoursLabel.innerHTML = pad(Math.floor(new Date().getHours()));
    }

    function pad(val) {
        var valString = val + "";
        if (valString.length < 2) {
            return "0" + valString;
        } else {
            return valString;
        }
    }
</script>

<!-- Script hak akses user -->
<script>
    // menangkap elemen yang class form-check-input
    $('.form-check-input').on('click', function() {
        // dan ketika di klik menjalakan fungsi berikut
        // membuat variabel
        // data(diambil dari nama datanya diinput)
        const menuId = $(this).data('menu')
        const submenuId = $(this).data('submenu')
        const levelId = $(this).data('level')

        // jalankan ajax
        $.ajax({
            // arahkan url ke controller
            url: "<?= base_url('pengaturan/ubah_akses_menu'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                submenuId: submenuId,
                levelId: levelId
            },
            // ketika semua berhasil arahkan ke controller
            success: function() {
                document.location.href = "<?= base_url('pengaturan/hak_akses_menu/') ?>" + levelId;
            }

            // 
        });
    });
</script>

</body>

</html>
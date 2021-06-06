<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                Copyright MIS &copy; <script>
                    document.write(new Date().getFullYear())
                </script><a href=""> MSAL Group</a>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js di taro di bawah menu sidebar-->
<!-- <script src="<?= base_url() ?>/assets/js/vendor.min.js"></script> -->
<!-- third party js -->
<script src="<?= base_url() ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<!-- third party js ends -->
<!-- Datatables init -->
<script src="<?= base_url() ?>/assets/js/pages/datatables.init.js"></script>
<!-- Plugins js-->
<script src="<?= base_url() ?>/assets/libs/flatpickr/flatpickr.min.js"></script>
<!-- <script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script> -->
<script src="<?= base_url() ?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
<!-- Dashboar 1 init js-->
<script src="<?= base_url() ?>/assets/js/pages/dashboard-1.init.js"></script>
<!-- App js-->
<script src="<?= base_url() ?>/assets/js/app.min.js"></script>

</body>

</html>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "scrollY": 400,
            "scrollX": true
        });
    });

    function deptPemChange() {
        var tes = document.getElementById("deptPem").value;
        document.getElementById("dept_pem").value = tes;
    }

    function deptMisChange() {
        var tes = document.getElementById("deptMis").value;
        document.getElementById("dept_mis").value = tes;
    }
</script>
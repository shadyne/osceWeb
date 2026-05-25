        </section>
    </div>
</div>

<script src="<?= base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/bower_components/select2/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/bower_components/moment/min/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('assets/bower_components/pace/pace.min.js') ?>"></script>

<script>
$(function () {
    $('table.datatable').DataTable({ "pageLength": 25, "responsive": true });
    $('.select2').select2();
});
</script>
</body>
</html>

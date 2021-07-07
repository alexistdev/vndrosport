<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<?php $this->load->view('admin/template/v_header') ?>
<style>
	.has-error .select2-selection {
		border-color: rgb(185, 74, 72) !important;
	}
</style>
<body class="hold-transition sidebar-mini pace-danger">
<div class="wrapper">
	<!-- Site wrapper -->
	<?php $this->load->view('admin/template/v_navbar') ?>
	<?php $this->load->view('admin/template/v_sidebar') ?>
	<?php $this->load->view('admin/konten/k_tambahprovinsi') ?>
	<?php $this->load->view('admin/template/v_footer') ?>
</div>
<!-- jQuery -->
<script src="<?= base_url('vendor/almasaeed2010/adminlte') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('vendor/almasaeed2010/adminlte') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('vendor/almasaeed2010/adminlte') ?>/dist/js/adminlte.min.js"></script>
<!-- pace-progress -->
<script src="<?= base_url('vendor/almasaeed2010/adminlte') ?>/plugins/pace-progress/pace.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('vendor/almasaeed2010/adminlte') ?>/plugins/select2/js/select2.full.min.js"></script>
<script>
	$(function () {
		$(".select2").select2();
	});
</script>
</body>


</html>
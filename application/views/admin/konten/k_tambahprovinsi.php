<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><i class="fas fa-globe-americas"></i> Provinsi</h1>
					<p><small><?= ($tag == 'add')?"Tambah":"Edit"; ?> Provinsi</small></p>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('admin/provinsi') ?>">Provinsi</a></li>
						<li class="breadcrumb-item active"><?= ($tag == 'add')?"Add":"Edit"; ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row col d-flex justify-content-center">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<!-- Start Pesan -->
					<?php
					echo $this->session->flashdata('pesan1');
					echo $this->session->flashdata('pesan2'); ?>
					<!-- End Pesan -->
				</div>
			</div>

			<!-- Default box -->
			<div class="row col d-flex justify-content-center">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
					<div class="card card-dark card-outline">
						<div class="card-body">
						<?php if($tag == 'edit') { ?>
							<form action="<?= base_url('admin/provinsi/edit/'.sanitasi($idProvinsi))?>"  method="post">
						<?php } else { ?>
							<form action="<?= base_url('admin/provinsi/add')?>"  method="post">
						<?php } ?>

								<div class="form-group">
									<div class="input-group mb-3 <?= (form_error('namaNegara') != null)? 'has-error':''; ?>">
										<div class="input-group-prepend">
											<span class="input-group-text">Negara</span>
										</div>
										<select name="namaNegara" class="form-control select2" required>
											<option value="" selected="selected">Pilih</option>
											<?php foreach($dataNegara as $rowNegara): ?>
												<option value="<?= sanitasi($rowNegara['id']); ?>"  <?php echo set_select('namaNegara', $rowNegara['id']); ?><?= (sanitasi($optDataNegara) == sanitasi($rowNegara['id']))? "SELECTED" :""; ?>><?= strtoupper(sanitasi($rowNegara['nama_negara'])); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<?= form_error('namaNegara'); ?>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Nama Provinsi</span>
										</div>
										<input type="text" name="namaProvinsi" id="namaProvinsi" value="<?= ($tag == 'edit')?strtoupper(sanitasi($dataProvinsi)):set_value('namaProvinsi'); ?>" maxlength="80" class="form-control <?= (form_error('namaProvinsi') != null)? 'is-invalid':''; ?>" placeholder="Provinsi" required/>

									</div>
									<?= form_error('namaProvinsi'); ?>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
									<a href="<?= base_url('admin/provinsi'); ?>"><button type="button" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</button></a>
								</div>
							</form>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


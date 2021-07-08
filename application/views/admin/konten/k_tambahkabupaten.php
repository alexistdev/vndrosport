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
					<h1><i class="fas fa-globe-americas"></i> Kabupaten</h1>
					<p><small><?= ($tag == 'add')?"Tambah":"Edit"; ?> Kabupaten</small></p>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('admin/kabupaten') ?>">Kabupaten</a></li>
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
							<form action="<?= base_url('admin/kabupaten/edit/'.sanitasi($idKabupaten))?>"  method="post">
								<?php } else { ?>
								<form action="<?= base_url('admin/kabupaten/add')?>"  method="post">
									<?php } ?>

									<div class="form-group">
										<div class="input-group mb-3 <?= (form_error('namaProvinsi') != null)? 'has-error':''; ?>">
											<div class="input-group-prepend">
												<span class="input-group-text">Provinsi</span>
											</div>
											<select name="namaProvinsi" class="form-control select2" required>
												<option value="" selected="selected">Pilih</option>
												<?php foreach($dataProvinsi as $rowProvinsi): ?>
													<option value="<?= sanitasi($rowProvinsi['id_provinsi']); ?>"  <?php echo set_select('namaProvinsi', $rowProvinsi['id_provinsi']); ?><?= (sanitasi($optDataProvinsi) == sanitasi($rowProvinsi['id_provinsi']))? "SELECTED" :""; ?>><?= strtoupper(sanitasi($rowProvinsi['nama_provinsi'])); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<?= form_error('namaProvinsi'); ?>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">Nama Kabupaten</span>
											</div>
											<input type="text" name="namaKabupaten" id="namaKabupaten" value="<?= ($tag == 'edit')?strtoupper(sanitasi($dataKabupaten)):set_value('namaKabupaten'); ?>" maxlength="80" class="form-control <?= (form_error('namaKabupaten') != null)? 'is-invalid':''; ?>" placeholder="Kabupaten" required/>

										</div>
										<?= form_error('namaKabupaten'); ?>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
										<a href="<?= base_url('admin/kabupaten'); ?>"><button type="button" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</button></a>
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


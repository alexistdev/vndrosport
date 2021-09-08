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
					<h1>Edit Toko <?= sanitasi($namaToko); ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('admin/toko'); ?>">Toko</a></li>
						<li class="breadcrumb-item active">Edit</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<?php
					echo $this->session->flashdata('pesan1'); ?>
				</div>
			</div>
			<form action="<?= base_url('admin/toko/edit/' . sanitasi($idToko)); ?>" method="post">
				<div class="row">
					<!--	Form Ruas Kiri		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- Start: Nama Toko -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="namaToko">Nama Toko <span class="text-danger">*</span></label>
											<input type="text" name="namaToko" id="namaToko" maxlength="80"
												   class="form-control"
												   value="<?= set_value('namaToko', sanitasi($namaToko)); ?>"
												   placeholder="Nama Toko" required="required">
											<?= form_error('namaToko'); ?>
										</div>
									</div>
								</div>
								<!-- End: Nama Toko -->

								<!-- Start: Email Toko -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">

											<label for="emailToko">Email Toko <span
														class="text-danger">*</span></label>
											<input type="text" name="emailToko" id="emailToko" maxlength="80"
												   class="form-control"
												   value="<?= set_value('emailToko', sanitasi($emailToko)); ?>"
												   placeholder="Email" required="required">
											<?= form_error('emailToko'); ?>
										</div>
									</div>
								</div>
								<!-- End: Email Toko -->

								<!-- Start: Telp Toko -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">

											<label for="telpToko">Telepon Toko <span
														class="text-danger">*</span></label>
											<input type="text" name="telpToko" id="telpToko" maxlength="80"
												   class="form-control"
												   value="<?= set_value('telpToko', sanitasi($telpToko)); ?>"
												   placeholder="Telp" required="required">
											<?= form_error('telpToko'); ?>
										</div>
									</div>
								</div>
								<!-- End: Email Toko -->

								<!-- Start: Alamat Toko -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">

											<label for="alamatToko">Alamat Toko <span
														class="text-danger">*</span></label>
											<input type="text" name="alamatToko" id="alamatToko" maxlength="80"
												   class="form-control"
												   value="<?= set_value('alamatToko', sanitasi($alamatToko)); ?>"
												   placeholder="Alamat" required>
											<?= form_error('alamatToko'); ?>
										</div>

									</div>
								</div>
								<!-- End: Email Toko -->

								<!-- Start: Submit -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary">Simpan</button>
											<a href="<?= base_url('admin/toko'); ?>">
												<button type="button" class="btn btn-danger">Batal</button>
											</a>
										</div>
									</div>
								</div>
								<!-- End: Submit -->
							</div>
						</div>
					</div>

				</div>
			</form>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->

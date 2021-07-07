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
					<h1>Tambah Client</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('admin/client') ?>">Client</a></li>
						<li class="breadcrumb-item active">Add</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-md-12">
					<!-- Start Pesan -->
					<?php
					echo $this->session->flashdata('pesan1');
					echo $this->session->flashdata('pesan2'); ?>
					<!-- End Pesan -->
				</div>
			</div>
			<!-- Default box -->
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title">Tambah Client</h3>
						</div>
						<div class="card-body">
							<form action="<?= base_url('admin/client/add')?>" method="post">

										<div class="form-group">
											<label for="email">Email <span class="text-danger">*</span></label>
											<input type="text" name="email" id="email" value="<?= set_value('email')?>" maxlength="100" class="form-control <?= (form_error('email') != null)? 'is-invalid':''; ?>" placeholder="Alamat Email" required/>
											<?= form_error('email'); ?>
										</div>
										<div class="form-group">
											<label for="password">Password <span class="text-danger">*</span></label>
											<input type="password" name="password" id="password" value="<?= set_value('password')?>" maxlength="16" class="form-control <?= (form_error('password') != null)? 'is-invalid':''; ?>" placeholder="******" required/>
											<?= form_error('password'); ?>
										</div>
										<div class="form-group">
											<label for="namaLengkap">Nama Lengkap </label>
											<input type="namaLengkap" name="namaLengkap" id="namaLengkap" value="<?= set_value('namaLengkap')?>" maxlength="100" class="form-control <?= (form_error('namaLengkap') != null)? 'is-invalid':''; ?>" placeholder="Nama Lengkap" />
											<?= form_error('namaLengkap'); ?>
										</div>
										<div class="form-group">
											<label for="noTelp">Nomor Telepon </label>
											<input type="text" name="noTelp" id="noTelp" value="<?= set_value('noTelp')?>" maxlength="30" class="form-control <?= (form_error('noTelp') != null)? 'is-invalid':''; ?>" placeholder="Nomor Telepon" />
											<?= form_error('noTelp'); ?>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-sm btn-primary">Publish</button>
											<a href="<?= base_url('admin/berita'); ?>"><button type="button" class="btn btn-sm btn-danger">Cancel</button></a>
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


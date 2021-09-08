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
					<h1>Detail Client <?= sanitasi($namaLengkap); ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('admin/client'); ?>">Client</a></li>
						<li class="breadcrumb-item active"><?= sanitasi($namaLengkap); ?></li>
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
			<div class="row">
				<!-- Khusus Personal Hosting -->
				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title">Informasi Client</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table class="table">
								<tbody>
								<tr>
									<th scope="row" width="10%">Email</th>
									<td width="5%">:</td>
									<td><?= sanitasi($dataEmail); ?></td>
								</tr>
								<tr>
									<th scope="row" width="10%">Nama Lengkap</th>
									<td width="5%">:</td>
									<td><?= sanitasi($namaLengkap); ?></td>
								</tr>
								<tr>
									<th scope="row" width="10%">Telepon</th>
									<td width="5%">:</td>
									<td><?= sanitasi($dataTelp); ?></td>
								</tr>
								<tr>
									<th scope="row" width="10%">Alamat</th>
									<td width="5%">:</td>
									<td><?= sanitasi($dataAlamat); ?></td>
								</tr>
								</tbody>
							</table>
							<a href="<?= base_url('admin/client'); ?>"><button class="btn btn-danger">Kembali</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--	Modal Kunci Pesan	-->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
			</div>
			<div class="modal-body">
				Apakah anda yakin ingin menghapus data ini ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<a href="" id="urlKunci"><button  type="button" class="btn btn-danger">Hapus</button></a>
			</div>
		</div>
	</div>
</div>
<!--	/Modal Kunci Pesan	-->

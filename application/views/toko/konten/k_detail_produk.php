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
					<h1>Nama Produk</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('store/dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Produk</li>
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
				<div class="col-md-12">
					<!-- Default box -->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Projects Detail</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
									<div class="row">
										<div class="col-12 col-sm-4">
											<div class="info-box bg-light">
												<div class="info-box-content">
													<span class="info-box-text text-center text-muted">Harga</span>
													<span class="info-box-number text-center text-muted mb-0">2300</span>
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-4">
											<div class="info-box bg-light">
												<div class="info-box-content">
													<span class="info-box-text text-center text-muted">Stok</span>
													<span class="info-box-number text-center text-muted mb-0">11</span>
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-4">
											<div class="info-box bg-light">
												<div class="info-box-content">
													<span class="info-box-text text-center text-muted">Terjual</span>
													<span class="info-box-number text-center text-muted mb-0">22</span>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<h4>Detail Produk</h4>
											<table class="table table-striped">
												<tbody>
												<tr>
													<th scope="row">Ukuran</th>
													<td>:</td>
													<td>All size</td>
												</tr>
												<tr>
													<th scope="row">Warna</th>
													<td>:</td>
													<td>Merah</td>

												</tr>
												<tr>
													<th scope="row">Ditambahkan</th>
													<td>:</td>
													<td>12-12-2021</td>

												</tr>
												<tr>
													<th scope="row">Deskripsi</th>
													<td>:</td>
													<td>12-12-2021</td>

												</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
									<img src="<?= base_url('gambar/produk/ad8HmrA6TI.jpg'); ?>" alt="gambar produk" height="300px">
									<div class="text-center mt-5 mb-3">
										<a href="#" class="btn btn-sm btn-primary">Add files</a>
										<a href="<?= base_url('store/produk'); ?>" class="btn btn-sm btn-danger">Batal</a>
									</div>
								</div>
							</div>
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
<!--	/Modal Kunci Pesan	-->

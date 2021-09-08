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
					<h1>Data Produk</h1>
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
				<!-- Khusus Personal Hosting -->
				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title">Daftar Produk</h3>
							<a href="<?= base_url('store/produk/add'); ?>">
								<button class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> &nbsp;Tambah
								</button>
							</a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="tabelProduk" class="table table-bordered table-hover" style="width: 100%">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Nama Produk</th>
									<th class="text-center">Sub Total</th>
									<th class="text-center">Jumlah</th>
									<th class="text-center">Gambar</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $no = 1; ?>
								<?php foreach ($dataTransaksi as $row):
									$status = sanitasi($row['status']);
									?>
									<tr>
										<td class="text-center"><?= sanitasi($no++); ?></td>
										<td><?= sanitasi($row['nama_produk']); ?></td>
										<td class="text-center">
											Rp. <?= number_format(sanitasi($row['sub_total']), 0, ",", "."); ?></td>
										<td class="text-center"><?= sanitasi($row['jumlah']); ?></td>
										<td class="text-center"><img
													src="<?= base_url('gambar/produk/' . sanitasi($row['gambar'])); ?>"
													alt="<?= sanitasi($row['nama_produk']); ?>" width="50px"
													height="auto"></td>
										<td class="text-center">
											<?php if ($status == 2) { ?>
												<a href="<?= base_url('store/transaksi/konfirm/' . sanitasi($row['id'] . '/' . sanitasi($row['id_pesanan']))); ?>">
													<button class="btn btn-primary btn-sm" data-toggle="tooltip"
															data-placement="top" title="View"><i
																class="fas fa-check-square"></i></button>
												</a>
												<button class="btn btn-danger btn-sm" data-toggle="tooltip"
														data-placement="top" title="Hapus"><i class="fas fa-trash"></i>
												</button>
											<?php } ?>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
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
				<a href="" id="urlKunci">
					<button type="button" class="btn btn-danger">Hapus</button>
				</a>
			</div>
		</div>
	</div>
</div>
<!--	/Modal Kunci Pesan	-->

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
					<h1>Transaksi</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Transaksi</li>
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
							<h3 class="card-title">Daftar Toko</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="tabelKabupaten" class="table table-bordered table-hover" style="width: 100%">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Nomor Pesanan</th>
									<th class="text-center">User</th>
									<th class="text-center">Judul Pesanan</th>
									<th class="text-center">Tanggal</th>
									<th class="text-center">Sub Total</th>
									<th class="text-center">Biaya Antar</th>
									<th class="text-center">Total Jumlah</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $no = 1; ?>
								<?php foreach ($dataTransaksi as $row):
									$status = sanitasi($row['status']);
									if ($status == 1) {
										$pesan = "<span class=\"text-danger font-weight-bold\">Belum Dibayar</span>";
									} else if ($status == 2) {
										$pesan = "<span class=\"text-warning font-weight-bold\">Sudah Dibayar</span>";
									} else if ($status == 3) {
										$pesan = "<span class=\"text-success font-weight-bold\">Diproses Toko</span>";
									} else if ($status == 4) {
										$pesan = "<span class=\"text-primary font-weight-bold\">Dikirimkan</span>";
									} else if($status == 5){
										$pesan = "selesai";
									} else {
										$pesan = "dibatalkan";
									}
									?>
									<tr>
										<td class="text-center"><?= $no++; ?></td>
										<td class="text-center">#<?= sanitasi($row['id']); ?></td>
										<td class="text-center"><?= sanitasi($row['nama_lengkap']); ?></td>
										<td><?= sanitasi($row['judul']); ?></td>
										<td class="text-center"><?= date("d-m-Y", sanitasi($row['tanggal'])); ?></td>
										<td class="text-center">
											Rp <?= number_format(sanitasi($row['sub_total']), 0, ",", "."); ?></td>
										<td class="text-center">
											Rp <?= number_format(sanitasi($row['biaya_antar']), 0, ",", "."); ?></td>
										<td class="text-center">
											Rp <?= number_format(sanitasi($row['total_jumlah']), 0, ",", "."); ?></td>
										<td class="text-center"><?= $pesan; ?></td>
										<td class="text-center">
											<?php if ($status == 2) { ?>
												<button class="btn btn-sm btn-primary">Proses</button>
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

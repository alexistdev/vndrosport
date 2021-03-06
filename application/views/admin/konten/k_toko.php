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
					<h1>Toko</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Toko</li>
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
									<th class="text-center">Nama Toko</th>
									<th class="text-center" width="10%">Email</th>
									<th class="text-center">Nomor Telpon</th>
									<th class="text-center">Alamat</th>
									<th class="text-center">Terakhir Online</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $no=1; $provinsi="";?>
								<?php foreach($dataToko as $row): ?>
									<tr>
										<td class="text-center"><?= $no++; ?></td>
										
										
										<td><?= sanitasi($row['nama_toko']); ?></td>
										<td><?= sanitasi($row['email']); ?></td>
										<td><?= sanitasi($row['telp']); ?></td>
										<td><?= sanitasi($row['alamat']); ?></td>
										<td><?= date('l d-m-Y H:i:s',sanitasi($row['last_online'])); ?></td>
										
										<td class="text-center">
											<a href="<?= base_url('admin/toko/edit/'.encrypt_url(sanitasi($row['id']))); ?>"><button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
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
				<a href="" id="urlKunci"><button  type="button" class="btn btn-danger">Hapus</button></a>
			</div>
		</div>
	</div>
</div>
<!--	/Modal Kunci Pesan	-->

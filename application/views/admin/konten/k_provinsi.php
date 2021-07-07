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
					<h1>Provinsi</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Provinsi</li>
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
							<h3 class="card-title">Daftar Provinsi</h3>
							<a href="<?= base_url('admin/provinsi/add'); ?>"><button class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> &nbsp;Tambah</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="tabelRiwayat" class="table table-bordered table-hover" style="width: 100%">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Nama Provinsi</th>
									<th class="text-center">Negara</th>
									<th class="text-center">Dibuat tgl</th>
									<th class="text-center">Update tgl</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php foreach($dataProvinsi as $rowProvinsi): ?>
										<tr>
											<td class="text-center"><?= sanitasi($no++); ?></td>
											<td ><?= strtoupper(sanitasi($rowProvinsi['nama_provinsi'])); ?></td>
											<td class="text-center"><?= strtoupper(sanitasi($rowProvinsi['nama_negara'])); ?></td>
											<td class="text-center"><?= date('l d-m-Y H:i:s', sanitasi($rowProvinsi['created_at'])); ?></td>
											<td class="text-center"><?= date('l d-m-Y H:i:s', sanitasi($rowProvinsi['updated_at'])); ?></td>
											<td class="text-center">
												<a href="<?= base_url('admin/provinsi/edit/'.encrypt_url(sanitasi($rowProvinsi['id_provinsi']))); ?>"><button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
												<button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Tampil Kabupaten"><i class="fas fa-eye"></i></button>
												<span id="tombolHapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= encrypt_url(sanitasi($rowProvinsi['id_provinsi'])) ?>">
													<button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
												</span>
											</td>
										</tr>
									<?php endforeach ;?>
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

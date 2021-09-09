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
					<h1><?= ($tag !='edit')?"Tambah":"Edit"; ?> Produk <?= ($tag != 'edit')?"": "<span class=\"text-primary font-weight-bold\">".sanitasi($namaProduk)."</span>"; ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('admin/client') ?>">Client</a></li>
						<li class="breadcrumb-item active"><?= ($tag !='edit')?"Add":"Edit"; ?></li>
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
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title"><?= ($tag !='edit')?"Tambah":"Edit"; ?> Produk</h3>
						</div>
						<div class="card-body">
							<?php if($tag != 'edit'){ ?>
								<form action="<?= base_url('store/produk/add')?>" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-4">
										<!-- Start: Kategori -->
										<div class="form-group">
											<label for="email">Kategori <span class="text-danger">*</span></label>
											<select name="namaKategori" id="namaKategori" class="form-control">
												<option value="">Kategori</option>
												<?php foreach($selectKategori->result_array() as $row): ?>
													<option value="<?= sanitasi($row['id']); ?>"><?= sanitasi($row['nama_kategori']); ?></option>
												<?php endforeach; ?>
											</select>
											<?= form_error('namaKategori'); ?>
										</div>
										<!-- End: Kategori -->

										<!-- Start: Merek -->
										<div class="form-group">
											<label for="namaMerek">Merek <span class="text-danger">*</span></label>
											<select name="namaMerek" id="namaMerek" class="form-control">
												<option value="">Merek</option>
												<?php foreach($selectMerek->result_array() as $row): ?>
													<option value="<?= sanitasi($row['id']); ?>"><?= sanitasi($row['nama_merek']); ?></option>
												<?php endforeach; ?>
											</select>
											<?= form_error('namaMerek'); ?>
										</div>
										<!-- End: Merek -->

										<!-- Start: Nama Produk -->
										<div class="form-group">
											<label for="namaProduk">Nama Produk <span class="text-danger">*</span></label>
											<input type="text" name="namaProduk" id="namaProduk" value="<?= set_value('namaProduk')?>" maxlength="50" class="form-control <?= (form_error('namaProduk') != null)? 'is-invalid':''; ?>" placeholder="Nama Produk" />
											<?= form_error('namaProduk'); ?>
										</div>
										<!-- End: Nama Produk -->

										<!-- Start: Warna -->
										<div class="form-group">
											<label for="warna">Warna <span class="text-danger">*</span></label>
											<input type="text" name="warna" id="warna" value="<?= set_value('warna')?>" maxlength="20" class="form-control <?= (form_error('warna') != null)? 'is-invalid':''; ?>" placeholder="Merah/Biru/Kuning" />
											<?= form_error('warna'); ?>
										</div>
										<!-- End: Warna -->

										<!-- Start: Ukuran -->
										<div class="form-group">
											<label for="ukuran">Ukuran <span class="text-danger">*</span></label>
											<input type="text" name="ukuran" id="ukuran" value="<?= set_value('ukuran')?>" maxlength="10" class="form-control <?= (form_error('ukuran') != null)? 'is-invalid':''; ?>" placeholder="All size/X/L/M/S" />
											<?= form_error('ukuran'); ?>
										</div>
										<!-- End: Ukuran -->

										<!-- Start: Harga -->
										<div class="form-group">
											<label for="harga">Harga <span class="text-danger">*</span></label>
											<input type="number" name="harga" id="harga" value="<?= set_value('harga')?>" class="form-control <?= (form_error('harga') != null)? 'is-invalid':''; ?>" placeholder="Harga barang" />
											<?= form_error('harga'); ?>
										</div>
										<!-- End: Harga -->
									</div>
									<div class="col-md-4">
										<!-- Start: Stok -->
										<div class="form-group">
											<label for="stok">Stok <span class="text-danger">*</span></label>
											<input type="number" name="stok" id="stok" value="<?= set_value('stok')?>" class="form-control <?= (form_error('stok') != null)? 'is-invalid':''; ?>" placeholder="Jumlah Stok" />
											<?= form_error('stok'); ?>
										</div>
										<!-- End: number -->

										<!-- Start: Deskripsi -->
										<div class="form-group">
											<label for="deskripsi">Deskripsi Produk</label>
											<textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"><?= set_value('deskripsi')?></textarea>
											<?= form_error('deskripsi'); ?>
										</div>
										<!-- End: Deskripsi -->

										<!-- Start: Gambar -->
										<div class="form-group">

											<label for="gambar">Gambar<span class="text-danger">*</span></label>
											<input type="file" name="gambar" id="gambar" value="<?= set_value('gambar')?>" class="form-control-file" />
											<?= form_error('gambar'); ?>
										</div>
										<!-- End: Gambar -->

										<div class="form-group float-right">
											<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
											<a href="<?= base_url('store/produk'); ?>"><button type="button" class="btn btn-sm btn-danger">Cancel</button></a>
										</div>
									</div>
								</div>
							</form>
							<?php } else { ?>
								<form action="<?= base_url('store/produk/edit/'.$id)?>" method="post">
									<div class="row">
										<div class="col-md-4">
											<!-- Start: Kategori -->
											<div class="form-group">
												<label for="email">Kategori <span class="text-danger">*</span></label>
												<select name="namaKategori" id="namaKategori" class="form-control">
													<option value="">Kategori</option>
													<?php foreach($selectKategori->result_array() as $row): ?>
														<option value="<?= sanitasi($row['id']); ?>" <?= (sanitasi($optionKategori) == sanitasi($row['id']))?"SELECTED":""; ?>><?= sanitasi($row['nama_kategori']); ?></option>
													<?php endforeach; ?>
												</select>
												<?= form_error('namaKategori'); ?>
											</div>
											<!-- End: Kategori -->

											<!-- Start: Merek -->
											<div class="form-group">
												<label for="namaMerek">Merek <span class="text-danger">*</span></label>
												<select name="namaMerek" id="namaMerek" class="form-control">
													<option value="">Merek</option>
													<?php foreach($selectMerek->result_array() as $row): ?>
														<option value="<?= sanitasi($row['id']); ?>" <?= (sanitasi($optionMerek) == sanitasi($row['id']))?"SELECTED":""; ?>><?= sanitasi($row['nama_merek']); ?></option>
													<?php endforeach; ?>
												</select>
												<?= form_error('namaMerek'); ?>
											</div>
											<!-- End: Merek -->

											<!-- Start: Nama Produk -->
											<div class="form-group">
												<label for="namaProduk">Nama Produk <span class="text-danger">*</span></label>
												<input type="text" name="namaProduk" id="namaProduk" value="<?= set_value('namaProduk',sanitasi($namaProduk))?>" maxlength="50" class="form-control <?= (form_error('namaProduk') != null)? 'is-invalid':''; ?>" placeholder="Nama Produk" />
												<?= form_error('namaProduk'); ?>
											</div>
											<!-- End: Nama Produk -->

											<!-- Start: Warna -->
											<div class="form-group">
												<label for="warna">Warna <span class="text-danger">*</span></label>
												<input type="text" name="warna" id="warna" value="<?= set_value('warna',sanitasi($warnaProduk))?>" maxlength="20" class="form-control <?= (form_error('warna') != null)? 'is-invalid':''; ?>" placeholder="Merah/Biru/Kuning" />
												<?= form_error('warna'); ?>
											</div>
											<!-- End: Warna -->

											<!-- Start: Ukuran -->
											<div class="form-group">
												<label for="ukuran">Ukuran <span class="text-danger">*</span></label>
												<input type="text" name="ukuran" id="ukuran" value="<?= set_value('ukuran',sanitasi($ukuranProduk))?>" maxlength="10" class="form-control <?= (form_error('ukuran') != null)? 'is-invalid':''; ?>" placeholder="All size/X/L/M/S" />
												<?= form_error('ukuran'); ?>
											</div>
											<!-- End: Ukuran -->

											<!-- Start: Harga -->
											<div class="form-group">
												<label for="harga">Harga <span class="text-danger">*</span></label>
												<input type="number" name="harga" id="harga" value="<?= set_value('harga',sanitasi($hargaProduk))?>" class="form-control <?= (form_error('harga') != null)? 'is-invalid':''; ?>" placeholder="Harga barang" />
												<?= form_error('harga'); ?>
											</div>
											<!-- End: Harga -->
										</div>
										<div class="col-md-4">
											<!-- Start: Stok -->
											<div class="form-group">
												<label for="stok">Stok <span class="text-danger">*</span></label>
												<input type="number" name="stok" id="stok" value="<?= set_value('stok',sanitasi($stokProduk))?>" class="form-control <?= (form_error('stok') != null)? 'is-invalid':''; ?>" placeholder="Jumlah Stok" />
												<?= form_error('stok'); ?>
											</div>
											<!-- End: number -->

											<!-- Start: Deskripsi -->
											<div class="form-group">
												<label for="deskripsi">Deskripsi Produk</label>
												<textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"><?= set_value('deskripsi',sanitasi($deskripsiProduk))?></textarea>
												<?= form_error('deskripsi'); ?>
											</div>
											<!-- End: Deskripsi -->


											<div class="form-group float-right">
												<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
												<a href="<?= base_url('store/produk'); ?>"><button type="button" class="btn btn-sm btn-danger">Cancel</button></a>
											</div>
										</div>
									</div>
								</form>
							<?php } ?>
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


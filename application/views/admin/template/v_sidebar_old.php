<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('Member'); ?>" class="brand-link">
		<img src="<?= base_url('gambar/myicon.png'); ?>"
			 alt="AdminLTE Logo"
			 class="brand-image img-circle elevation-3"
			 style="opacity: .8">
		<span class="brand-text font-weight-light"><?= _judulPendek(); ?></span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url('gambar/myicon.png'); ?>" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="<?= base_url('admin/dashboard'); ?>" class="d-block">Dashboard</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
					 with font-awesome or any other icon font library -->
				<li class="nav-item has-treeview">
					<a href="<?= base_url('admin/dashboard'); ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-file"></i>
						<p>
							Master Data
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('admin/provinsi'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Master Provinsi</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/kabupaten'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Master Kabupaten</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/kecamatan'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Master Kecamatan</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/kategori'); ?>" class="nav-link">
						<i class="nav-icon fas fa-clipboard-list"></i>
						<p>
							Kategori
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/merek'); ?>" class="nav-link">
						<i class="nav-icon fas fa-list-alt"></i>
						<p>
							Merek
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/client'); ?>" class="nav-link">
						<i class="nav-icon fas fa-user-friends"></i>
						<p>
							Client
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/toko'); ?>" class="nav-link">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>
							Toko
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/setting'); ?>" class="nav-link">
						<i class="nav-icon fas fa-cog"></i>
						<p>
							Setting
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>

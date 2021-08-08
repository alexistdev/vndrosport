<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('store/dashboard'); ?>" class="brand-link">
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
				<a href="<?= base_url('store/dashboard'); ?>" class="d-block">Dashboard</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
					 with font-awesome or any other icon font library -->
				<li class="nav-item has-treeview">
					<a href="<?= base_url('store/dashboard'); ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url('store/produk'); ?>" class="nav-link">
						<i class="nav-icon fas fa-box"></i>
						<p>
							Produk
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('store/transaksi'); ?>" class="nav-link">
						<i class="nav-icon fas fa-balance-scale"></i>
						<p>
							Transaksi
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('store/setting'); ?>" class="nav-link">
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

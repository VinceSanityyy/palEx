<template>
	<div>
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"
						><i class="fas fa-bars"></i
					></a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar elevation-4 sidebar-light-maroon">
			<!-- Brand Logo -->
			<a href="index3.html" class="brand-link text-sm">
				<img
					src="https://i.pinimg.com/originals/ad/ca/08/adca082427894069f92dd11fda3d96cb.gif"
					alt="AdminLTE Logo"
					class="brand-image img-circle elevation-3"
					style="opacity: 0.8"
				/>
				<span class="brand-text font-weight-light">PalEx</span>
			</a>

			<!-- Sidebar -->
			<div
				class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"
			>
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img
							src="https://png.pngtree.com/png-clipart/20190924/original/pngtree-user-vector-avatar-png-image_4830521.jpg"
							class="img-circle elevation-2"
							alt="User Image"
						/>
					</div>
					<div class="info">
						<a href="#" class="d-block">Vendor Admin User</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul
						class="nav nav-pills nav-sidebar flex-column nav-child-indent"
						data-widget="treeview"
						role="menu"
						data-accordion="false"
					>
                        <li class="nav-item">
							<router-link to="/vendor" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Dashboard</p>
							</router-link>
						</li>
                        <li class="nav-item">
							<router-link to="/vendor/products" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Products</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/vendor/orders" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Orders</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/vendors" class="nav-link">
								<i class="nav-icon fas fa-users"></i>
								<p>User Management</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/vendors" class="nav-link">
								<i class="nav-icon fas fa-newspaper"></i>
								<p>Feeds</p>
							</router-link>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link" onclick="">
								<i class="nav-icon fas fa-times"></i>
								<p>Log out</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->

			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<router-view />
					<router-view name="helper" />
				</div>
				<!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong>Copyright &copy; 2021-2022 <a href="#">PalEx</a>.</strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 3.0.0
			</div>
		</footer>
	</div>
</template>

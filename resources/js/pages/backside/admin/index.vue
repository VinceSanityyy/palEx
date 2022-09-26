<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Palex Admin Dashboard</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-info">
							<div class="inner">
								<h3>{{ vendorsCount }}</h3>

								<p>Total Vendors</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
							<router-link class="small-box-footer" to="/admin/vendors">
								More info <i class="fas fa-arrow-circle-right"></i>
							</router-link>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-success">
							<div class="inner">
								<h3>{{ customersCount }}</h3>

								<p>Total Customers</p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
							<router-link class="small-box-footer" to="/admin/vendors">
								More info <i class="fas fa-arrow-circle-right"></i>
							</router-link>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-warning">
							<div class="inner">
								<h3>{{ acceptedVendors }}</h3>

								<p>Vendors Accepted</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<router-link class="small-box-footer" to="/admin/vendors">
								More info <i class="fas fa-arrow-circle-right"></i>
							</router-link>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-danger">
							<div class="inner">
								<h3>{{newsfeeds}}</h3>

								<p>Total News Posted</p>
							</div>
							<div class="icon">
								<i class="ion ion-pie-graph"></i>
							</div>
							<router-link class="small-box-footer" to="/admin/feeds">
								More info <i class="fas fa-arrow-circle-right"></i>
							</router-link>
						</div>
					</div>
					<!-- ./col -->
				</div>
			</div>
		</section>
	</div>
</template>

<script>
	export default {
          props:['is_auth'],
		data() {
			return {
				vendorsCount: 0,
				customersCount: 0,
				acceptedVendors: 0,
				newsfeeds: 0
			};
		},
		methods: {
			getVendorsCount() {
				axios.get("/countVendors").then((res) => {
					this.vendorsCount = res.data;
				});
			},
			getCustomersCount() {
				axios.get("/countCustomers").then((res) => {
					this.customersCount = res.data;
				});
			},
			getAcceptedVendorsCount() {
				axios.get("/countAcceptedVendors").then((res) => {
					this.acceptedVendors = res.data;
				});
			},
			getNewsfeedCount(){
				axios.get("/getNewsfeedCount").then((res) => {
					this.newsfeeds = res.data;
				});
			}
		},
		created() {
			this.getVendorsCount();
			this.getCustomersCount();
			this.getAcceptedVendorsCount();
			this.getNewsfeedCount();
		},
	};
</script>

<style>
</style>

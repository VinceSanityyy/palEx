<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Vendor Orders</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Orders</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h3 class="card-title">Users List</h3>
							</div>
							<div class="card-body table-responsive">
								<table
									id="mytableOrders"
									class="table table-bordered table-striped dt-responsive display nowrap"
								>
									<thead>
										<tr>
											<th>Order Id</th>
											<th>Amount</th>
											<th>Status</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(item, index) in orders" :key="index">
											<td>{{ item.id }}</td>
											<td>
												<b
													>₱
													{{
														addCommaAndTwoDecimalPlaces(
															item.total_price
														)
													}}</b
												>
											</td>
											<td>
												<span
													v-if="item.status === 1"
													class="badge badge-success"
													>{{ item.status_label }}</span
												>
												<span v-else class="badge badge-warning">{{
													item.status_label
												}}</span>
											</td>
											<td>{{ item.date }}</td>
											<td>
												<router-link
													class="btn btn-info btn-sm"
													:to="'vendor/orders/' + item.id"
													>Details</router-link
												>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				orders: [
					{
						id: 1,
						total_price: 1500,
						status: 1,
						status_label: "Success",
						date: "May 5, 2021",
					},
				],
			};
		},
		mounted() {
			setTimeout(() => {
				this.myTable();
			}, 1000);
		},
		methods: {
			myTable() {
				$(document).ready(function () {
					$("#mytableOrders").DataTable({
						responsive: true,
					});
				});
			},
			addCommaAndTwoDecimalPlaces(value) {
				var n = parseFloat(value).toFixed(2);
				var withCommas = Number(n).toLocaleString("en", {
					minimumFractionDigits: 2,
					maximumFractionDigits: 2,
				});
				return withCommas;
			},
		},
	};
</script>

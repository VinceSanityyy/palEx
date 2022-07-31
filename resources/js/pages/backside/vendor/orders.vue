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
									class="table table-bordered table-striped dt-responsive"
								>
									<thead>
										<tr>
											<th>Order Id</th>
											<th>Customer Name</th>
											<th>Contact #</th>
											<th>Address</th>
											<th>Amount</th>
											<th>Status</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(item, index) in orders" :key="index">
											<td>{{ item.id }}</td>
											<td>{{ item.customer_receiver_fullname }}</td>
											<td>{{ item.customer_receiver_phone }}</td>
											<td>{{ item.customer_receiver_address }}</td>
											<td>
												<b
													>₱
													{{
														addCommaAndTwoDecimalPlaces(
															item.order_items[0].total_price
														)
													}}</b
												>
											</td>
											<td>
												<span v-if="item.status === 'completed'"
													class="badge badge-success">{{ item.status }}
												</span>
												<span v-else-if="item.status === 'pending'"
													class="badge badge-secondary">{{ item.status }}
												</span>
												<span v-else-if="item.status === 'cod'"
													class="badge badge-info">{{ item.status }}
												</span>
												<span v-else-if="item.status === 'reserved'"
													class="badge badge-info">{{ item.status }}
												</span>
												<span v-else class="badge badge-danger">{{
													item.status
												}}</span>
											</td>
											<td>{{ item.created_at }}</td>
											<td>
								 				 <div class="btn-group" role="group">
													<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Select Options
													</button>
													<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
														<a class="dropdown-item" @click="changeOrderStatus(item.id,'completed')" href="#">Completed</a>
														<!-- <a class="dropdown-item" @click="changeOrderStatus(item.id,'cod')" href="#">Cash on Delivery</a> -->
														<a class="dropdown-item" @click="changeOrderStatus(item.id,'reserved')" href="#">Reserved</a>
														<a class="dropdown-item" @click="changeOrderStatus(item.id,'pending')" href="#">Pending</a>
														<a class="dropdown-item" @click="changeOrderStatus(item.id,'cancelled')" href="#">Cancelled</a>
													</div>
												</div>
													<button  type="button" class="btn btn-info">
														Show Order Details
													</button>
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
        props:['is_auth'],
		data() {
			return {
				orders: [],
				showModal: false,
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
			changeOrderStatus(id,status){
				axios.post(`/palex_api/vendor/updateOrderStatus`, {
					id: id,
					status: status,
				}).then((response) => {
					this.getOrders()
					toastr.success('Order Modified!')
				});
			},
			getOrders(){
				axios.get(`/palex_api/vendor/getOrders`).then((response) => {
					this.orders = response.data;
					console.log(response.data)
				});
			}
		},
		created(){
			this.getOrders();
		}
	};
</script>

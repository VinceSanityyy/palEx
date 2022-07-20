<style lang="scss" scoped>
#customer-order-page {
	.status-info {
		margin-left: auto;
		width: fit-content;

		@media (max-width: 767px) {
			margin-left: 5px !important;
		}
	}
	.palex-order-summary {
		min-height: 100px;
		.total {
			font-size: 20px;
			font-weight: 1000;
			color: #2c9144;
		}
	}
	.delfee-color {
		color: lightsalmon !important;
	}

	.prods {
		@media (max-width: 991px) {
			justify-content: center;
		}

		.prod-img {
			img {
				width: 80px;
				height: 80px;
				object-fit: cover;
				// border: 1px solid black;
				box-shadow: 1px 1px 1px 1px rgba(0, 174, 119, 0.5) !important;

				@media (max-width: 991px) {
					width: 65px;
					height: 65px;
				}

				@media (max-width: 768px) {
					width: 65px;
					height: 65px;
				}

				@media (max-width: 425px) {
					width: 55px;
					height: 55px;
				}

				@media (max-width: 424px) {
					width: 40px;
					height: 40px;
				}
			}
		}
	}
}
</style>
<template>
	<section id="customer-order-page" class="content mt-2" style="margin-bottom: 5rem">
		<div class="container">
			<div class="row">
				<div class="col-md-12 px-0">
					<div class="palex-card">
						<div class="px-2" style="font-weight: bold; font-size: 24px">
							<i class="fas fa-file-invoice mr-2"></i>
							My Orders
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="d-none container palex-checkout-page">
			<div class="row">
				<div class="col-md-12 px-0">
					<div class="palex-card">
						<div style="display: flex; justify-content: center; align-items: center; height: 450px">
							<div class="text-center">
								<h3>There are no items in this cart</h3>
								<div>
									<el-button type="success" plain @click="backToProducts()">Continue Shopping</el-button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container palex-checkout-page">
			<div class="row">
				<div class="col-md-3 px-0">
					<div class="palex-card">
						<div class="palex-order-summary py-2">
							<h3 class="my-3 text-center"></h3>

							<button type="button" class="btn btn-light w-100 mb-1">
								<span class="d-flex justify-content-between">
									<span> All </span>
									<span>
										<span class="badge badge-light">
											{{ orders_data.orders_total }}
										</span>
									</span>
								</span>
							</button>

							<button type="button" class="btn btn-light w-100 mb-1">
								<span class="d-flex justify-content-between">
									<span> Pending </span>
									<span>
										<span class="badge badge-warning">
											{{ orders_data.orders_pending }}
										</span>
									</span>
								</span>
							</button>

							<button type="button" class="btn btn-light w-100 mb-1">
								<span class="d-flex justify-content-between">
									<span> To Deliver </span>
									<span>
										<span class="badge badge-info">
											{{ orders_data.orders_to_deliver }}
										</span>
									</span>
								</span>
							</button>

							<button type="button" class="btn btn-light w-100 mb-1">
								<span class="d-flex justify-content-between">
									<span> Completed </span>
									<span>
										<span class="badge badge-success">
											{{ orders_data.orders_completed }}
										</span>
									</span>
								</span>
							</button>

							<button type="button" class="btn btn-light w-100 mb-1">
								<span class="d-flex justify-content-between">
									<span> Cancelled </span>
									<span>
										<span class="badge badge-danger">
											{{ orders_data.orders_cancelled }}
										</span>
									</span>
								</span>
							</button>
						</div>
					</div>
				</div>

				<div class="col-md-9 px-0">
					<div v-for="(item, index) in orders_data.orders" :key="index" class="palex-card mb-2">
						<div class="row">
							<div class="col-md-8">
								<div class="d-flex px-2 mb-2 align-items-center">
									<span class="mr-2">#{{ item.id }}</span>
									<i class="fas fa-store mr-1"></i>
									<span style="font-weight: bold"> {{ item.vendor.name }} </span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="status-info">
									<span class="px-2 badge" :class="badgeStatus(item.status)" style="font-size: 18px; text-transform: uppercase">
										{{ item.status }}
									</span>
								</div>
							</div>
						</div>

						<hr />

						<div class="row">
							<div class="col-lg-9">
								<div class="prods d-flex flex-wrap align-items-center">
									<div v-for="(picture, index2) in item.order_first_five_pictures" :key="index2" class="p-1 prod-img">
										<img :src="picture" />
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="w-100 d-flex justify-content-center align-items-center py-2" style="height: 100%">
									<el-button @click="moreDetailsBtn(item.id)" type="primary" size="medium" plain>More Details</el-button>
								</div>
							</div>
						</div>

						<div class="d-flex justify-content-between px-2">
							<span> Payment Method</span>
							<span class="mx-1"> Cash On Delivery </span>
						</div>

						<div class="d-flex justify-content-between px-2">
							<span> Orders Total </span>
							<span class="mx-1"> ₱{{ frmtd(item.order_total_amount) }} </span>
						</div>

						<!-- <div class="d-flex justify-content-between px-2 delfee-color">
							<span> Delivery Fee </span>
							<span class="mx-1"> ₱{{ frmtd(item.shipping_fee) }} </span>
						</div> -->

						<div class="d-flex justify-content-between px-2">
							<span> Discount </span>
							<span class="mx-1"> ₱{{ frmtd(0) }} </span>
						</div>
						<hr />
						<div class="d-flex justify-content-between px-2" style="color: #2c9144; font-weight: 600">
							<span> Total </span>
							<span class="mx-1"> ₱{{ frmtd(item.order_overall_total_amount) }} </span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
export default {
	props: ["is_auth"],
	data() {
		return {
			orders_data: {
				orders: [],
				orders_total: 0,
				orders_pending: 0,
				orders_to_deliver: 0,
				orders_completed: 0,
				orders_cancelled: 0,
			},
		};
	},
	mounted() {
		this.getOrders();
	},
	methods: {
		moreDetailsBtn(order_id) {
			this.$router.push(`/customer/orders/${order_id}`);
		},
		badgeStatus(status) {
			if (status == "pending") return "badge-warning";
			if (status == "to ship") return "badge-info";
			if (status == "completed") return "badge-success";
			if (status == "cancelled") return "badge-danger";
			return "badge-warning";
		},
		async getOrders() {
			try {
				const res = await axios.get("/getCustomerOrders");
				this.orders_data = res.data;
			} catch (error) {
				console.error(err);
			}
		},

		frmtd(value) {
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


<style lang="scss" scoped>
#customer-order-detail-page {
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
	<section id="customer-order-detail-page" class="content mt-2" style="margin-bottom: 5rem">
		<div class="container">
			<div class="row">
				<div class="col-md-12 px-0">
					<div class="palex-card">
						<div class="px-2" style="font-weight: bold; font-size: 24px">
							<i class="fas fa-file-invoice mr-2"></i>
							Order details page (Underconstruction)
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 px-0">
					<div class="palex-card">
						<div class="w-100">
							<div class="store-name ml-3 mb-2 p-2 border-bottom border-secondary">
								<span> <i class="fas fa-store mr-2"></i> {{ "VENDOR NAME HERE" }} </span>
								<!-- <el-divider><i class="el-icon-star-on"></i></el-divider> -->
							</div>

							<div class="d-flex justify-content-between px-2">
								<span> Status: </span>
								<span class="px-2 badge" :class="badgeStatus('pending')" style="font-size: 18px; text-transform: uppercase">
									{{ "pending" }}
								</span>
							</div>

							<div class="d-flex justify-content-between px-2">
								<span> Payment Method </span>
								<span class="mx-1">Cash On Delivery</span>
							</div>

							<div v-for="index2 in 5" :key="index2" class="item border-bottom border-success p-2">
								<div class="d-flex">
									<div class="prod-img" style="min-width: 90px">
										<img style="width: 80px; height: 80px; object-fit: cover" :src="`/storage/images/products/seeds/apple.jpg`" alt="" />
									</div>
									<div class="prod-name w-100">
										<div class="d-flex">
											<div style="width: 90%">
												<span
													><b>{{ "Product Name APple" }}</b></span
												>
											</div>
										</div>
										<div class="prod-cat" style="font-size: 10px; color: #c644a8">
											<span>{{ "Product Category ex. Fruit" }}</span>
										</div>
										<div class="prod-price d-flex flex-wrap justify-content-between">
											<span>₱{{ frmtd(123) }}/{{ "unit kilo" }}</span>
											<span class="mx-1">x</span>
											<span class="mx-1">{{ 123 }}</span>
											<span class="mx-1">=</span>
											<span class="mx-1" style="color: #2c9144">₱{{ frmtd(123) }}</span>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="d-flex justify-content-between px-2">
							<span> Sub-total </span>
							<span class="mx-1"> ₱{{ frmtd(123) }} </span>
						</div>

						<div class="d-flex justify-content-between px-2">
							<span> Discount </span>
							<span class="mx-1"> ₱{{ frmtd(123) }} </span>
						</div>

						<hr />

						<div class="d-flex justify-content-between px-2" style="font-size: 20px; color: #2c9144; font-weight: bold">
							<span> Total </span>
							<span class="mx-1"> ₱{{ frmtd(123) }} </span>
						</div>

						<hr />

						<div class="d-flex justify-content-between px-2">
							<span>  </span>
							<span class="mx-1"> <el-button type="danger" plain>Cancel</el-button> </span>
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
			order_id: this.$route.params.order_id,
		};
	},
	mounted() {
		console.log(this.order_id);
		this.getOrder();
	},
	methods: {
		badgeStatus(status) {
			if (status == "pending") return "badge-warning";
			if (status == "to ship") return "badge-info";
			if (status == "completed") return "badge-success";
			if (status == "cancelled") return "badge-danger";
			return "badge-warning";
		},
		async getOrder() {
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


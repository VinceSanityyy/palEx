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
										<span class="badge badge-light">5</span>
									</span>
								</span>
							</button>

							<button type="button" class="btn btn-light w-100 mb-1">
								<span class="d-flex justify-content-between">
									<span> Pending </span>
									<span>
										<span class="badge badge-warning">5</span>
									</span>
								</span>
							</button>

							<button type="button" class="btn btn-light w-100 mb-1">
								<span class="d-flex justify-content-between">
									<span> To Deliver </span>
									<span>
										<span class="badge badge-info">5</span>
									</span>
								</span>
							</button>

							<button type="button" class="btn btn-light w-100 mb-1">
								<span class="d-flex justify-content-between">
									<span> Complated </span>
									<span>
										<span class="badge badge-success">5</span>
									</span>
								</span>
							</button>

							<button type="button" class="btn btn-light w-100 mb-1">
								<span class="d-flex justify-content-between">
									<span> Cancelled </span>
									<span>
										<span class="badge badge-danger">5</span>
									</span>
								</span>
							</button>
						</div>
					</div>
				</div>

				<div class="col-md-9 px-0">
					<div v-for="idx in 3" :key="idx" class="palex-card mb-2">
						<div class="row">
							<div class="col-md-8">
								<div class="d-flex px-2 mb-2 align-items-center">
									<i class="fas fa-store mr-1"></i>
									<span style="font-weight: bold"> Store Name In here</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="status-info">
									<span class="px-2 badge badge-warning" style="font-size: 18px">PENDING</span>
								</div>
							</div>
						</div>

						<hr />

						<div class="row">
							<div class="col-lg-9">
								<div class="prods d-flex flex-wrap align-items-center">
									<div v-for="index in 5" :key="index" class="p-1 prod-img">
										<img src="/storage/images/products/seeds/apple.jpg" />
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="w-100 d-flex justify-content-center align-items-center py-2" style="height: 100%">
									<el-button type="primary" size="medium" plain>More Details</el-button>
								</div>
							</div>
						</div>

						<div class="d-flex justify-content-between px-2">
							<span> Payment Method</span>
							<span class="mx-1"> Cash On Delivery </span>
						</div>

						<div class="d-flex justify-content-between px-2">
							<span> Orders Total </span>
							<span class="mx-1"> ₱{{ frmtd(123) }} </span>
						</div>

						<div class="d-flex justify-content-between px-2 delfee-color">
							<span> Delivery Fee </span>
							<span class="mx-1"> ₱{{ frmtd(123) }} </span>
						</div>

						<div class="d-flex justify-content-between px-2">
							<span> Discount </span>
							<span class="mx-1"> ₱{{ frmtd(123) }} </span>
						</div>
						<hr />
						<div class="d-flex justify-content-between px-2" style="color: #2c9144; font-weight: 600">
							<span> Total </span>
							<span class="mx-1"> ₱{{ frmtd(123) }} </span>
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
			cartList: [],
			//   cartList: [
			//     {
			//       items: [
			//         {
			//           product: {},
			//         },
			//       ],
			//       vendor: {},
			//     },
			//   ],
			user: {},
			total_order_amount: 0,
			discount: 0,
			overall_total: 0,
			qty: 1,
		};
	},
	mounted() {
		this.getCurrentAuth();
		this.getCart();
	},
	methods: {
		async PlaceOrder() {
			try {
				const res = await axios.post("/placeOrder");
				this.$message({
					message: "Success Place Order",
					type: "success",
					customClass: "palex-msg-min-width",
				});
				// this.getCart();
				this.$router.push("/customer/orders");
				// /customer/orders
			} catch (error) {
				console.error(err);
			}
		},
		backToProducts() {
			this.$router.push("/products");
		},
		removeCartItem(el) {
			this.$events.fire("LoadingOverlayShow");
			axios
				.post(`/removeCartItem`, {
					cart_item_id: el.id,
				})
				.then((res) => {
					this.getCart();
				})
				.catch((err) => {
					this.getCart();
				});
		},
		updateQuantity(el) {
			this.$events.fire("LoadingOverlayShow");
			// console.log(el);
			// console.log(el.quantity);
			axios
				.post(`/updateCartItem`, {
					cart_item_id: el.id,
					quantity: el.quantity,
				})
				.then((res) => {
					console.log(res);
					this.getCart();
				})
				.catch((err) => {
					console.error(err);
					this.getCart();
				});
		},
		getCurrentAuth() {
			axios.get("/me").then((res) => {
				this.user = res.data;
			});
		},
		getCart() {
			axios
				.get(`/getCart`)
				.then((res) => {
					this.$events.fire("LoadingOverlayHide");
					this.cartList = res.data.details;
					this.total_order_amount = res.data.total_order_amount;
					this.total_delivery_fee = res.data.total_shipping_fee;
					this.discount = res.data.discount;
					this.overall_total = res.data.over_all_total;
				})
				.catch((err) => {
					this.$events.fire("LoadingOverlayHide");
					console.error(err);
				});
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


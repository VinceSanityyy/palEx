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
							Order details page (Underconstruction)
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
		// this.getOrders();
	},
	methods: {
		badgeStatus(status) {
			if (status == "pending") return "badge-warning";
			if (status == "to ship") return "badge-info";
			if (status == "completed") return "badge-success";
			if (status == "cancelled") return "badge-danger";
			return "badge-warning"
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


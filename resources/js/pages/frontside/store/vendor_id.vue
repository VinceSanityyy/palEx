<template>
	<div id="products-page-vendor">
		<div class="container cus-container border-success border-bottom pb-0">
			<div class="row">
				<div class="col-md-6 img">
					<!-- <img src="/img/test/comp.png" alt="" class="store-profile-image" /> -->
					<img :src="vendor.profile_image_link" alt="" class="store-profile-image" />
				</div>
				<div class="col-md-6 details">
					<blockquote>
						<h5>{{ vendor.name }}</h5>
						<small
							><cite title="Source Title"> <i class="icon-map-marker"></i></cite
						></small>
					</blockquote>
					<p>
						Email :{{ vendor.email }}<br />
						Address: {{ vendor.vendor[0].street }}, {{ vendor.vendor[0].barangay }}, {{ vendor.vendor[0].city }}, {{ vendor.vendor[0].province }},
						{{ vendor.vendor[0].postal_code }}<br />
						Contact Number: {{ vendor.phone }}
					</p>
					<el-button icon="el-icon-chat-dot-round" type="warning" plain @click="createConversation()">Inquire Now!</el-button>
					<!-- <el-button icon="el-icon-chat-dot-round" type="warning" plain > -->
					<!-- <a :href="'sms: '+ vendor.phone+'?body=Hello!'" style="color: #E6A23C;" >Send Message Thru SMS!</a> -->
					<!-- <a href="sms: +639270277397" style="color: #E6A23C;" >Send Message Thru SMS!</a> -->

					<!-- </el-button> -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center mt-5">
					<h5 class="text-success">Store`s Products</h5>
				</div>
			</div>
		</div>
		<div class="container mt-3">
			<div class="row">
				<div class="col-12">
					<el-row>
						<el-col :xs="24" :sm="16" :md="18" :lg="18" :xl="20" class="p-2">
							<el-input placeholder="Type something" v-model="search">
								<i slot="prefix" class="el-input__icon el-icon-search"></i>
							</el-input>
						</el-col>
						<el-col :xs="24" :sm="8" :md="6" :lg="6" :xl="4" class="p-2">
							<el-select v-model="value" clearable placeholder="Filter" class="w-100">
								<el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value"> </el-option>
							</el-select>
						</el-col>
					</el-row>
				</div>
			</div>

			<div class="row mb-5">
				<div class="col-12">
					<el-row>
						<el-col :xs="24" :sm="12" :md="8" :lg="6" :xl="6" class="p-2" v-for="(item, index) in products" :key="index">
							<div class="product">
								<div class="product-image">
									<img :src="item.image_link" alt="" />
								</div>
								<div class="product-desc">
									<div class="product-name">
										<span>{{ item.name }}</span>
									</div>
									<div class="category">
										<span>{{ item.category }}</span>
									</div>
									<div>
										<span v-if="item.status == '1'" class="badge badge-info">Available</span>
										<span v-if="item.status == '0'" class="badge badge-danger">Out of Stock</span>
									</div>
									<div class="product-price w-100">
										<div class="d-flex justify-content-between px-1">
											<span class="price">₱{{ item.price }} / {{ item.unit }}</span>
											<button class="btn btn-sm btn-primary" type="button" @click="ShowAddToCartModal(item)" :disabled="item.status == '0'">
												<i class="fas fa-cart-plus"></i> &nbsp; Add To Cart
											</button>
										</div>
									</div>
									<div class="vendor">
										<router-link :to="`/store/${item.vendor.id}`">
											<span
												><u>{{ item.vendor.name }}</u></span
											>
										</router-link>
									</div>
								</div>
							</div>
						</el-col>
					</el-row>
				</div>
			</div>
		</div>
	</div>
</template>
<style scoped>
.cus-container {
	padding: 5%;
}
.cus-container .img {
	text-align: center;
}
.cus-container .details {
	border-left: 3px solid #ded4da;
}
.cus-container .details p {
	font-size: 15px;
	font-weight: bold;
}
</style>
<script>
export default {
	data() {
		return {
			vendor: {},
			products: [
				{
					vendor: {},
				},
			],
			search: "",
			value: null,
			options: [
				{
					value: "Fruits",
					label: "Fruits",
				},
				{
					value: "Vegetables",
					label: "Vegetables",
				},
				{
					value: "Meats",
					label: "Meats",
				},
			],
		};
	},
	mounted() {
		this.$events.fire("LoadingOverlayShow");
		this.getVendorsProfile();
	},
	methods: {
		ShowAddToCartModal(item) {
			if (item.status == "0") return;
			this.$events.fire("ShowAddToCartModal", item);
		},
		createConversation() {
			var params = {
				user_id: this.vendor.id,
			};
			axios
				.post(`/createConversation`, params)
				.then((res) => {
					window.location.href = `/customer/chat/${res.data}`;
				})
				.catch((err) => {
					console.error(err);
				});
		},
		chat() {
			var params = {
				msg: "Hello",
				user_id: this.vendor.id,
			};
			axios
				.post(`/sendMessage`, params)
				.then((res) => {
					console.log(res);
					alert("Success Send Message");
				})
				.catch((err) => {
					console.error(err);
				});
		},
		getVendorsProfile() {
			axios
				.get(`/getVendorProfile/${this.$route.params.vendor_id}`)
				.then((res) => {
					this.vendor = res.data;
					this.getProducts();
				})
				.catch((err) => {
					this.$events.fire("LoadingOverlayHide");
					console.error(err);
					//   this.getProducts();
				});
		},
		getProducts() {
			axios
				.get(`/getProducts/${this.vendor.id}`)
				.then((res) => {
					console.log(res);
					this.$events.fire("LoadingOverlayHide");
					this.products = res.data;
				})
				.catch((err) => {
					console.error(err);
					this.$events.fire("LoadingOverlayHide");
				});
		},
	},
};
</script>

<style lang="scss" scoped>
@import "resources/sass/mixins.scss";
.product:hover {
	// box-shadow: 0 0.5rem 1rem rgb(0 174 119 / 35%) !important;
	box-shadow: 4px 4px 4px 4px rgba(198, 68, 168, 0.5) !important;
}
.product {
	margin: 5px;
	padding: 0px;
	background: white;
	//   box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%) !important;
	box-shadow: 4px 4px 4px 4px rgba(0, 174, 119, 0.5) !important;

	.product-image {
		img {
			object-fit: cover;
			width: 100%;
			height: 189px;
		}
	}
	.product-desc {
		width: 100%;
		padding: 5px;
		.product-name {
			position: relative;
			font-size: 18px;
			font-weight: 800;
			height: 36px;
			line-height: 18px;
			color: #212121;
			white-space: pre-wrap;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			text-overflow: ellipsis;
			overflow: hidden;
		}
		.category {
			color: #c644a8;
			font-size: 18px;
		}
		.product-price {
			position: relative;
			font-size: 20px;
			font-weight: 1000;
			color: #2c9144;
			margin-top: 10px;
		}
		.vendor {
			text-align: center;
			color: #a8c644;
			font-size: 14px;
		}
	}
}
</style>
<style lang="css" scoped>
.filter-btn {
	padding: 0px 5px;
	font-size: 13px;
	border-radius: 1rem;
}

.store-profile-image {
	object-fit: contain;
	width: 255px;
	height: 255px;
}
</style>

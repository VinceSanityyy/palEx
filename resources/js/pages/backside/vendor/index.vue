<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Vendor Dashboard</h1>
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

						<div class="small-box bg-info">
							<div class="inner">
								<h3>{{orders}}</h3>
								<p>Total Orders</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
							<router-link class="small-box-footer" to="/vendor/orders">
								More info <i class="fas fa-arrow-circle-right"></i>
							</router-link>
						</div>
					</div>

					<div class="col-lg-3 col-6">

						<div class="small-box bg-success">
							<div class="inner">
								<h3>{{ordersDone}}</h3>
								<p>Orders Completed</p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
							<router-link class="small-box-footer" to="/vendor/orders">
								More info <i class="fas fa-arrow-circle-right"></i>
							</router-link>
						</div>
					</div>

					<div class="col-lg-3 col-6">

						<div class="small-box bg-warning">
							<div class="inner">
								<h3>{{activeProducts}}</h3>
								<p>Current Active Products</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<router-link class="small-box-footer" to="/vendor/products">
								More info <i class="fas fa-arrow-circle-right"></i>
							</router-link>
						</div>
					</div>

					<div class="col-lg-3 col-6">

						<div class="small-box bg-danger">
							<div class="inner">
								<h3>{{conversationCount}}</h3>
								<p>Csutomer Inquiries</p>
							</div>
							<div class="icon">
								<i class="ion ion-pie-graph"></i>
							</div>
							<router-link class="small-box-footer" to="/vendor/chat">
								More info <i class="fas fa-arrow-circle-right"></i>
							</router-link>
						</div>
					</div>

				</div>
			</div>
		</section>
	</div>

</template>

<script>
export default {
	name: "vendor dashboard",
	props: ['is_auth'],
	data() {
		return {
			orders: 0,
			ordersDone: 0,
			activeProducts: 0,
			conversationCount: 0
		}
	},
	methods:{
		getTotalOrders(){
			axios.get(`/vendor/api/totalOrders`).then((res=>{
				console.log(res.data)
				this.orders = res.data
			}))
		},
		getTotalOrdersDone(){
			axios.get(`/vendor/api/totalOrders/done`).then((res)=>{
				console.log(res.data)
				this.ordersDone = res.data
			})
		},
		getActiveProducts(){
			axios.get(`/vendor/api/getActiveProducts`).then((res)=>{
				console.log(res.data)
				this.activeProducts = res.data
			})
		},
		getConversationCount(){
			axios.get(`/vendor/api/getConversationCount`).then((res)=>{
				console.log(res.data)
				this.conversationCount = res.data
			})
		}
	},
	created(){
		this.getTotalOrders()
		this.getTotalOrdersDone()
		this.getActiveProducts()
		this.getConversationCount()
	}
};
</script>

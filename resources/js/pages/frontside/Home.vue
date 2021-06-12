<template>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Palex</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Products</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<!-- Main content -->
		<section class="content">
              <div class="container">
                  <div class="row">
                      <div class="col-md-12">
			<!-- Default box -->
			<div class="card card-solid">
				<div class="card-body pb-0">
					<div class="row">
						<div
							v-for="(item, index) in products"
							:key="index"
							class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column"
						>
							<div class="card bg-light d-flex flex-fill">
								<div class="card-header text-muted border-bottom-0">
									<!-- {{ item.product_name }} -->
								</div>
								<div class="card-body pt-0">
									<div class="row">
										<div class="text-center p-1 shadow rounded">
											<img
												:src="item.image_link"
												alt=""
												class="card-img-top rounded"
												style="
													object-fit: cover;
													width: 100%;
													height: 200px;
												"
											/>
										</div>
									</div>
								</div>
								<div class="card-body">
									<h3 class="card-title">
										<a href="#">{{ item.product_name }}</a>
									</h3>
									<br />
									<h5>
										₱
										{{ item.price }} /
										{{ item.unit }}
									</h5>
									<h6>
										<a href="#">{{ item.category_name }}</a>
									</h6>
									<p class="card-text">{{ item.description }}</p>
								</div>
								<div class="card-footer">
									<div class="text-right">
										<a href="#" class="btn btn-sm btn-primary">
											<i class="fas fa-cart-plus"></i> Add To Cart
										</a>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<nav aria-label="Contacts Page Navigation">
						<ul class="pagination justify-content-center m-0">
							<li class="page-item active">
								<a class="page-link" href="#">1</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">2</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">3</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">4</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">5</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">6</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">7</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">8</a>
							</li>
						</ul>
					</nav>
				</div>
				<!-- /.card-footer -->
			</div>
			<!-- /.card -->
            </div>
            </div>
            </div>
		</section>

		<!-- /.content -->
	</div>
</template>
<script>
	export default {
        props:['is_auth'],
		data() {
			return {
				products: [
					{
						id: 1,
						image_link:
							"https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
						product_name: "Apple",
						price: 50.0,
						unit: "kilo",
						category_name: "Fruite",
						product_status: "Active",
						description:
							"Lorem ipsum easd, Lorem ipsum easd Lorem ipsum easd, Lorem ipsum easd",
					},
					{
						id: 2,
						image_link:
							"https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
						product_name: "Apple",
						price: 150.0,
						unit: "kilo",
						category_name: "Fruite",
						product_status: "Active",
						description:
							"Lorem ipsum easd, Lorem ipsum easd Lorem ipsum easd, Lorem ipsum easd",
					},
					{
						id: 3,
						image_link:
							"https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
						product_name: "Apple",
						price: 250.0,
						unit: "kilo",
						category_name: "Fruite",
						product_status: "Active",
						description: "Lorem ipsum easd,  Lorem ipsum easd",
					},
					{
						id: 3,
						image_link:
							"https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
						product_name: "Apple",
						price: 250.0,
						unit: "kilo",
						category_name: "Fruite",
						product_status: "Sold Out",
						description:
							"Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
					},
					{
						id: 3,
						image_link:
							"https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
						product_name: "Apple",
						price: 250.0,
						unit: "kilo",
						category_name: "Fruite",
						product_status: "Sold Out",
						description:
							"Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
					},
					{
						id: 3,
						image_link:
							"https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
						product_name: "Apple",
						price: 250.0,
						unit: "kilo",
						category_name: "Fruite",
						product_status: "Sold Out",
						description:
							"Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
					},
					{
						id: 3,
						image_link:
							"https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
						product_name: "Apple",
						price: 250.0,
						unit: "kilo",
						category_name: "Fruite",
						product_status: "Sold Out",
						description:
							"Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
					},
					{
						id: 3,
						image_link:
							"https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
						product_name: "Apple",
						price: 250.0,
						unit: "kilo",
						category_name: "Fruite",
						product_status: "Sold Out",
						description:
							"Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
					},
				],
				image_link:
					"https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
			};
		},
	};
</script>

<style lang="css" scoped>
	.filter-btn {
		padding: 0px 5px;
		font-size: 13px;
		border-radius: 1rem;
	}
</style>

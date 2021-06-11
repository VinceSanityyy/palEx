<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Vendor Products</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Products</li>
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
								<h3 class="card-title" >Products List</h3>
								<button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" style="float:right">Add New Product</button>
							</div>
							<div class="card-body table-responsive">
								<table
									id="mytableProducts"
									class="table table-bordered table-striped dt-responsive display nowrap"
								>
									<thead>
										<tr>
											<th>Id</th>
											<th>Avatar</th>
											<th>Name</th>
											<th>Price</th>
											<th>Unit</th>
											<th>Category</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr
											v-for="(item, index) in products"
											:key="index"
										>
											<td>{{ item.id }}</td>
											<td>
												<img
													:src="item.image_link"
													alt=""
													style="
														width: 50px;
														height: 50px;
														object-fit: cover;
													"
												/>
											</td>
											<td>{{ item.product_name }}</td>
											<td>{{ item.price }}</td>
											<td>{{ item.unit }}</td>
											<td>{{ item.category_name }}</td>
											<td>{{ item.product_status }}</td>
											<td>
												<router-link
													class="btn btn-warning btn-sm"
													:to="'/admin/products/edit/' + item.id"
													>Edit</router-link
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="form-group">
			<label >Product Name</label>
			<input v-model="product_name" type="text" class="form-control">
			<label >Price</label>
			<input v-model="price" type="text" class="form-control">
			<label >Unit</label>
			<input v-model="unit" type="text" class="form-control">
			<label >Category</label>
			    <select v-model="category" class="form-control" id="exampleFormControlSelect2">
				<option value="1">Wet</option>
				<option value="2">Dry</option>
				<option value="3">Others</option>

				</select>
			<label for="exampleFormControlFile1">Image</label>
    		<input type="file" class="form-control-file" id="exampleFormControlFile1">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
	</div>
</template>

<script>
	export default {
		data() {
			return {
				products: [
					{
						id: 1,
						image_link:
							"https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
						product_name: "Apple",
						price: 50,
						unit: "kilo",
						category_name: "Fruite",
						product_status: "Active",
					},
				],
				product_name:'',
				price:'',
				unit:'',
				category:''
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
					$("#mytableProducts").DataTable({
						responsive: true,
					});
				});
			},
		},
	};
</script>

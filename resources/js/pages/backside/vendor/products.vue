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
								<button @click="addModal" class="btn btn-primary" style="float:right">Add New Product</button>
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
											<td>{{ item.name }}</td>
											<td>{{ item.price }}</td>
											<td>{{ item.unit }}</td>
											<td>{{ item.category }}</td>
											<td>
												<span class="badge bg-success" v-if="item.status == 1">Available</span>
												<span class="badge bg-danger" v-else>Out of Stock</span>
											</td>
											<td>
												<button @click="editModal(item)" class="btn btn-warning">Edit</button>
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
	   <form @submit.prevent ="editMode ? updateProduct() : addProduct()">
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
				<option value="Wet">Wet</option>
				<option value="Dry">Dry</option>
				<option value="Others">Others</option>

				</select>
			<label for="exampleFormControlFile1">Image</label>
    		<input @change="onFileChange" type="file" class="form-control-file" id="exampleFormControlFile1">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	</form>
    </div>
  </div>
</div>
<!-- Modal -->
	</div>
</template>

<script>
	export default {
        props:['is_auth'],
		data() {
			return {
				products: [],
				product_name:'',
				price:'',
				unit:'',
				category:'',
				photo: '',
				editMode: false,
				product_id:''
			};
		},
        // mounted() {
        //     setTimeout(() => {
        //         this.myTable();
        //     }, 1000);
        // },
		methods: {
			myTable() {
				$(document).ready(function () {
					$("#mytableProducts").DataTable({
						responsive: true,
					});
				});
			},
			addProduct(){
				var formData = new FormData()
				formData.append('name', this.product_name)
                formData.append('price', this.price)
                formData.append('unit', this.unit)
                formData.append('category', this.category)
                formData.append('photo', this.photo)
				axios.post('/palex_api/vendor/createProduct',formData).then((res)=>{
					console.log(res)
					$('#exampleModal').modal('hide')
					toastr.success('Done')
					this.clearFields()
					this.getProducts()
				})
			},
			onFileChange(e) {
				let file = e.target.files[0];
				this.photo = file
			},
			clearFields(){
				this.product_name = ''
				this.price = ''
				this.unit = ''
				this.category = ''
				this.photo = ''
			},
			getProducts(){
				axios.get('/palex_api/vendor/getProducts').then((res)=>{
					console.log(res.data)
					this.products = res.data
					this.myTable()
				})
			},
			updateProduct(){
				var formData = new FormData()
				formData.append('name', this.product_name)
                formData.append('price', this.price)
                formData.append('unit', this.unit)
                formData.append('category', this.category)
                formData.append('photo', this.photo)
				axios.post(`/vendor/updateProruct/${this.product_id}`,formData).then((res)=>{
					console.log(res.data)
					$('#exampleModal').modal('hide')
					toastr.success('Done')
				}).catch((err)=>{
                     var errors = err.response.data.errors

                       for (var key of Object.keys(errors)) {
                            toastr.error(errors[key])
                        }
				})
			},
			addModal(){
				this.editMode = false
                this.clearFields()
                $('#exampleModal').modal('show')
			},
			editModal(product){
				console.log(product)
                this.editMode = true
                this.product_id = product.id
                this.product_name = product.name
                this.category = product.category
                this.price = product.price
                this.photo = product.photo
				this.unit = product.unit
                // this.supplier = product.supplier_id
                $('#exampleModal').modal('show')
            },
		},
		created(){
			this.getProducts()
		}
	};
</script>

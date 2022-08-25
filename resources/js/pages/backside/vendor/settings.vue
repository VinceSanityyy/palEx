<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Settings</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Settings</li>
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
								<h3 class="card-title">Profile Information</h3>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label for="name">Store Name</label>
									<input v-model="store_name" type="text" class="form-control" id="name" />
								</div>
								<div class="form-group">
									<label for="name">Email</label>
									<input v-model="email" type="email" class="form-control" id="name" />
								</div>
								<div class="form-group">
									<label for="name">Phone</label>
									<input v-model="phone" type="text" class="form-control" id="phone" />
								</div>
								<div class="form-group">
									<label for="name">Street</label>
									<input v-model="street" type="text" class="form-control" id="name" />
								</div>
								<div class="form-group">
									<label for="name">Barangay</label>
									<input v-model="barangay" type="text" class="form-control" id="name" />
								</div>
								<div class="form-group">
									<label for="name">City</label>
									<input v-model="city" type="text" class="form-control" id="name" />
								</div>
								<div class="form-group">
									<label for="name">Province</label>
									<input v-model="province" type="text" class="form-control" id="name" />
								</div>
								<div class="form-group">
									<label for="name">Post Code</label>
									<input v-model="postal_code" type="text" class="form-control" id="name" />
								</div>
								<div class="form-group">
									<label for="name">Display Image</label>
									<input accept="image/jpeg" @change="uploadPicture" type="file" class="form-control" id="name" />
								</div>
								<div class="form-group">
									<button onclick="history.back()" class="btn btn-danger">Back</button>
									<button @click="updateVendor()" class="btn btn-primary">Save Changes</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>

<script>
import axios from "axios";

export default {
	data() {
		return {
			// authVendor: [],
			email:'',
			store_name:'',
			phone: '',
			street: '',
			barangay: '',
			city: '',
			province: '',
			postal_code: '',
			authUser: {},
			image: "",
		};
	},
	created() {
		this.getCurrentAuth();
		// this.getCurrentVendorDetails();
	},
	methods: {
		updateVendor() {
			const formData = new FormData();
			formData.append("store_name", this.store_name);
			formData.append("phone", this.phone);
			formData.append("email", this.email);
			formData.append("street", this.street);
			formData.append("barangay", this.barangay);
			formData.append("city", this.city);
			formData.append("province", this.province);
			formData.append("postal_code", this.postal_code);
			formData.append("image", this.image);
			axios
				.post(`/vendor/update/${this.authUser.id}`, formData)
				.then((res) => {
					toastr.success("Successfully updated");
				})
				.catch((err) => {
					toastr.error("Chceck your inputs");
				});
		},

		uploadPicture(e) {
			console.log("clicked!");
			this.image = e.target.files[0];
		},
		getCurrentAuth() {
			axios.get("/me").then((res) => {
				this.authUser = res.data;
			});
		},
		getCurrentVendorDetails(id) {
			axios.get(`/me/vendor`).then((res) => {
				console.log(res.data);
				this.authVendor = res.data;
			});
		},
	},
};
</script>

<style>
</style>
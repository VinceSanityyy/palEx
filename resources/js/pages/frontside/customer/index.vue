<style lang="scss" scoped>
.palex-customer-picture {
	border: 3px solid #adb5bd;
	margin: 0 auto;
	padding: 3px;
	width: 100px;
	height: 100px;
	// object-fit: contain;
	object-fit: cover;
	border-radius: 50%;
}

label {
	color: #2c9144 !important;
	font-weight: 600;
	font-size: 16px;
}
</style>


<template>
	<section class="content mt-5 mb-5">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-md-10 col-lg-8">
					<!-- Profile Image -->
					<div class="card card-primary card-outline palex-card">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="palex-customer-picture" :src="profile_image_src" alt="User profile picture" />
							</div>

							<h3 class="profile-username text-center">{{ user.name }}</h3>

							<p class="text-muted text-center"></p>

							<!-- <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item"><b>Followers</b> <a class="float-right">1,322</a></li>
                <li class="list-group-item"><b>Following</b> <a class="float-right">543</a></li>
                <li class="list-group-item"><b>Friends</b> <a class="float-right">13,287</a></li>
              </ul>
                -->

							<el-button v-if="!imageFile" type="primary" @click="UploadBtnClick()" class="w-100" plain>
								<i class="fas fa-cloud-upload-alt"></i> Update Profile Picture</el-button
							>
							<div v-if="imageFile" class="d-flex">
								<el-button @click="cancel_image_upload()" type="info" class="w-50" plain><i class="far fa-ban"></i> Cancel</el-button>
								<el-button @click="save_image_upload()" type="success" class="w-50" plain> <i class="fas fa-save"></i> Save</el-button>
							</div>

							<input
								ref="ImageFileHiddenInput"
								accept="image/x-png,image/gif,image/jpeg,image/png"
								@change="onFileChange"
								type="file"
								name="image_file"
								style="display: none"
							/>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
				<div class="col-md-10 col-lg-8">
					<div class="card palex-card">
						<div class="card-body">
							<div class="tab-content">
								<div class="active tab-pane" id="settings">
									<form class="form-horizontal">
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
											<div class="col-sm-10">
												<input type="email" v-model="user.email" readonly class="form-control" id="inputEmail" placeholder="Email" />
											</div>
										</div>
										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Full Name</label>
											<div class="col-sm-10">
												<input type="text" v-model="user_full_name" class="form-control" id="inputName2" placeholder="Enter yout Full Name" />
											</div>
										</div>
										<div class="form-group row">
											<label for="inputSkills" class="col-sm-2 col-form-label">Phone #</label>
											<div class="col-sm-10">
												<input type="text" v-model="user_phone" class="form-control" id="inputSkills" placeholder="Enter your phone number" />
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="button" @click="Update_fullname_and_phone()" class="btn btn-danger">Update</button>
												<!-- <button type="button" @click="test()" class="btn btn-danger">test</button> -->
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>

				<div class="col-md-10 col-lg-8">
					<div class="card palex-card">
						<div class="card-header w-100 text-center">
							<h3 class="card-title">Password Setting</h3>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="active tab-pane" id="settings">
									<form class="form-horizontal">
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">Current Password</label>
											<div class="col-sm-10">
												<input v-model="current_password" type="password" class="form-control" />
											</div>
										</div>
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
											<div class="col-sm-10">
												<input v-model="new_password" type="password" class="form-control" />
											</div>
										</div>
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">Confirm New Password</label>
											<div class="col-sm-10">
												<input v-model="confirm_new_password" type="password" class="form-control" />
											</div>
										</div>

										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="button" class="btn btn-danger" @click="customer_change_password()">Change Password</button>
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>

				<div class="col-md-10 col-lg-8">
					<div class="card palex-card">
						<div class="card-header w-100 text-center">
							<h3 class="card-title w-100">
								<div class="d-flex justify-content-between align-items-center">
									<span>Addresses</span>
									<span v-if="customer_addresses.length > 0">
										<el-button @click="AddMoreAddresses()" type="primary">Add More Address</el-button>
									</span>
								</div>
							</h3>
						</div>
						<div class="card-body" id="address_card">
							<div v-if="customer_addresses.length < 1" class="text-center d-flex justify-content-center align-items-center" style="min-height: 400px">
								<div>
									<div><b>You don`t have set Address yet for the delivery destination.</b></div>
									<el-button @click="AddMoreAddresses()" type="primary" plain>Add Address here</el-button>
								</div>
							</div>

							<div v-for="(item, index) in customer_addresses" :key="index">
								<div class="row">
									<div class="col-md-9">
										<div class="receiver_name">
											<b style="color: #2c9144 !important">
												{{ item.full_name }}
											</b>
											<span>|| <span v-if="item.selected == 1" class="badge badge-success">Selected</span></span>
										</div>
										<div class="receiver_phone">
											{{ item.phone }}
										</div>
										<div class="street">
											{{ item.street }}
										</div>
										<div class="barangay-city-province-postat-code">{{ item.barangay }}, {{ item.city }}, {{ item.province }}, {{ item.postal_code }},</div>
									</div>
									<div class="col-md-3">
										<div class="d-flex flex-sm-row flex-md-column justify-content-center">
											<span class="mx-auto">
												<el-button @click="EditAddress(item)" type="primary" size="mini" plain class="mb-1 mr-1" style="width: 70px">edit</el-button>
											</span>
											<span class="mx-auto" v-if="item.selected != 1">
												<el-button @click="delete_customer_address(item.id)" type="danger" size="mini" plain class="mb-1 mr-1" style="width: 70px">
													delete
												</el-button>
											</span>
											<span class="mx-auto" v-if="item.selected != 1">
												<el-button
													:loading="loadingSelectedBtn"
													type="success"
													size="mini"
													plain
													class="mb-1"
													style="width: 100px"
													@click="setSelectedAddress(item)"
													>Set Selected</el-button
												>
											</span>
										</div>
									</div>
								</div>

								<hr />
							</div>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->

		<AddOrUpdateCustomerAddresses></AddOrUpdateCustomerAddresses>
	</section>
</template>
<script>
export default {
	props: ["is_auth"],
	data() {
		return {
			user: {},
			profile_image_src: "",
			imageFile: null,
			user_full_name: "",
			user_phone: "",
			current_password: null,
			new_password: null,
			confirm_new_password: null,
			customer_addresses: [],
			loadingSelectedBtn: false,
		};
	},
	mounted() {
		this.getCurrentAuth();
		this.clear_img_upload();
		this.getCustomerAddress();
	},
	methods: {
		AddMoreAddresses() {
			this.$events.fire("ShowAddOrUpdateCustomerAddresses", { option: "add" });
		},
		EditAddress(item) {
			this.$events.fire("ShowAddOrUpdateCustomerAddresses", { option: "edit", form: item });
		},
		setSelectedAddress(item) {
			console.log(item);
			this.$events.fire("LoadingOverlayShow");
			this.loadingSelectedBtn = true;
			axios
				.post(`/set_selected_address/${item.id}`)
				.then((res) => {
					// console.log(res.data);
					this.getCustomerAddress();
					this.$events.fire("LoadingOverlayHide");
					this.loadingSelectedBtn = false;
				})
				.catch((err) => {
					this.$events.fire("LoadingOverlayHide");
					this.loadingSelectedBtn = false;
					var errors = err.response.data.errors;
					for (var key of Object.keys(errors)) {
						toastr.error(errors[key]);
					}
				});
		},
		getCustomerAddress() {
			axios
				.get("/get_customer_addresses")
				.then((res) => {
					this.customer_addresses = res.data;
				})
				.catch((err) => {
					var errors = err.response.data.errors;
					for (var key of Object.keys(errors)) {
						toastr.error(errors[key]);
					}
				});
		},

		delete_customer_address(id) {
			this.$confirm("Are you sure you want to delete this address?", "Warning", {
				confirmButtonText: "YES",
				cancelButtonText: "NO",
				type: "danger",
			})
				.then(() => {
					this.$events.fire("LoadingOverlayShow");

					axios
						.post("/delete_customer_address", {
							address_id: id,
						})
						.then((res) => {
							this.$events.fire("LoadingOverlayHide");
							this.$message({
								message: "Address Succussfully Deleted",
								type: "warning",
							});
							this.getCustomerAddress();
						})
						.catch((err) => {
							this.$events.fire("LoadingOverlayHide");
							if (err.response) {
								if (err.response.status == "422") {
									var errors = err.response.data.errors;
									for (var key of Object.keys(errors)) {
										toastr.error(errors[key]);
									}
								}
							}
						});
				})
				.catch(() => {});
		},
		// test(){
		// 	this.$router.push(`/vendor/products`);
		// },
		UploadBtnClick() {
			this.$refs.ImageFileHiddenInput.value = "";
			this.$refs.ImageFileHiddenInput.value = null;
			this.$refs.ImageFileHiddenInput.click();
		},

		Update_fullname_and_phone() {
			this.$events.fire("LoadingOverlayShow");
			axios
				.post("/change_fullname_and_phone", {
					fullname: this.user_full_name,
					phone: this.user_phone,
				})
				.then((res) => {
					console.log(res);
					this.$events.fire("LoadingOverlayHide");
					this.$message({
						message: "Success Update Basic Info",
						type: "success",
					});
				})
				.catch((err) => {
					this.$events.fire("LoadingOverlayHide");
					var errors = err.response.data.errors;
					for (var key of Object.keys(errors)) {
						toastr.error(errors[key]);
					}
				});
		},

		customer_change_password() {
			this.$events.fire("LoadingOverlayShow");
			axios
				.post("/customer_change_password", {
					current_password: this.current_password,
					new_password: this.new_password,
					confirm_new_password: this.confirm_new_password,
				})
				.then((res) => {
					this.$events.fire("LoadingOverlayHide");
					console.log(res);
					this.$message({
						message: "Password Successfully Changed",
						type: "success",
					});
				})
				.catch((err) => {
					this.$events.fire("LoadingOverlayHide");
					if (err.response) {
						if (err.response.status == "422") {
							var errors = err.response.data.errors;
							for (var key of Object.keys(errors)) {
								toastr.error(errors[key]);
							}
						}
						if (err.response.data.status == "fail") {
							this.$message({
								message: err.response.data.message,
								type: "error",
							});
						}
					}
				});
		},

		onFileChange(e) {
			console.log(e);
			const file = e.target.files[0];
			this.imageFile = file;

			if (file) {
				this.profile_image_src = URL.createObjectURL(file);
			}
		},

		clear_img_upload() {
			this.imageFile = null;
			this.$refs.ImageFileHiddenInput.value = "";
			this.$refs.ImageFileHiddenInput.value = null;
		},

		cancel_image_upload() {
			this.clear_img_upload();
			this.profile_image_src = this.user.profile_image_link;
		},

		async save_image_upload() {
			// this.clear_img_upload();
			this.$events.fire("LoadingOverlayShow");
			var formData = new FormData();
			formData.append("photo", this.imageFile);
			axios
				.post(`/changeCustomerPicture`, formData)
				.then((res) => {
					this.$events.fire("LoadingOverlayHide");
					console.log(res.data);
					this.clear_img_upload();
				})
				.catch((err) => {
					this.$events.fire("LoadingOverlayHide");
					var errors = err.response.data.errors;
					for (var key of Object.keys(errors)) {
						toastr.error(errors[key]);
					}
				});
		},

		getCurrentAuth() {
			axios.get("/me").then((res) => {
				this.user = res.data;
				this.user_full_name = this.user.name;
				this.user_phone = this.user.phone;
				this.profile_image_src = this.user.profile_image_link;
			});
		},
	},
};
</script>
<style lang="scss" scoped>
@import "resources/sass/mixins.scss";
// .palex-card {
//   background: white !important;
//   box-shadow: 4px 4px 4px 4px rgba(0, 174, 119, 0.5) !important;
// //   margin: 0.5rem;
// //   padding: 1rem;
// }
</style>

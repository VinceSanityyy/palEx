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
												<input type="text" v-model="user.name" class="form-control" id="inputName2" placeholder="Enter yout Full Name" />
											</div>
										</div>
										<div class="form-group row">
											<label for="inputSkills" class="col-sm-2 col-form-label">Phone #</label>
											<div class="col-sm-10">
												<input type="text" v-model="user.phone" class="form-control" id="inputSkills" placeholder="Enter your phone number" />
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" class="btn btn-danger">Update</button>
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
												<input type="password" class="form-control" />
											</div>
										</div>
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" />
											</div>
										</div>
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" />
											</div>
										</div>

										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" class="btn btn-danger">Change Password</button>
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
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
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
		};
	},
	mounted() {
		this.getCurrentAuth();
		this.clear_img_upload();
	},
	methods: {
		UploadBtnClick() {
			this.$refs.ImageFileHiddenInput.value = "";
			this.$refs.ImageFileHiddenInput.value = null;
			this.$refs.ImageFileHiddenInput.click();
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

			var formData = new FormData();
			formData.append("photo", this.imageFile);
			axios
				.post(`/changeCustomerPicture`, formData)
				.then((res) => {
					console.log(res.data);
					this.clear_img_upload();
				})
				.catch((err) => {
					var errors = err.response.data.errors;
					for (var key of Object.keys(errors)) {
						toastr.error(errors[key]);
					}
				});
		},

		getCurrentAuth() {
			axios.get("/me").then((res) => {
				this.user = res.data;
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

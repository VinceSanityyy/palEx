<template>
	<div class="modal" id="AddOrUpdateCustomerAddresses" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title">
						<span v-if="option == 'add'">Add Address</span>
						<span v-if="option == 'edit'">Edit Address</span>
					</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body costume-modal-body">
					<div class="palex-card-for-modal">
						<div class="mb-2">
							<div style="font-size: 16px; font-weight: bold">Receiver Info:</div>
							<div class="form-group">
								<label>Fullname</label>
								<div>
									<input v-model="form.full_name" type="text" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label>Phone #</label>
								<div>
									<input v-model="form.phone" type="text" class="form-control" />
								</div>
							</div>

							<div style="font-size: 16px; font-weight: bold">Receiver Address:</div>
							<div class="form-group">
								<label>Street</label>
								<div>
									<input v-model="form.street" type="text" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label>Barangay</label>
								<div>
									<input v-model="form.barangay" type="text" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label>City</label>
								<div>
									<input v-model="form.city" type="text" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label>Province</label>
								<div>
									<input v-model="form.province" type="text" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label>Postal Code</label>
								<div>
									<input v-model="form.postal_code" type="text" class="form-control" />
								</div>
							</div>

							<div class="w-100 text-center">
								<span v-if="option == 'add'">
									<el-button :loading="loading" type="success" @click="addAddress"> <i class="fas fa-save mr-2"></i> Add Address</el-button>
								</span>
								<span v-if="option == 'edit'">
									<el-button :loading="loading" type="primary" @click="updateAddress"> <i class="fas fa-save mr-2"></i> Update</el-button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="modal-footer"></div> -->
			</div>
		</div>
	</div>
</template>
<script>
import MyErrorClass from "../ErrorClass";
export default {
	data() {
		return {
			option: "add",
			loading: false,
			form: {
				id: null,
				full_name: "",
				phone: "",
				street: "",
				barangay: "",
				city: "",
				province: "",
				postal_code: "",
			},
		};
	},
	methods: {
		addAddress() {
			this.$events.fire("LoadingOverlayShow");
			this.loading = true;
			var data = this.form;
			axios
				.post("/add_customer_address", data)
				.then((res) => {
					this.loading = false;
					this.$events.fire("LoadingOverlayHide");
					console.log(res);
					this.$message({
						message: "New Address Succussfully Added",
						type: "success",
					});
					$("#AddOrUpdateCustomerAddresses").modal("hide");
					this.$parent.getCustomerAddress();
				})
				.catch((err) => {
					this.loading = false;
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
		},
		updateAddress() {
			this.$events.fire("LoadingOverlayShow");
			this.loading = true;
			var data = this.form;
			axios
				.post("/update_customer_address", data)
				.then((res) => {
					this.loading = false;
					this.$events.fire("LoadingOverlayHide");
					console.log(res);
					this.$message({
						message: "Address Succussfully Updated",
						type: "success",
					});
					$("#AddOrUpdateCustomerAddresses").modal("hide");
					this.$parent.getCustomerAddress();
				})
				.catch((err) => {
					this.loading = false;
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
		},
	},
	events: {
		ShowAddOrUpdateCustomerAddresses(data) {
			this.option = data.option;
			if (this.option == "edit") {
				// console.log(data);
				var form = data.form;
				this.form = Object.assign({}, form);
			} else {
				this.form = {
					id: null,
					full_name: "",
					phone: "",
					street: "",
					barangay: "",
					city: "",
					province: "",
					postal_code: "",
				};
			}
			$("#AddOrUpdateCustomerAddresses").modal("show");
		},
	},
};
</script>

<style lang="scss" scoped>
@import "resources/sass/mixins.scss";
// .product:hover {
//   // box-shadow: 0 0.5rem 1rem rgb(0 174 119 / 35%) !important;
//   box-shadow: 4px 4px 4px 4px rgba(0, 174, 119, 0.5) !important;
// }
.palex-card-for-modal {
	margin: 5px;
	padding: 0.5rem;
	@media (min-width: 280px) and (max-width: 375px) {
		padding: 0.25rem;
	}
	background: white;
	//   box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%) !important;
	box-shadow: 4px 4px 4px 4px rgba(0, 174, 119, 0.5) !important;
	label {
		color: #2c9144;
		font-weight: 600;
		font-size: 14px;
	}
}

@media (min-width: 280px) and (max-width: 425px) {
	.costume-modal-body {
		padding: 5px;
	}
}
</style>

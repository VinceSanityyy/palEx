<template>
<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">User Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Usermanagement</li>
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
                                <h3 class="card-title">
                                    Users List
                                </h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table id="mytable" class="table table-bordered table-striped dt-responsive display nowrap" >
                                    <thead>
                                        <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Registered As</th>
                                                <th>Proof</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in users" :key="user.id">
                                            <td>{{user.name}}</td>
                                            <td>{{user.email}}</td>
                                            <td>{{user.phone}}</td>
                                            <td>
                                                <span class="badge bg-info" v-if="user.role == 1">Vendor</span>
                                                <span class="badge bg-secondary" v-else>Customer</span>
                                            </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#exampleModal" @click="viewPhoto(user.image_link)" class="btn btn-primary">View Photo</button>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning" v-if="user.status == 0">Pending</span>
                                                <span class="badge bg-success" v-else>Approved</span>
                                            </td>
                                            <td>
                                                <button v-if="user.status == 0 " @click="viewDetails(user.id)" class="btn btn-primary">Accept Account</button>
                                                <button v-else disabled class="btn btn-warning">Accepted</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Photo Submitted</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img :src='imageModal' class="img-fluid" alt="Responsive image" style="display: block; margin-left: auto; margin-right: auto; width: 50%;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>
			</div>
		</section>
	</div>
</template>

<script>
export default{
      props:['is_auth'],
    data(){
        return{
            users:[],
            imageModal:''
        }
    },
    methods:{
        myTable(){
            $(document).ready(function(){
                $('#mytable').DataTable({
                    responsive: true
                })
            })
        },
        getUsers(){
            axios.get('/getUsers').then((res)=>{
                this.users = res.data
                this.myTable()
            })
        },
        viewDetails(id){
            console.log(id)
            this.$alertify.confirm('Confirm User?',()=>{
                axios.post('/approveUser',{
                    id: id
                }).then((res)=>{
                this.getUsers()
                toastr.success('User Accepted!')
                })
            })
        },
        viewPhoto(link){
            console.log(link)
            this.imageModal = link
        }
    },
    created(){
        this.getUsers()
    }
}
</script>

<style>

</style>

<template>
<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Feeds</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Feeds</li>
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
                                                Feeds
                                            </h3>
                                            <button  data-toggle="modal" data-target="#exampleModal" style="float:right" type="button" class="btn btn-primary">Add feed</button>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table id="mytable" class="table table-bordered table-striped dt-responsive display nowrap" >
                                                <thead>
                                                    <tr>
                                                            <th>Title</th>
                                                            <th>Body</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="feed in feeds" :key="feed.id">
                                                        <td>{{feed.title}}</td>
                                                        <td>{{feed.body}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input v-model="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Body</label>
                                        <textarea v-model="body" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button @click="addFeed()" type="button" class="btn btn-primary">Save changes</button>
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
    data(){
        return{
            feeds:[],
            title:'',
            body:'',

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
        getFeeds(){
            axios.get('/getFeeds').then((res)=>{
                this.feeds = res.data
                this.myTable()
            })
        },
        addFeed(){
            axios.post('/addFeed',{
                title: this.title,
                body: this.body
            }).then((res)=>{
                toastr.success('Added!')
                this.getFeeds()
                this.myTable()
                this.title = ''
                this.body = ''
            })
        }
    },
    created(){
        this.getFeeds()
    }
}
</script>

<style>

</style>

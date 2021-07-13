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
							<li class="breadcrumb-item active">Feeds</li>
						</ol>
					</div>
				</div>
			</div>
		</section>
    <section class="content">
      <div class="container">
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <!-- END timeline item -->
              <!-- timeline item -->
              <div v-for="feed in feeds" :key="feed.id">
                <i class="fas fa-user bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> {{feed.created_at | moment('dddd, MMMM Do YYYY')}}</span>
                  <h3 class="timeline-header"><a href="#">PalEx Admin created a post</a> <br><br><b>{{feed.title}}</b></h3>
                  <div class="timeline-body">
                    {{feed.body}}
                  </div>
                  <!-- <div class="timeline-footer">
                    <a class="btn btn-warning btn-sm">View comment</a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    </div>
</template>
<script>
export default {
    props:['is_auth'],
    data(){
      return{
        feeds:[]
      }
    },
    methods:{
      getFeeds(){
          axios.get('/getFeeds').then((res)=>{
            console.log(res)
            this.feeds = res.data
          })
        }
    },
    created(){
      this.getFeeds()
    }
}
</script>

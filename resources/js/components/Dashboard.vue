<template>
  <div class="content">
      <div class="content-header">
          <div class="container-fluid">

          </div>
      </div>
      <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{vendorsCount}}</h3>

                <p>Total Vendors</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{customersCount}}</h3>

                <p>Total Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{acceptedVendors}}</h3>

                <p>Vendors Accepted</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
  </div>
</template>

<script>
export default {
 data(){
     return{
         vendorsCount: 0,
         customersCount: 0,
         acceptedVendors:0
     }
 },
 methods:{
     getVendorsCount(){
         axios.get('/countVendors').then((res)=>{
             this.vendorsCount = res.data
         })
     },
     getCustomersCount(){
         axios.get('/countCustomers').then((res)=>{
             this.customersCount = res.data
         })
     },
    getAcceptedVendorsCount(){
        axios.get('/countAcceptedVendors').then((res)=>{
             this.acceptedVendors = res.data
         })
     }
 },
 created(){
     this.getVendorsCount()
     this.getCustomersCount()
     this.getAcceptedVendorsCount()
 }
}
</script>

<style>

</style>
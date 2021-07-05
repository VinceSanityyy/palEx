<template>
  <div>
    <h3>Store Profile</h3>
    <h1>{{ vendor.name }}</h1>
    <div>{{ vendor.email }}</div>
    <div>{{ vendor.phone }}</div>

    <el-button type="warning" plain @click="chat()">Chat/Inquere The Store</el-button>

    <div>
      <h4>Store Products</h4>
      <ul>
        <li>product 1</li>
        <li>product 2</li>
        <li>product 3</li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
    data() {
        return {
            vendor:{}
        }
    },
    mounted() {
        this.getVendorsProfile();
    },
    methods: {
        chat(){
            var params = {
                msg:"Hello",
                user_id:this.vendor.id
            }
           axios.post(`/sendMessage`,params)
           .then(res => {
               console.log(res)
               alert("Success Send Message");
           })
           .catch(err => {
               console.error(err);
           })
        },
        getVendorsProfile(){
            axios.get(`/getVendorProfile/${this.$route.params.vendor_id}`,)
            .then(res => {
                this.vendor = res.data;
            })
            .catch(err => {
                console.error(err);
            })
        }
    },
}
</script>

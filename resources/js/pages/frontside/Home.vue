<style scoped>
    .prod-text {
        position: absolute;
        bottom: 0%;
        left: 0%;
        background: rgba(0, 0, 0, 0.6);
        width: 100%;
        height: 30%;
        font-size: 15px;
        color: white;
        padding-left: 0px;
        text-align: center;
      }

</style>
<template>
  <el-container>
    <el-main class="m-3">
      <el-carousel :interval="10000" type="card" height="300px">
        <el-carousel-item v-for="(item,index) in products" :key="index">
        <div>
         <img :src="item.image_link" alt="">
         <div class="prod-text">
            <h4>{{item.product_name}}</h4>
            <h1>₱{{item.price}}</h1>
         </div>
        </div>
        </el-carousel-item>
      </el-carousel>
      <el-row>
        <el-col :span="24">
        <div>
        </div>
        </el-col>
    </el-row>
    </el-main>
  </el-container>
</template>
<script>
export default {
  props: ["is_auth"],
  data() {
    return {
      products: [
        {
          id: 1,
          image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
          product_name: "Apple",
          price: 50.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Active",
          description: "Lorem ipsum easd, Lorem ipsum easd Lorem ipsum easd, Lorem ipsum easd",
        },
        {
          id: 2,
          image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
          product_name: "Apple",
          price: 150.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Active",
          description: "Lorem ipsum easd, Lorem ipsum easd Lorem ipsum easd, Lorem ipsum easd",
        },
        {
          id: 3,
          image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
          product_name: "Apple",
          price: 250.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Active",
          description: "Lorem ipsum easd,  Lorem ipsum easd",
        },
        {
          id: 3,
          image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
          product_name: "Apple",
          price: 250.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Sold Out",
          description: "Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
        },
        {
          id: 3,
          image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
          product_name: "Apple",
          price: 250.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Sold Out",
          description: "Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
        },
        {
          id: 3,
          image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
          product_name: "Apple",
          price: 250.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Sold Out",
          description: "Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
        },
        {
          id: 3,
          image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
          product_name: "Apple",
          price: 250.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Sold Out",
          description: "Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
        },
        {
          id: 3,
          image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
          product_name: "Apple",
          price: 250.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Sold Out",
          description: "Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
        },
      ],
      image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
    };
  },
};
</script>

<style lang="css" scoped>
.filter-btn {
  padding: 0px 5px;
  font-size: 13px;
  border-radius: 1rem;
}
</style>

<style>
.el-carousel__item h3 {
  color: #475669;
  font-size: 14px;
  opacity: 0.75;
  line-height: 200px;
  margin: 0;
}

.el-carousel__item:nth-child(2n) {
  background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n + 1) {
  background-color: #d3dce6;
}
</style>

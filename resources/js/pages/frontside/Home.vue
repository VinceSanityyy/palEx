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
<style lang="scss" scoped>
.product:hover {
  // box-shadow: 0 0.5rem 1rem rgb(0 174 119 / 35%) !important;
  box-shadow: 4px 4px 4px 4px rgba(0, 174, 119, 0.5) !important;
}
.product {
  margin: 5px;
  padding: 0px;
  background: white;
  box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%) !important;
  .product-image {
    img {
      object-fit: cover;
      width: 100%;
      height: 189px;
    }
  }
  .product-desc {
    width: 100%;
    padding: 5px;
    .product-name {
      position: relative;
      font-size: 14px;
      height: 36px;
      line-height: 18px;
      color: #212121;
      white-space: pre-wrap;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      text-overflow: ellipsis;
      overflow: hidden;
    }
    .product-price {
      position: relative;
      font-size: 16px;
      font-weight: 1000;
      color: #2c9144;
      margin-top:10px;
    }
  }
}
</style>
<template>
  <div class="container mt-3">
    <div class="row">
      <div class="col-12">
        <el-carousel :interval="10000" type="card" height="300px">
          <el-carousel-item v-for="(item, index) in products" :key="index">
            <div>
              <img :src="item.image_link" alt="" />
              <div class="prod-text">
                <h4>{{ item.product_name }}</h4>
                <h1>₱{{ item.price }}</h1>
              </div>
            </div>
          </el-carousel-item>
        </el-carousel>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-4" v-for="(item, index) in products2" :key="index">
              <div class="product">
                <div class="product-image">
                  <img :src="item.image_link" alt="" />
                </div>
                <div class="product-desc">
                  <div class="product-name">
                    <span class="title">{{ item.product_name }}</span>
                  </div>
                  <div class="product-price w-100">
                    <div class="d-flex justify-content-between px-1">
                      <span class="price">₱{{ item.price }} / {{ item.unit }}</span>
                      <button class="btn btn-sm btn-primary"><i class="fas fa-cart-plus"></i> &nbsp; Add To Cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
      products2: [
        {
          id: 1,
          image_link: "https://palengkesentral.com/wp-content/uploads/2020/04/Fresh-Red-FUJI-Apple-Specification-Yantai-FUJI-Apple-Honey-FUJI-Apple.jpg",
          product_name: "Fuji Apple - typically round and range from large to very large, averaging 75 mm in diameter.",
          price: 50.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Active",
          description: "Lorem ipsum easd, Lorem ipsum easd Lorem ipsum easd, Lorem ipsum easd",
        },
        {
          id: 2,
          image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
          product_name: "Apple the super duper delicuis from canada.",
          price: 150.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Active",
          description: "Lorem ipsum easd, Lorem ipsum easd Lorem ipsum easd, Lorem ipsum easd",
        },
        {
          id: 101,
          image_link: "https://palengkesentral.com/wp-content/uploads/2020/04/Fresh-Red-FUJI-Apple-Specification-Yantai-FUJI-Apple-Honey-FUJI-Apple.jpg",
          product_name: "Fuji Apple - typically round and range from large to very large, averaging 75 mm in diameter.",
          price: 50.0,
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
          id: 103,
          image_link: "https://palengkesentral.com/wp-content/uploads/2020/04/Fresh-Red-FUJI-Apple-Specification-Yantai-FUJI-Apple-Honey-FUJI-Apple.jpg",
          product_name: "Fuji Apple - typically round and range from large to very large, averaging 75 mm in diameter.",
          price: 50.0,
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
          image_link: "https://www.foodsafetynews.com/files/2020/06/raw-sirloin-steak-beef.jpg",
          product_name: "Beef - Fresh from Austrilla",
          price: 250.0,
          unit: "kilo",
          category_name: "Fruite",
          product_status: "Sold Out",
          description: "Lorem ipsum easd,  Lorem ipsum easd  ipsum easd,    ipsum easd,  ",
        },
        {
          id: 3,
          image_link: "https://www.foodsafetynews.com/files/2020/06/raw-sirloin-steak-beef.jpg",
          product_name: "Beef - Fresh from Austrilla",
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

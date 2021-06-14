<template>
  <div class="container mt-3">
    <div class="row">
      <div class="col-12">
        <el-row>
          <el-col :xs="24" :sm="16" :md="18" :lg="18" :xl="20" class="p-2">
            <el-input placeholder="Type something" v-model="search">
              <i slot="prefix" class="el-input__icon el-icon-search"></i>
            </el-input>
          </el-col>
          <el-col :xs="24" :sm="8" :md="6" :lg="6" :xl="4" class="p-2">
            <el-select v-model="value" clearable placeholder="Filter" class="w-100">
              <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value"> </el-option>
            </el-select>
          </el-col>
        </el-row>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <el-row>
          <el-col :xs="24" :sm="8" :md="6" :lg="6" :xl="6" class="p-2" v-for="(item, index) in products" :key="index">
            <div class="product">
              <div class="product-image">
                <img :src="item.image_link" alt="" />
              </div>
              <div class="product-desc">
                <div class="product-name">
                  <span class="title">{{ item.product_name }}</span>
                </div>
                <div class="product-price">
                  <span class="price">₱{{ item.price }} / {{ item.unit }}</span>
                </div>
              </div>
            </div>
          </el-col>
        </el-row>
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
// .product:hover {
//   // box-shadow: 0 0.5rem 1rem rgb(0 174 119 / 35%) !important;
//   box-shadow: 4px 4px 4px 4px rgba(0, 174, 119, 0.5) !important;
// }
// .product {
//   margin: 5px;
//   padding: 0px;
//   background: white;
//   box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%) !important;
//   .product-image {
//     img {
//       object-fit: cover;
//       width: 189px;
//       height: 189px;
//     }
//   }
//   .product-desc {
//     width: 189px;
//     padding: 5px;
//     .product-name {
//       position: relative;
//       font-size: 14px;
//       height: 36px;
//       line-height: 18px;
//       color: #212121;
//       white-space: pre-wrap;
//       display: -webkit-box;
//       -webkit-line-clamp: 2;
//       -webkit-box-orient: vertical;
//       text-overflow: ellipsis;
//       overflow: hidden;
//     }
//     .product-price {
//       position: relative;
//       font-size: 16px;
//       font-weight: 1000;
//       color: #2c9144;
//     }
//   }
// }
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
    }
  }
}
</style>
<script>
export default {
  props: ["is_auth"],
  data() {
    return {
      search: "",
      value: null,
      options: [
        {
          value: "Fruites",
          label: "Fruites",
        },
        {
          value: "Vegetables",
          label: "Vegetables",
        },
        {
          value: "Meats",
          label: "Meats",
        },
      ],
      products: [
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

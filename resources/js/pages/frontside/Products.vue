<template>
  <div id="products-page" class="container mt-3">
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

    <div class="row mb-5">
      <div class="col-12">
        <el-row>
          <el-col :xs="24" :sm="12" :md="8" :lg="6" :xl="6" class="p-2" v-for="(item, index) in products" :key="index">
            <div class="product">
              <div class="product-image">
                <img :src="item.image_link" alt="" />
              </div>
              <div class="product-desc">
                <div class="product-name">
                  <span>{{ item.name }}</span>
                </div>
				<div>
					<span v-if="item.status == '1'" class="badge badge-info">Available</span>
					<span v-if="item.status == '0'" class="badge badge-danger">Out of Stock</span>
				</div>
                <div class="category">
                  <span>{{ item.category }}</span>
                </div>
                <div class="product-price w-100">
                  <div class="d-flex justify-content-between px-1">
                    <span class="price">₱{{ item.price }} / {{ item.unit }}</span>
					<button class="btn btn-sm btn-primary" type="button" @click="ShowAddToCartModal(item)" :disabled="item.status == '0'">
						<i class="fas fa-cart-plus"></i> &nbsp; Add To Cart
					</button>
                  </div>
                </div>
                <div class="vendor">
                  <router-link :to="`/store/${item.vendor.id}`">
                    <span
                      ><u>{{ item.vendor.name }}</u></span
                    >
                  </router-link>
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
@import "resources/sass/mixins.scss";
.product:hover {
  // box-shadow: 0 0.5rem 1rem rgb(0 174 119 / 35%) !important;
  box-shadow: 4px 4px 4px 4px rgba(198, 68, 168, 0.5) !important;
}
.product {
  margin: 5px;
  padding: 0px;
  background: white;
//   box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%) !important;
  box-shadow: 4px 4px 4px 4px rgba(0, 174, 119, 0.5) !important;

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
      font-size: 18px;
      font-weight: 800;
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
    .category {
      color: #c644a8;
      font-size: 18px;
    }
    .product-price {
      position: relative;
      font-size: 20px;
      font-weight: 1000;
      color: #2c9144;
      margin-top: 10px;
    }
    .vendor {
      text-align: center;
      color: #a8c644;
      font-size: 14px;
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
          value: "Fruits",
          label: "Fruits",
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
          vendor: {},
        },
      ],
      image_link: "https://www.osfhealthcare.org/blog/wp-content/uploads/2019/08/apples-OG-765x310.jpg",
    };
  },
  methods: {
    ShowAddToCartModal(item) {
	  if (item.status == "0") return;
      this.$events.fire("ShowAddToCartModal", item);
    },
    getProducts() {
      axios
        .get(`/getProducts`)
        .then((res) => {
          console.log(res);
          this.$events.fire("LoadingOverlayHide");
          this.products = res.data;
        })
        .catch((err) => {
          console.error(err);
          this.$events.fire("LoadingOverlayHide");
        });
    },
  },
  mounted() {
    this.$events.fire("LoadingOverlayShow");
    this.getProducts();
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

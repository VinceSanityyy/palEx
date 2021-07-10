<template>
  <div class="modal" id="AddToCartModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Add To Cart</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body costume-modal-body">
          <div class="product">
            <div class="product-image">
              <img :src="item.image_link" alt="" />
            </div>

            <div class="product-desc">
              <div class="product-name">
                <span>{{ item.name }}</span>
              </div>
              <div class="product-price w-100">
                <div class="d-flex justify-content-between px-1 mb-1">
                  <span class="price">₱{{ item.price }} / {{ item.unit }}</span>
                </div>
              </div>
              <div class="category mb-1">
                <span style="color: black">Category: </span><span> {{ item.category }}</span>
              </div>
              <div class="vendor mb-1">
                <span style="color: black">Store: </span>
                <router-link :to="`/store/${item.vendor.id}`">
                  <span>
                    <u>{{ item.vendor.name }}</u></span
                  >
                </router-link>
              </div>

              <div class="mt-1">
                <span>Quantity:</span>
              </div>
              <div class="d-flex justify-content-between">
                <el-input-number size="small" v-model="qty"></el-input-number>
                <button class="btn btn-sm btn-primary" type="button" @click="addToCart()"><i class="fas fa-cart-plus"></i> &nbsp; Add To Cart</button>
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
  props: ["is_auth"],
  data() {
    return {
      qty: 1,
      item: {
        vendor: {},
      },
      MyErrorClass: new MyErrorClass(),
    };
  },
  methods: {
    addToCart() {
      if (this.is_auth) {
        let params = {
          vendor_id: this.item.vendor.id,
          product_id: this.item.id,
          quantity: this.qty,
        };
        axios
          .post(`/addToCart`, params)
          .then((res) => {
            this.$message({
              message: "Success Add to Cart",
              type: "success",
              customClass: "palex-msg-min-width",
            });
            this.$events.fire("updateCartCounter");
            $("#AddToCartModal").modal("hide");
          })
          .catch((err) => {
            if (err.response.status == 422) {
              this.MyErrorClass.record(err.response.data.errors);
              var msg = this.MyErrorClass.getAllMessages();
              this.$message({
                showClose: true,
                type: "error",
                dangerouslyUseHTMLString: true,
                message: `<strong>${msg}</strong>`,
                customClass: "palex-msg-min-width",
              });
            }
          });
      } else {
        window.location.href = "/login";
        // this.$router.push("/login");
      }
    },
  },
  events: {
    ShowAddToCartModal(item) {
      this.item = item;
      this.qty = 1;
      $("#AddToCartModal").modal("show");
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
.product {
  margin: 5px;
  padding: 0.5rem;
  @media (min-width: 280px) and (max-width: 375px) {
    padding: 0.25rem;
  }
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
      text-align: left;
      color: #a8c644;
      font-size: 14px;
    }
  }
}

@media (min-width: 280px) and (max-width: 425px) {
  .costume-modal-body {
    padding: 5px;
  }
}
</style>

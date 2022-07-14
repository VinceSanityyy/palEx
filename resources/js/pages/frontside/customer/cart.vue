<template>
  <section class="content mt-5" style="margin-bottom: 5rem">
    <div v-if="cartList.length <= 0" class="container palex-checkout-page">
      <div class="row">
        <div class="col-md-12">
          <div class="palex-card">
            <div
              style="
                display: flex;
                justify-content: center;
                align-items: center;
                height: 450px;
              "
            >
              <div class="text-center">
                <h3>There are no items in this cart</h3>
                <div>
                  <el-button type="success" plain @click="backToProducts()"
                    >Continue Shopping</el-button
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="cartList.length >= 1" class="container palex-checkout-page">
      <div class="row">
        <div class="col-lg-8 col-md-7">
          <div
            v-for="(item, index) in cartList"
            :key="index"
            class="palex-card mb-2"
          >
            <div class="w-100">
              <div
                class="store-name ml-3 mb-2 p-2 border-bottom border-secondary"
              >
                <span>
                  <i class="fas fa-store mr-2"></i> {{ item.vendor.name }}
                </span>
                <!-- <el-divider><i class="el-icon-star-on"></i></el-divider> -->
              </div>
              <div
                v-for="(el, index2) in item.items"
                :key="index2"
                class="item border-bottom border-success p-2"
              >
                <div class="d-flex">
                  <!-- <div class="check-box mx-3" style="display: flex; align-items: center; height: auto">
                    <el-button type="danger" icon="el-icon-delete" circle size="mini"></el-button>
                  </div> -->
                  <div class="prod-img" style="min-width: 90px">
                    <img
                      style="width: 80px; height: 80px; object-fit: cover"
                      :src="el.product.image_link"
                      alt=""
                    />
                  </div>
                  <div class="prod-name w-100">
                    <div class="d-flex">
                      <div style="width: 90%">
                        <span
                          ><b>{{ el.product.name }}</b></span
                        >
                      </div>
                      <div style="width: 10%" class="ml-2 text-left">
                        <el-button
                          type="danger"
                          icon="el-icon-delete"
                          circle
                          size="mini"
                          @click="removeCartItem(el)"
                        ></el-button>
                      </div>
                    </div>
                    <div
                      class="prod-cat"
                      style="font-size: 10px; color: #c644a8"
                    >
                      <span>{{ el.product.category }}</span>
                    </div>
                    <div
                      class="
                        prod-price
                        d-flex
                        flex-wrap
                        justify-content-between
                      "
                    >
                      <span
                        >₱{{ frmtd(el.product.price) }}/{{
                          el.product.unit
                        }}</span
                      >
                      <span class="mx-1">x</span>
                      <span class="mx-1">{{ el.quantity }}</span>
                      <span class="mx-1">=</span>
                      <span class="mx-1" style="color: #2c9144"
                        >₱{{ frmtd(el.subTotal) }}</span
                      >
                    </div>
                    <!-- <span class="mx-1" style="color: #2c9144">₱{{ frmtd(el.subTotal) }}</span> -->
                    <div class="product-qty mt-3">
                      <el-input-number
                        @change="updateQuantity(el)"
                        size="mini"
                        v-model="el.quantity"
                        :min="1"
                        step-strictly
                      ></el-input-number>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-between px-2">
              <span> Sub-total </span>
              <span class="mx-1"> ₱{{ frmtd(item.subtotal) }} </span>
            </div>

            <div class="d-flex justify-content-between px-2 delfee-color">
              <span> Delivery Fee </span>
              <span class="mx-1">
                ₱{{ frmtd(item.vendor_shipping_fee_amount) }}
              </span>
            </div>

            <div
              class="d-flex justify-content-between px-2"
              style="color: #2c9144; font-weight: 600"
            >
              <span> Total </span>
              <span class="mx-1">
                ₱{{ frmtd(item.subtotal_with_shipping_fee) }}
              </span>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-5">
          <div class="palex-card">
            <div class="palex-order-summary px-1 py-2">
              <h3 class="my-3">Order Summary</h3>
              <div class="d-flex justify-content-between my-2">
                <span>Total Order Amount: </span>
                <span> ₱ {{ frmtd(total_order_amount) }}</span>
              </div>
              <div class="d-flex justify-content-between my-2 delfee-color">
                <span>Total Delivery Fee: </span>
                <span> ₱ {{ frmtd(total_delivery_fee) }}</span>
              </div>
              <div class="d-flex justify-content-between my-2">
                <span>Discount:</span>
                <span> ₱ {{ frmtd(discount) }}</span>
              </div>
              <hr />
              <div class="d-flex justify-content-between my-2 total">
                <span><b>Total:</b></span>
                <span> ₱ {{ frmtd(overall_total) }}</span>
              </div>
              <div class="mt-5 text-center">
                <el-button
                  class="w-100"
                  type="success"
                  plain
                  @click="PlaceOrder"
                  >Place Order</el-button
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  props: ["is_auth"],
  data() {
    return {
      cartList: [],
      //   cartList: [
      //     {
      //       items: [
      //         {
      //           product: {},
      //         },
      //       ],
      //       vendor: {},
      //     },
      //   ],
      user: {},
      total_order_amount: 0,
      discount: 0,
      overall_total: 0,
      qty: 1,
    };
  },
  mounted() {
    this.getCurrentAuth();
    this.getCart();
  },
  methods: {
    async PlaceOrder() {
      try {
        const res = await axios.post("/placeOrder");
        alert("success");
      } catch (error) {
        console.error(err);
      }
    },
    backToProducts() {
      this.$router.push("/products");
    },
    removeCartItem(el) {
      this.$events.fire("LoadingOverlayShow");
      axios
        .post(`/removeCartItem`, {
          cart_item_id: el.id,
        })
        .then((res) => {
          this.getCart();
        })
        .catch((err) => {
          this.getCart();
        });
    },
    updateQuantity(el) {
      this.$events.fire("LoadingOverlayShow");
      // console.log(el);
      // console.log(el.quantity);
      axios
        .post(`/updateCartItem`, {
          cart_item_id: el.id,
          quantity: el.quantity,
        })
        .then((res) => {
          console.log(res);
          this.getCart();
        })
        .catch((err) => {
          console.error(err);
          this.getCart();
        });
    },
    getCurrentAuth() {
      axios.get("/me").then((res) => {
        this.user = res.data;
      });
    },
    getCart() {
      axios
        .get(`/getCart`)
        .then((res) => {
          this.$events.fire("LoadingOverlayHide");
          this.cartList = res.data.details;
          this.total_order_amount = res.data.total_order_amount;
          this.total_delivery_fee = res.data.total_shipping_fee;
          this.discount = res.data.discount;
          this.overall_total = res.data.over_all_total;
        })
        .catch((err) => {
          this.$events.fire("LoadingOverlayHide");
          console.error(err);
        });
    },
    frmtd(value) {
      var n = parseFloat(value).toFixed(2);
      var withCommas = Number(n).toLocaleString("en", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
      });
      return withCommas;
    },
  },
};
</script>

<style lang="scss" scoped>
// @import "resources/sass/mixins.scss";
.delfee-color {
  color: lightsalmon !important;
}
.palex-card {
  background: white;
  margin: 0.5rem;
  padding: 0.5rem;
  box-shadow: 4px 4px 4px 4px rgba(0, 174, 119, 0.5) !important;
}
.palex-cart-list {
}
.palex-order-summary {
  min-height: 300px;
  .total {
    font-size: 20px;
    font-weight: 1000;
    color: #2c9144;
  }
}
</style>

<template>
  <section class="content mt-5" style="margin-bottom: 5rem">
    <div class="d-none container palex-checkout-page">
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
    <div class="container palex-checkout-page">
      <div class="row">
        <div class="col-lg-8 col-md-7">
          <div class="palex-card mb-2">
            <div class="d-flex px-2">
              <span class="mr-2">
                <i class="fas fa-store mr-2"></i>
                Store:
              </span>
              <span class="mx-1" style="font-weight: bold">
                Store Name In here</span
              >

              <span class="ml-auto badge badge-warning" style="font-size: 18px"
                >PENDING</span
              >
            </div>
            <hr />

            <div class="px-3 py-1 d-flex align-itens-center">
              <div class="prod-img px-1" style="min-width: 90px">
                <img
                  src="http://palex.test/storage/images/products/seeds/apple.jpg"
                  alt=""
                  style="
                    width: 80px;
                    height: 80px;
                    object-fit: cover;
                    border: 1px solid black;
                  "
                />
              </div>
              <div class="prod-img px-1" style="min-width: 90px">
                <img
                  src="http://palex.test/storage/images/products/seeds/apple.jpg"
                  alt=""
                  style="
                    width: 80px;
                    height: 80px;
                    object-fit: cover;
                    border: 1px solid black;
                  "
                />
              </div>
              <div class="prod-img px-1" style="min-width: 90px">
                <img
                  src="http://palex.test/storage/images/products/seeds/apple.jpg"
                  alt=""
                  style="
                    width: 80px;
                    height: 80px;
                    object-fit: cover;
                    border: 1px solid black;
                  "
                />
              </div>
              <div class="prod-img px-1" style="min-width: 90px">
                <img
                  src="http://palex.test/storage/images/products/seeds/apple.jpg"
                  alt=""
                  style="
                    width: 80px;
                    height: 80px;
                    object-fit: cover;
                    border: 1px solid black;
                  "
                />
              </div>
              <div class="prod-img px-1" style="min-width: 90px">
                <img
                  src="http://palex.test/storage/images/products/seeds/apple.jpg"
                  alt=""
                  style="
                    width: 80px;
                    height: 80px;
                    object-fit: cover;
                    border: 1px solid black;
                  "
                />
              </div>

              <div class="prod-img px-1 my-auto" style="min-width: 90px">
                <el-button type="primary" plain>More Details... </el-button>

              </div>
            </div>

            <div class="d-flex justify-content-between px-2">
              <span> Payment Method</span>
              <span class="mx-1"> Cash On Delivery </span>
            </div>

            <div class="d-flex justify-content-between px-2">
              <span> Orders Total </span>
              <span class="mx-1"> ₱{{ frmtd(123) }} </span>
            </div>

            <div class="d-flex justify-content-between px-2 delfee-color">
              <span> Delivery Fee </span>
              <span class="mx-1"> ₱{{ frmtd(123) }} </span>
            </div>

            <div class="d-flex justify-content-between px-2">
              <span> Discount </span>
              <span class="mx-1"> ₱{{ frmtd(123) }} </span>
            </div>
            <hr />
            <div
              class="d-flex justify-content-between px-2"
              style="color: #2c9144; font-weight: 600"
            >
              <span> Total </span>
              <span class="mx-1"> ₱{{ frmtd(123) }} </span>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-5">
          <div class="palex-card">
            <div class="palex-order-summary px-1 py-2">
              <h3 class="my-3 text-center">Order Status</h3>
              <div class="d-flex justify-content-between my-2">
                <span>Pending: </span>
                <span>
                  <span class="badge badge-warning">5</span>
                </span>
              </div>
              <div class="d-flex justify-content-between my-2">
                <span>To Deliver: </span>
                <span>
                  <span class="badge badge-info">2</span>
                </span>
              </div>
              <div class="d-flex justify-content-between my-2">
                <span>Complated</span>
                <span>
                  <span class="badge badge-success">20</span>
                </span>
              </div>

              <div class="d-flex justify-content-between my-2">
                <span>Cancelled</span>
                <span>
                  <span class="badge badge-success">20</span>
                </span>
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
        this.$message({
          message: "Success Place Order",
          type: "success",
          customClass: "palex-msg-min-width",
        });
        // this.getCart();
        this.$router.push("/customer/orders");
        // /customer/orders
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

<template>
  <section class="content mt-5" style="margin-bottom: 5rem">
    <div v-if="cartList.length <= 0" class="container palex-checkout-page">
      <div class="row">
        <div class="col-md-12">
          <div class="palex-card">
            <div style="display: flex; justify-content: center; align-items: center; height: 450px">
              <div class="text-center"><h3>There are no items in this cart</h3></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="cartList.length >= 1" class="container palex-checkout-page">
      <div class="row">
        <div class="col-lg-8 col-md-7">
          <div v-for="(item, index) in cartList" :key="index" class="palex-card mb-2">
            <div class="w-100">
              <div class="store-name ml-3 mb-2 p-2 border-bottom border-secondary">
                <span> <i class="fas fa-store mr-2"></i> {{ item.vendor.name }} </span>
                <!-- <el-divider><i class="el-icon-star-on"></i></el-divider> -->
              </div>
              <div v-for="(el, index2) in item.items" :key="index2" class="item border-bottom border-success p-2">
                <div class="d-flex">
                  <!-- <div class="check-box mx-3" style="display: flex; align-items: center; height: auto">
                    <el-button type="danger" icon="el-icon-delete" circle size="mini"></el-button>
                  </div> -->
                  <div class="prod-img" style="min-width: 90px">
                    <img style="width: 80px; height: 80px; object-fit: cover" :src="el.product.image_link" alt="" />
                  </div>
                  <div class="prod-name w-100">
                    <div class="d-flex">
                      <div>
                        <span>{{ el.product.name }}</span>
                      </div>
                      <div class="ml-2 ml-auto">
                        <el-button type="danger" icon="el-icon-delete" circle size="mini"></el-button>
                      </div>
                    </div>
                    <div class="prod-cat" style="font-size: 10px">
                      <span>{{ el.product.category }}</span>
                    </div>
                    <div class="prod-price d-flex justify-content-between">
                      <span>₱{{ frmtd(el.product.price) }}/{{ el.product.unit }}</span>
                      <span class="mx-1">x</span>
                      <span class="mx-1">{{ el.quantity }}</span>
                      <span class="mx-1">=</span>
                      <span class="mx-1" style="color: #2c9144">₱{{ frmtd(el.subTotal) }}</span>
                    </div>
                    <div class="product-qty mt-3">
                      <el-input-number @change="updateQuantity(el)" :min="1" size="mini" v-model="el.quantity" step-strictly></el-input-number>
                    </div>
                  </div>
                </div>
              </div>
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
              <div class="d-flex justify-content-between my-2">
                <span>Discount:</span>
                <span> ₱ {{ frmtd(discount) }}</span>
              </div>
              <hr />
              <div class="d-flex justify-content-between my-2 total">
                <span><b>Total:</b></span>
                <span> ₱ {{ frmtd(overall_total) }}</span>
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
    updateQuantity(el){
        // console.log(el);
        // console.log(el.quantity);
        axios.post(`/updateCartItem`,{
            cart_item_id:el.id,
            quantity:el.quantity,
        })
        .then(res => {
            console.log(res);
            this.getCart();
        })
        .catch(err => {
            console.error(err);
             this.getCart();
        })
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
          this.cartList = res.data.details;
          this.total_order_amount = res.data.total_order_amount;
          this.discount = res.data.discount;
          this.overall_total = res.data.over_all_total;
        })
        .catch((err) => {
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

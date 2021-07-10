<template>
  <section class="content mt-5" style="margin-bottom:5rem;">
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
          <div class="palex-card">
            <div class="w-100">
              <div class="store-name ml-3 mb-2 p-2 border-bottom border-secondary">
                <span> <i class="fas fa-store mr-2"></i> Store 1</span>
                <!-- <el-divider><i class="el-icon-star-on"></i></el-divider> -->
              </div>
              <div class="item border-bottom border-success p-2">
                <div class="d-flex">
                  <!-- <div class="check-box mx-3" style="display: flex; align-items: center; height: auto">
                    <el-button type="danger" icon="el-icon-delete" circle size="mini"></el-button>
                  </div> -->
                  <div class="prod-img" style="min-width: 90px">
                    <img style="width: 80px; height: 80px; object-fit: cover" src="/storage/images/products/3jaCqHANMkXd6F2sNpfxGtmVEtqTBWXq1HNke1k4.jpg" alt="" />
                  </div>
                  <div class="prod-name w-100">
                    <div class="d-flex">
                      <div>
                        <span>Product Name </span>
                      </div>
                      <div class="ml-2 ml-auto">
                        <el-button type="danger" icon="el-icon-delete" circle size="mini"></el-button>
                      </div>
                    </div>
                    <div class="prod-cat" style="font-size: 10px">
                      <span>Dry</span>
                    </div>
                    <div class="prod-price d-flex justify-content-between">
                      <span>₱100.00</span>
                      <span class="mx-1">x</span>
                      <span class="mx-1">1</span>
                      <span class="mx-1">=</span>
                      <span class="mx-1" style="color: #2c9144">₱100.00</span>
                    </div>
                    <div class="product-qty mt-3">
                      <el-input-number size="mini" v-model="qty"></el-input-number>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="palex-card">
            <div class="w-100">
              <div class="store-name ml-3 mb-2 p-2 border-bottom border-secondary">
                <span> <i class="fas fa-store mr-2"></i> Store 2</span>
                <!-- <el-divider><i class="el-icon-star-on"></i></el-divider> -->
              </div>
              <div class="item border-bottom border-success p-2">
                <div class="d-flex">
                  <!-- <div class="check-box mx-3" style="display: flex; align-items: center; height: auto">
                    <el-button type="danger" icon="el-icon-delete" circle size="mini"></el-button>
                  </div> -->
                  <div class="prod-img" style="min-width: 90px">
                    <img style="width: 80px; height: 80px; object-fit: cover" src="/storage/images/products/3jaCqHANMkXd6F2sNpfxGtmVEtqTBWXq1HNke1k4.jpg" alt="" />
                  </div>
                  <div class="prod-name w-100">
                    <div class="d-flex">
                      <div>
                        <span>Product Name 2 </span>
                      </div>
                      <div class="ml-2 ml-auto">
                        <el-button type="danger" icon="el-icon-delete" circle size="mini"></el-button>
                      </div>
                    </div>
                    <div class="prod-cat" style="font-size: 10px">
                      <span>Dry</span>
                    </div>
                    <div class="prod-price d-flex justify-content-between">
                      <span>₱100.00</span>
                      <span class="mx-1">x</span>
                      <span class="mx-1">1</span>
                      <span class="mx-1">=</span>
                      <span class="mx-1" style="color: #2c9144">₱100.00</span>
                    </div>
                    <div class="product-qty mt-3">
                      <el-input-number size="mini" v-model="qty"></el-input-number>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item border-bottom border-success p-2">
                <div class="d-flex">
                  <!-- <div class="check-box mx-3" style="display: flex; align-items: center; height: auto">
                    <el-button type="danger" icon="el-icon-delete" circle size="mini"></el-button>
                  </div> -->
                  <div class="prod-img" style="min-width: 90px">
                    <img style="width: 80px; height: 80px; object-fit: cover" src="/storage/images/products/3jaCqHANMkXd6F2sNpfxGtmVEtqTBWXq1HNke1k4.jpg" alt="" />
                  </div>
                  <div class="prod-name w-100">
                    <div class="d-flex">
                      <div>
                        <span>Product Name 3 </span>
                      </div>
                      <div class="ml-2 ml-auto">
                        <el-button type="danger" icon="el-icon-delete" circle size="mini"></el-button>
                      </div>
                    </div>
                    <div class="prod-cat" style="font-size: 10px">
                      <span>Dry</span>
                    </div>
                    <div class="prod-price d-flex justify-content-between">
                      <span>₱100.00</span>
                      <span class="mx-1">x</span>
                      <span class="mx-1">1</span>
                      <span class="mx-1">=</span>
                      <span class="mx-1" style="color: #2c9144">₱100.00</span>
                    </div>
                    <div class="product-qty mt-3">
                      <el-input-number size="mini" v-model="qty"></el-input-number>
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
                <span> ₱ 100.00</span>
              </div>
              <div class="d-flex justify-content-between my-2">
                <span>Discount:</span>
                <span> ₱ 0.00</span>
              </div>
              <hr />
              <div class="d-flex justify-content-between my-2 total">
                <span><b>Total:</b></span>
                <span> ₱ 100.00</span>
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
      cartList: [{ test: 1 }],
      user: {},
      total_order_amout: 0,
      discount: 0,
      overall_total: 0,
      qty: 1,
    };
  },
  mounted() {
    this.getCurrentAuth();
  },
  methods: {
    getCurrentAuth() {
      axios.get("/me").then((res) => {
        this.user = res.data;
      });
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

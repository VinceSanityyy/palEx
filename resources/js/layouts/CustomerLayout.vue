<template>
  <div>
    <!-- <PalexLoading></PalexLoading> -->
    <!-- MOBILE TOP NAV -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top palex-nav-cp">
      <div class="w-100 text-center">
        <a class="navbar-brand"><img src="/img/logo/palex3.png" style="width: 100px; height: auto" alt="" /></a>
        <div style="position: absolute; top: 15px; right: 8px">
          <RouterLink v-if="is_auth" to="/customer/cart">
            <i class="fas fa-shopping-cart font-size-20" style="color: #fff"></i>
            <span v-if="cartNumber" class="badge badge-danger font-size-11"> {{ cartNumber }}</span>
          </RouterLink>
          <!-- <RouterLink v-if="!is_auth" class="nav-link" to="/login">
            <i class="fas fa-shopping-cart font-size-20"></i>
          </RouterLink> -->
          <a v-if="!is_auth" href="/login"><i class="fas fa-shopping-cart font-size-20" style="color: #fff"></i></a>
        </div>
      </div>
    </nav>

    <!-- WEB TOP NAV -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top palex-nav-web" >
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand"><img src="/img/logo/palex3.png" style="width: 100px; height: auto" alt="" /></a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <!-- <li class="nav-item active">
            <RouterLink to="/home" class="nav-link active">Home</RouterLink>
          </li> -->
          <li class="nav-item">
            <RouterLink to="/products" class="nav-link active"><i class="fas fa-store mr-1"></i>Stores</RouterLink>
          </li>

          <li v-if="is_auth" class="nav-item">
            <RouterLink to="/customer/feeds" class="nav-link active"><i class="fas fa-rss mr-1"></i>News</RouterLink>
          </li>
          <li v-if="is_auth" class="nav-item">
            <RouterLink to="/customer/orders" class="nav-link active"><i class="fas fa-file-invoice mr-1"></i>My Orders</RouterLink>
          </li>
          <li v-if="is_auth" class="nav-item">
            <RouterLink to="/customer" class="nav-link active"><i class="fas fa-user mr-1"></i>Profile</RouterLink>
          </li>
          <li v-if="is_auth" class="nav-item">
            <RouterLink to="/customer/chat" class="nav-link active"> <i class="far fa-comments mr-1"></i>Chat</RouterLink>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <RouterLink v-if="is_auth" class="nav-link active" to="/customer/cart">
              <i class="fas fa-shopping-cart font-size-20"></i>
              <span v-if="cartNumber" class="badge badge-danger font-size-11"> {{ cartNumber }}</span>
            </RouterLink>
            <!-- <RouterLink v-if="!is_auth" class="nav-link" to="/login">
              <i class="fas fa-shopping-cart font-size-20"></i>
            </RouterLink> -->
            <a v-if="!is_auth" href="/login" class="nav-link active"><i class="fas fa-shopping-cart font-size-20"></i></a>
          </li>
          <li v-if="!is_auth" class="nav-item">
            <a href="/login" class="nav-link active">Login</a>
          </li>
          <li v-if="!is_auth" class="nav-item">
            <a href="/register" class="nav-link active">Sign Up</a>
          </li>
          <li v-if="is_auth" class="nav-item">
            <a class="nav-link active" @click="logout()">
              <i class="fas fa-sign-out-alt"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <section>
      <router-view :is_auth="is_auth" />
      <router-view :is_auth="is_auth" name="helper" />
    </section>
    <nav
      :style="!is_auth ? 'justify-content:center !important;' : 'justify-content: space-between !important;'"
      class="navbar fixed-bottom navbar-expand-sm navbar-light palex-footer-nav"
      style="border-top: solid 2px #44c662"
    >
      <RouterLink class="cp-nav-item" to="/products">
        <div class="d-flex flex-column text-center">
          <i class="fas fa-store"></i>
          <span>Stores</span>
        </div>
      </RouterLink>
      <RouterLink v-if="is_auth" class="cp-nav-item" to="/customer/feeds">
        <div class="d-flex flex-column text-center">
          <i class="fas fa-rss"></i>
          <span>News</span>
        </div>
      </RouterLink>
      <RouterLink v-if="is_auth" class="cp-nav-item" to="/customer/chat">
        <div class="d-flex flex-column text-center">
          <i class="far fa-comments"></i>
          <span>Chat</span>
        </div>
      </RouterLink>
      <!-- <RouterLink v-if="is_auth" class="cp-nav-item" to="#">
        <div class="d-flex flex-column text-center">
          <i class="fas fa-map-marked-alt"></i>
          <span>Map</span>
        </div>
      </RouterLink> -->
      <RouterLink v-if="is_auth" class="cp-nav-item" to="/customer/orders">
        <div class="d-flex flex-column text-center">
          <i class="fas fa-file-invoice"></i>
          <span>Orders</span>
        </div>
      </RouterLink>
      <RouterLink v-if="is_auth" class="cp-nav-item" to="/customer">
        <div class="d-flex flex-column text-center">
          <i class="fas fa-user"></i>
          <span>Profile</span>
        </div>
      </RouterLink>
      <a v-if="is_auth" @click="logout()" class="cp-nav-item">
        <div class="d-flex flex-column text-center">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </div>
      </a>
      <a v-if="!is_auth" href="/login" class="cp-nav-item ml-3">
        <div class="d-flex flex-column text-center">
          <i class="fas fa-sign-in-alt"></i>
          <span>Log-in</span>
        </div>
      </a>
      <a v-if="!is_auth" href="/register" class="cp-nav-item ml-3">
        <div class="d-flex flex-column text-center">
          <i class="fas fa-user-plus"></i>
          <span>Sign-up</span>
        </div>
      </a>
    </nav>
    <AddToCartModal :is_auth="is_auth"></AddToCartModal>
  </div>
</template>

<script>
export default {
  props: ["is_auth"],
  data() {
    return {
      user: [],
      cartNumber: 0,
    };
  },
  methods: {
    logout() {
      axios.post("/logout").then((res) => {
        window.location.href = "/login";
      });
    },
    getCurrentAuth() {
      axios.get("/me").then((res) => {
        this.user = res.data;
      });
    },
    logout() {
      axios.post("/logout").then((res) => {
        window.location.href = "/login";
      });
    },
    methodNotYet() {
      toastr.error("wala pa function");
    },
    getCartCounter() {
      if (this.is_auth) {
        axios
          .get(`/getCartCounter`)
          .then((res) => {
            console.log(res);
            this.cartNumber = res.data;
          })
          .catch((err) => {
            console.error(err);
          });
      }
    },
  },
  mounted() {
    this.getCartCounter();
    this.getCurrentAuth();
  },
  events: {
    updateCartCounter() {
      this.getCartCounter();
    },
  },
};
</script>

<style lang="scss">
@import "resources/sass/mixins.scss";
.palex-nav-cp {
  display: none;
  @media (min-width: 280px) and (max-width: 768px) {
    display: flex;
  }
}
.palex-nav-web {
  display: flex;
  //   @include mobile {
  //     display: none;
  //   }
  @media (min-width: 280px) and (max-width: 768px) {
    display: none;
  }
}
.palex-footer-nav {
  display: none;
  //   @include mobile {
  //     display: flex;
  //   }
  @media (min-width: 280px) and (max-width: 768px) {
    display: flex;
  }
}
.cp-nav-item {
  color: grey;
}

// .cp-nav-item.router-link-active {
//   color: #44c662 !important;
// }
</style>


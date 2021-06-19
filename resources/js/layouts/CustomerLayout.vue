<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: #44c662; color: white !important">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand"><img src="/img/logo/palex3.png" style="width: 100px; height: auto" alt="" /></a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <RouterLink to="/home" class="nav-link active">Home</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink to="/products" class="nav-link active">Products</RouterLink>
          </li>
          <li v-if="is_auth" class="nav-item">
            <RouterLink to="/customer/orders" class="nav-link active">My Orders</RouterLink>
          </li>
          <li v-if="is_auth" class="nav-item">
            <RouterLink to="/customer" class="nav-link active">Profile</RouterLink>
          </li>

        </ul>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li v-if="is_auth" class="nav-item">
            <RouterLink class="nav-link" to="/customer/cart">
              <i class="fas fa-shopping-cart font-size-20"></i>
              <span class="badge badge-danger font-size-11"> {{ cartNumber }}</span>
            </RouterLink>
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
  </div>
</template>
<script>
export default {
  props: ["is_auth"],
  data() {
    return {
      user: [],
      cartNumber: 123,
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
  },
  mounted() {
    this.getCurrentAuth();
  },
};
</script>

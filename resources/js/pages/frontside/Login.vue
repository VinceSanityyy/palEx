<template>
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="login-logo">
      Palengke Express
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Login Here</p>
        <form @submit.prevent="login" method="post">
          <div class="input-group mb-3">
            <input
              type="email"
              class="form-control"
              placeholder="Email"
              v-model="email"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input
              :type="showpass ? 'text' : 'password'"
              class="form-control"
              placeholder="Password"
              v-model="password"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span @click="hideShowPass()" class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">
                Sign In
              </button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
        <!-- /.social-auth-links -->

        <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
        <p class="mb-0">
          <a href="/register" class="text-center">Register Here</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      me: [],
      showpass: false,
    };
  },
  methods: {
    hideShowPass() {
      this.showpass = !this.showpass;
    },
    login() {
      let loader = this.$loading.show({
        container: this.fullPage ? null : this.$refs.formContainer,
        onCancel: this.onCancel,
        color: "#c91010",
        loader: "bars",
        width: 80,
        height: 100,
      });
      axios
        .post("/login", {
          email: this.email,
          password: this.password,
        })
        .then((res) => {
          this.getCurrentAuth();
        })
        .catch((err) => {
          loader.hide();
          console.log(err);
          // toastr.error(err.data)
          toastr.error(err.response.data.message);
        });
    },
    getCurrentAuth() {
      axios.get("/me").then((res) => {
        console.log(res.data);
        if (res.data.role == 0) {
          window.location.href = "/admin";
        } else if (res.data.role == 1) {
          window.location.href = "/vendor";
        } else {
          window.location.href = "/customer";
        }
      });
    },
  },
  created() {
    console.log("Created");
  },
};
</script>

<style>
</style>

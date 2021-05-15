<template>
  <div class="register-box">
  <div class="register-logo">
    <a href="/"><b>PalEx</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form @submit.prevent="register" method="post">
        <div class="input-group mb-3">
          <input v-model="name" type="text" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input v-model="email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input v-model="phone" type="text" class="form-control" placeholder="Phone">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
           <select v-model="role" name="role" class="form-control" id="role">
                    <option value = "" selected disabled>Role</option>
                    <option value = "1">Vendor</option>
                    <option value = "2">Custoemr</option>
            </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-box"></span>
            </div>
          </div>
        </div>
          <div class="input-group mb-3">
          <label for="exampleInputEmail1">Proof (ID, Permit, etc..)</label>
          <input @change="onFileChange" type="file" name="" id="">
        </div>
        <div class="input-group mb-3">
          <input v-model="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input v-model="confirmPass" type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="/login" class="text-center">Aleady a member? Login here</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
</template>

<script>

export default {
data(){
    return{
        email:'',
        password:'',
        confirmPass:'',
        name:'',
        phone:'',
        role:'',
        image:'',
        }
    },
    methods:{
        register(){
            if(this.password != this.confirmPass){
                toastr.error('Passwords diidnt match')
            }
            else{
                if(/^(09|\+639)\d{9}$/.test(this.phone)){
                    let loader = this.$loading.show({
                        container: this.fullPage ? null : this.$refs.formContainer,
                        onCancel: this.onCancel,
                        color: '#c91010',
                        loader: 'bars',
                        width: 80,
                        height: 100,
                    })
                    var bodyForm = new FormData()
                    bodyForm.append('email', this.email)
                    bodyForm.append('password', this.password)
                    bodyForm.append('phone', this.phone)
                    bodyForm.append('name', this.name)
                    bodyForm.append('role', this.role)
                    bodyForm.append('identity', this.image)

                    axios.post('register',bodyForm).then((res)=>{
                        loader.hide();
                        // console.log(res)
                        window.location.href = '/home'
                    }).catch((err)=>{
                        loader.hide();

                        console.log(err.response.data.errors)
                        var errors = err.response.data.errors

                       for (var key of Object.keys(errors)) {
                            toastr.error(errors[key])
                        }
                    })
                }else{
                    toastr.error('Not valid PH phone number')
                }
            }
        },
        onFileChange(e) {
          let file = e.target.files[0];
          this.image = file
        },
    },
    created(){
        console.log('compoent created')
    }
}

</script>


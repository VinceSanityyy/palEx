<template>
  <section class="content mt-5 mb-5">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-10 col-lg-8">
          <!-- Profile Image -->
          <div class="card card-primary card-outline palex-card">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="/dist/img/user4-128x128.jpg" alt="User profile picture" />
              </div>

              <h3 class="profile-username text-center">{{ user.name }}</h3>

              <p class="text-muted text-center"></p>

              <!-- <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item"><b>Followers</b> <a class="float-right">1,322</a></li>
                <li class="list-group-item"><b>Following</b> <a class="float-right">543</a></li>
                <li class="list-group-item"><b>Friends</b> <a class="float-right">13,287</a></li>
              </ul>
                -->
              <a href="#" class="btn btn-primary btn-block"><b>Update Profile Pictre</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-10 col-lg-8">
          <div class="card palex-card">
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="settings">
                  <form class="form-horizontal">
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" v-model="user.email" readonly class="form-control" id="inputEmail" placeholder="Email" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Full Name</label>
                      <div class="col-sm-10">
                        <input type="text" v-model="user.name" class="form-control" id="inputName2" placeholder="Enter yout Full Name" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Phone #</label>
                      <div class="col-sm-10">
                        <input type="text" v-model="user.phone" class="form-control" id="inputSkills" placeholder="Enter your phone number" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="col-md-10 col-lg-8">
          <div class="card palex-card">
            <div class="card-header w-100 text-center">
              <h3 class="card-title">Password Setting</h3>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="settings">
                  <form class="form-horizontal">
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Current Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Change Password</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
</template>
<script>
export default {
  props: ["is_auth"],
  data() {
    return {
      user: {},
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
@import "resources/sass/mixins.scss";
.palex-card {
  background: white !important;
  box-shadow: 4px 4px 4px 4px rgba(0, 174, 119, 0.5) !important;
//   margin: 0.5rem;
//   padding: 1rem;
}
</style>

<style>
.dropdown-toggle::after {
	content: none;
}
.plx-notif-title {
	cursor: pointer;
}

.plx-notif-body {
	cursor: pointer;
	font-size: 12px !important;
}
.plx-notif-date-time {
	cursor: pointer;
	font-size: 12px !important;
}
</style>

<template>
	<div>
		<!-- <PalexLoading></PalexLoading> -->
		<!-- MOBILE TOP NAV -->
		<nav class="navbar navbar-expand-lg navbar-dark sticky-top palex-nav-cp">
			<!-- Right navbar links -->
			<div class="w-100 text-center">
				<div v-if="is_auth" style="position: absolute; top: 15px; left: 8px">
					<div class="dropdown">
						<button
							style="cursor: pointer; background-color: transparent; border: 0px solid #3498db"
							class="dropdown-toggle"
							type="button"
							id="dropdownMenu2"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false"
						>
							<i class="far fa-bell font-size-20" style="color: white !important"></i>
							<span v-if="number_of_notifications" class="badge badge-warning font-size-11"> {{ total_unseen_notifications }}</span>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="width: 300px; max-height: 450px; overflow-y: auto">
							<div v-for="(item, index) in notifications" :key="index">
								<RouterLink :to="item.link_end_point" class="dropdown-item" style="white-space: normal">
									<div class="d-flex">
										<div class="plx-img-icon p-1">
											<img :src="item.image_link" alt="icn" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover" />
										</div>
										<div class="p-1">
												<span v-if="item.seen == 0" class="badge badge-danger">New</span>
											<div class="plx-notif-title" style="font-weight: bold">
												{{ item.title }}
											</div>
											<div v-html="item.body" class="plx-notif-body"></div>
											<div class="plx-notif-date-time">
												<!-- <span> <i class="far fa-clock mr-1"></i> {{ getMoment(item.created_at) }} </span> -->
													<span> <i class="far fa-clock mr-1"></i> {{ moment(item.created_at, "YYYY-MM-DD HH:mm:ss").add(8, 'hours').fromNow() }} </span>
											</div>
										</div>
									</div>
								</RouterLink>
								<div class="dropdown-divider"></div>
							</div>
						</div>
					</div>
				</div>

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
		<nav class="navbar navbar-expand-lg navbar-dark sticky-top palex-nav-web">
			<button
				class="navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#navbarTogglerDemo03"
				aria-controls="navbarTogglerDemo03"
				aria-expanded="false"
				aria-label="Toggle navigation"
			>
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
					<li v-if="is_auth" class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#">
							<i class="far fa-bell font-size-20"></i>
							<span class="badge badge-warning navbar-badge">{{ total_unseen_notifications }}</span>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<span class="dropdown-item dropdown-header">{{ number_of_notifications }} Total Notifications</span>
							<div class="dropdown-divider"></div>

							<div style="max-height: 450px; overflow-y: auto">
								<div v-for="(item, index) in notifications" :key="index">
									<RouterLink :to="item.link_end_point" class="dropdown-item" style="white-space: normal">
										<div class="d-flex">
											<div class="plx-img-icon p-1">
												<img :src="item.image_link" alt="icn" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover" />
											</div>
											<div class="p-1">
												<span v-if="item.seen == 0" class="badge badge-danger">New</span>
												<div class="plx-notif-title" style="font-weight: bold">
													{{ item.title }} 
												</div>
												<div v-html="item.body" class="plx-notif-body"></div>
												<div class="plx-notif-date-time">
													<!-- <span> <i class="far fa-clock mr-1"></i> Just Now </span> -->
													<span> <i class="far fa-clock mr-1"></i> {{ moment(item.created_at, "YYYY-MM-DD HH:mm:ss").add(8, 'hours').fromNow() }} </span>
												</div>
											</div>
										</div>
									</RouterLink>
									<div class="dropdown-divider"></div>
								</div>
							</div>

							<div class="dropdown-divider"></div>
							<a href="#" @click="clearNotiff()" class="dropdown-item dropdown-footer">Mark all as read</a>
						</div>
					</li>

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
						<a href="#" class="nav-link active" @click="logout()">
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
import moment from 'moment';

export default {
	props: ["is_auth"],
	data() {
		return {
			user: {},
			cartNumber: 0,
			notifications: [],
			number_of_notifications: 0,
			total_unseen_notifications: 0,
		};
	},
	methods: {
		// logout() {
		//   axios.post("/logout").then((res) => {
		//     window.location.href = "/login";
		//   });
		// },
		clearNotiff(){
			console.log('test')
			axios.get(`/clearCustomerNotifications`).then((res)=>{
				console.log(res.data)
				this.getUserNotifications()
				toastr.info('Notifications Cleared')
			})
		},
		getCurrentAuth() {
			axios.get("/me").then((res) => {
				this.user = res.data;
				this.getUserNotifications();
				this.listen_notification_pusher();
			});
		},

		listen_notification_pusher() {
			var pusher = new Pusher("8bfb7f6648a195296a7f", {
				cluster: "ap1",
			});

			var self = this;

			var CHANNEL_NAME = `palex-notification-channel-${this.user.id}`;

			var palex_notification_channel = pusher.subscribe(CHANNEL_NAME);
			palex_notification_channel.bind("palex-notification-event", function (data) {
				console.warn(data);
				self.set_new_notification(data);
			});
		},

		set_new_notification(data) {
			this.notifications.unshift(data.notification_data);
			this.number_of_notifications = data.total_notifications;
			this.total_unseen_notifications = data.total_unseen_notifications;

			if (data.notification_data.type == "order") {
				this.$notify({
					title: data.notification_data.title,
					dangerouslyUseHTMLString: true,
					message: `<span style="color: #2c9144;">${data.notification_data.body}</span>`,
				});
			} else {
				console.log('other notif')
				this.$notify({
					title: data.notification_data.title,
					dangerouslyUseHTMLString: true,
					message: `<span style="color: #2c9144;">${data.notification_data.body}</span>`,
				});
			}
		},

		getUserNotifications() {
			axios.get(`/get_user_notifications`).then((res) => {
				// console.log(res.data);
				this.notifications = res.data.notifications;
				this.number_of_notifications = res.data.total_notifications;
				this.total_unseen_notifications = res.data.total_unseen_notifications;
			});
		},

		getMoment(datetime) {
			// var a = moment(datetime);
			return moment(datetime).utcOffset(420).fromNow();
		},

		logout() {
			this.$confirm("Are you sure you want to log out?", "Warning", {
				confirmButtonText: "YES",
				cancelButtonText: "NO",
				type: "warning",
			})
				.then(() => {
					axios.post("/logout").then((res) => {
						window.location.href = "/login";
					});
				})
				.catch(() => {});
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
	created(){
 		this.moment = moment;
	},
	// beforeRouteLeave(to, from, next) {

	// 	// if(this.user.role == '2') {

	// 	// }

	// 	// console.log({ from });
	// 	// console.log({ to });
	// 	// // console.log({ next });
	// },
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


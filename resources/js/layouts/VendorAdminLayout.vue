<style lang="scss" scoped>
.plx-img-icon {
	cursor: pointer;
}

.plx-notif-title {
	cursor: pointer;
}

.plx-notif-body {
	cursor: pointer;
}
.plx-notif-date-time {
	cursor: pointer;
}
</style>


<template>
	<div>
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-dark">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="index3.html" class="nav-link">Home</a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Notifications Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge">{{ number_of_notifications }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-item dropdown-header">{{ number_of_notifications }} Notifications</span>
						<div class="dropdown-divider"></div>

						<!-- Loop Here -->

						<div v-for="(item, index) in notifications" :key="index">
							<RouterLink :to="item.link_end_point" class="dropdown-item" style="white-space: normal">
								<div class="d-flex">
									<div class="plx-img-icon p-1">
										<img :src="item.image_link" alt="icn" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover" />
										<hr />
									</div>
									<div class="p-1">
										<div class="plx-notif-title" style="font-weight: bold">
											{{ item.title }}
										</div>
										<div v-html="item.body" class="plx-notif-body"></div>
										<div class="plx-notif-date-time">
											<span> <i class="far fa-clock mr-1"></i> {{ getMoment(item.created_at) }} </span>
										</div>
									</div>
								</div>
							</RouterLink>
							<div class="dropdown-divider"></div>
						</div>

						<!-- <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a> -->

						<!--  -->
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
					</div>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="index3.html" class="brand-link">
				<img
					src="https://i.pinimg.com/originals/ad/ca/08/adca082427894069f92dd11fda3d96cb.gif"
					alt="AdminLTE Logo"
					class="brand-image img-circle elevation-3"
					style="opacity: 0.8"
				/>
				<span class="brand-text font-weight-light">PalEx</span>
			</a>
			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img
							src="https://png.pngtree.com/png-clipart/20190924/original/pngtree-user-vector-avatar-png-image_4830521.jpg"
							class="img-circle elevation-2"
							alt="User Image"
						/>
					</div>
					<div class="info">
						<a href="#" class="d-block">{{ user.name }}</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						<li class="nav-item">
							<router-link to="/vendor" class="nav-link" :class="$route.path == '/vendor' ? 'active' : ''">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Dashboard</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/vendor/products" class="nav-link" :class="$route.path == '/vendor/products' ? 'active' : ''">
								<i class="nav-icon fas fa-boxes"></i>
								<p>Products</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/vendor/orders" class="nav-link" :class="$route.path == '/vendor/orders' ? 'active' : ''">
								<i class="nav-icon fas fa-file-invoice"></i>
								<p>Orders</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/vendor/chat" class="nav-link" :class="$route.name == 'ven-chat' || $route.name == 'ven-chat-id' ? 'active' : ''">
								<i class="nav-icon fas fa-comments"></i>
								<p>Chat</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/vendor/settings" class="nav-link" :class="$route.name == 'vendor-settings' ? 'active' : ''">
								<i class="nav-icon fas fa-cog"></i>
								<p>Settings</p>
							</router-link>
						</li>
						<li class="nav-item">
							<a @click="logout" class="nav-link" onclick="">
								<i class="nav-icon fas fa-times"></i>
								<p>Log out</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<router-view :is_auth="is_auth" />
		<router-view :is_auth="is_auth" :user="this.user" :vendorAddress="this.vendorAddress" name="helper" />

		<!-- Main Footer -->
		<footer class="main-footer">
			<strong>Copyright &copy; 2021 <a href="https://adminlte.io">PalEX.com</a>.</strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block"><b>Version</b> 1.0.0</div>
		</footer>
	</div>
</template>

<script>
export default {
	props: ["is_auth"],
	data() {
		return {
			user: {},
			vendorAddress: [],
			notifications: [],
			number_of_notifications: 0,
			total_unseen_notifications: 0,
		};
	},
	methods: {
		getMoment(datetime) {
			var a = moment(datetime);
			return moment(a).fromNow();
		},

		getCurrentAuth() {
			axios.get("/me").then((res) => {
				this.user = res.data;
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
			this.total_notifications = data.total_notifications;
			this.total_unseen_notifications = data.total_unseen_notifications;

			if (data.notification_data.type == "order") {
				this.$notify({
					title: data.notification_data.title,
					dangerouslyUseHTMLString: true,
					message: `<span style="color: #2c9144;">${data.notification_data.body}</span>`,
				});
			}
		},

		getCurrentVendorDetails(id) {
			axios.get(`/me/vendor`).then((res) => {
				// console.log(res.data);
				this.vendorAddress = res.data;
			});
		},

		getVendorNotifications() {
			axios.get(`/get_user_notifications`).then((res) => {
				// console.log(res.data);
				this.notifications = res.data.notifications;
				this.number_of_notifications = res.data.total_notifications;
				this.total_unseen_notifications = res.data.total_unseen_notifications;
			});
		},

		logout() {
			axios.post("/logout").then((res) => {
				window.location.href = "/login";
			});
		},
	},
	mounted() {
		this.getCurrentAuth();
		this.getCurrentVendorDetails();
		this.getVendorNotifications();
	},
};
</script>

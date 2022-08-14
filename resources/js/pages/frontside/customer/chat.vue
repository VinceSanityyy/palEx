<template>
	<div class="container" :class="WindowInnerWidth > 767 ? 'mt-1' : 'mt-1'">
		<!-- <div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="palex-card">
						<div class="px-2" style="font-weight: bold; font-size: 24px"><i class="far fa-comments mr-2"></i>Chat Box</div>
					</div>
				</div>
			</div>
		</div> -->

		<div v-if="chatList.length <= 0" class="container palex-checkout-page">
			<div class="row">
				<div class="col-md-12">
					<div class="palex-card">
						<div style="display: flex; justify-content: center; align-items: center; height: 450px">
							<div class="text-center">
								<h3>No Chat/Conversation Available</h3>
								<h6 class="text-warning">To Start Chat, Just Visit Store Profile and Click/Tap Chat Button</h6>
								<div>
									<el-button type="success" plain @click="backToProducts()">Continue Shopping</el-button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <h3 class="text-center">Messaging</h3> -->
		<div v-else class="messaging">
			<div class="inbox_msg">
				<div class="inbox_people" :style="WindowInnerWidth > 540 ? '' : 'width:15%!important;'">
					<div v-if="WindowInnerWidth > 540" class="headind_srch">
						<div class="recent_heading">
							<h4>Messages</h4>
						</div>
						<!-- <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar" placeholder="Search" />
                <span class="input-group-addon">
                  <button type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
              </div>
            </div> -->
					</div>
					<!-- <div class="inbox_chat" :style="WindowInnerWidth > 540 ? '' : 'text-align:center !important;'"> -->
					<div class="inbox_chat" :style="cssVars">
						<div
							v-for="(item, index) in chatList"
							:key="index"
							class="chat_list"
							:class="item.id == conversation.id ? 'active_chat' : ''"
							:style="WindowInnerWidth > 768 ? '' : 'padding:5px !important;'"
							@click="showConversation(item)"
						>
							<div class="chat_people">
								<div class="chat_img" :style="WindowInnerWidth > 540 ? '' : 'float: none  !important; width: 100%  !important;'">
									<img
										:src="item.user_image_link"
										alt="sunil"
										:style="
											WindowInnerWidth > 540 ? '' : 'width:35px !important; max-width:35px !important; height:35px !important; max-height:35px !important; '
										"
									/>
									<div v-if="WindowInnerWidth < 541" style="font-size: 8px; overflow-x: hidden">
										{{ getLimitedUserName(item.user_name) }}
									</div>
								</div>
								<div class="chat_ib" v-if="WindowInnerWidth > 540">
									<h5>
										{{ item.user_name }} <span class="chat_date">{{ item.date }}</span>
									</h5>
									<p>
										<span v-if="item.last_reply">{{ item.last_reply }}</span>
										<span v-else>&nbsp;</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- style="text-overflow: ellipsis; overflow: hidden" -->
				<div class="mesgs" :style="WindowInnerWidth > 540 ? '' : 'width:85%!important;'">
					<div class="m-0 p-1 border-bottom border-secondary mb-1">
						<span>
							<img
								:src="conversation.header_user_image_link"
								alt="sunil"
								:style="'width:35px !important; max-width:35px !important; height:35px !important; max-height:35px !important; object-fit: cover; object-fit: cover; border-radius: 50%;'"
							/>
						</span>
						<span>
							<span class="ml-3" style="font-size: 20px !important"
								><b>{{ conversation.header_user_name }}</b></span
							>
							<!-- <br>
                <span>{{conversation.header_user_email}}</span> -->
						</span>
					</div>
					<div class="msg_history" :style="cssVars" v-chat-scroll>
						<div v-for="(item, index) in replies" :key="index">
							<div v-if="item.position == 'left'" class="incoming_msg">
								<div class="incoming_msg_img">
									<!-- <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil" /> -->
									<img :src="conversation.header_user_image_link" alt="sunil" style="object-fit: cover; border-radius: 50%" />
								</div>
								<div class="received_msg">
									<div class="received_withd_msg">
										<p>{{ item.reply }}</p>
										<!-- <span class="time_date"> 11:01 AM | June 9</span> -->
										<span class="time_date">{{ item.created_at }}</span>
									</div>
								</div>
							</div>
							<div v-else class="outgoing_msg">
								<div class="sent_msg">
									<p>{{ item.reply }}</p>
									<!-- <span class="time_date"> 11:01 AM | June 9</span> -->
									<span class="time_date">{{ item.created_at }}</span>
								</div>
							</div>
						</div>
					</div>
					<div class="type_msg">
						<div class="input_msg_write">
							<input @keyup.enter="chat()" v-model="msg" type="text" class="write_msg" placeholder="Type a message" :disabled="this.is_sending" />
							<button @click="chat()" class="msg_send_btn" type="button">
								<i v-if="!this.is_sending" class="fab fa-telegram-plane"></i>
								<i v-if="this.is_sending" class="fas fa-spinner ld ld-cycle"></i>
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- <p class="text-center top_spac">Design by <a target="_blank" href="https://www.linkedin.com/in/sunil-rajput-nattho-singh/">Sunil Rajput</a></p> -->
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			user_info: {},
			WindowInnerWidth: null,
			WindowInnerHeight: null,
			//   chatList: [
			//     {
			//       is_active: true,
			//       user_name: "Ronald Vincent Bustillo",
			//       msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
			//       date: "Jun 20",
			//     },
			//   ],
			chatList: [],
			conversation: {},
			replies: [],
			conversation_id: null,
			msg: null,
			//   header_user_id: null,
			//   header_user_name: null,
			//   header_user_email: null,
			//   header_user_image_link: null,
			is_sending: false,
		};
	},
	computed: {
		cssVars() {
			return {
				"--palex-width": this.WindowInnerWidth + "px",
				"--palex-height": this.WindowInnerHeight - 140 + "px",
				"--palex-height-2": this.WindowInnerHeight - 260 + "px",
			};
		},
	},
	created() {
		if (this.$route.params.conversation_id) {
			this.conversation_id = this.$route.params.conversation_id;
		}
		this.$events.fire("LoadingOverlayShow");
		this.WindowInnerWidth = window.innerWidth;
		this.WindowInnerHeight = window.innerHeight;
		window.addEventListener("resize", this.myEventHandler);

		this.getUserChatList();
		// this.getConversationReplies();
	},
	mounted() {
		// Enable pusher logging - don't include this in production
		var isEmptyOrSpaces = palex_js_global.isEmptyOrSpaces("asdasd");
		// console.warn({isEmptyOrSpaces});

		this.chatGetUserInfo();
		var self = this;
		Pusher.logToConsole = true;
		var pusher = new Pusher("8bfb7f6648a195296a7f", {
			cluster: "ap1",
		});
		var channel = pusher.subscribe("palex-channel");
		channel.bind("palex-pusher-event", function (data) {
			// console.warn(data);
			self.receive_PalexPusherEvent(data);
		});
	},
	destroyed() {
		window.removeEventListener("resize", this.myEventHandler);
	},
	methods: {
		getLimitedUserName(user_name) {
			if (user_name) {
				var substr = user_name.substr(0, 8);
				// var substr = "WW WW WW";
				return substr + "..";
			}
			return "";
		},

		receive_PalexPusherEvent(data) {
			var message = data.message;
			// console.warn(message);
			// console.log(this.user_info);
			// console.error(message.conversation_id);
			// console.error(this.conversation_id);
			// console.error(message.user_id_to);
			// console.error(this.user_info.id);

			if (message.conversation_id == this.conversation_id && message.user_id_to == this.user_info.id) {
				// console.log("UPDATE CONVERSATION REPLY");
				this.getConversationReplies(this.conversation_id);
			}

			if (message.user_id_to == this.user_info.id) {
				// console.log("UPDATE CHAT LIST");
				this.justUpdateUserChatList();
			}
			// alert(message.reply);
		},
		chatGetUserInfo() {
			axios
				.get(`/chatGetUserInfo`)
				.then((res) => {
					// console.log(res);
					this.user_info = res.data;
				})
				.catch((err) => {
					console.error(err);
					this.$events.fire("LoadingOverlayHide");
				});
		},
		myEventHandler(e) {
			this.WindowInnerWidth = window.innerWidth;
			this.WindowInnerHeight = window.innerHeight;
			//   console.log(this.WindowInnerWidth);
			//   console.log(this.WindowInnerHeight);
		},
		chat() {
			if (palex_js_global.isEmptyOrSpaces(this.msg)) return;

			if (this.is_sending) return;

			this.is_sending = true;
			
			var params = {
				msg: this.msg,
				user_id: this.conversation.header_user_id,
			};
			axios
				.post(`/sendMessage`, params)
				.then((res) => {
					// console.log(res);
					this.is_sending = false;
					this.msg = "";
					//   this.getConversationReplies(this.conversation.id);
					this.getUserChatList();
					toastr.success("Message Sent");
				})
				.catch((err) => {
					this.is_sending = false;
					console.error(err);
				});
		},
		backToProducts() {
			this.$router.push("/products");
		},
		getUserChatList() {
			axios
				.get(`/getUserChatList`)
				.then((res) => {
					// console.log(res);
					this.chatList = res.data;
					if (this.conversation_id) {
						this.getConversationReplies(this.conversation_id);
					} else {
						if (this.chatList.length > 0) {
							this.getConversationReplies(this.chatList[0].id);
						} else {
							this.$events.fire("LoadingOverlayHide");
						}
					}
				})
				.catch((err) => {
					console.error(err);
					this.$events.fire("LoadingOverlayHide");
				});
		},
		justUpdateUserChatList() {
			axios
				.get(`/getUserChatList`)
				.then((res) => {
					this.chatList = res.data;
				})
				.catch((err) => {
					console.error(err);
					this.$events.fire("LoadingOverlayHide");
				});
		},

		getConversationReplies(conversation_id) {
			this.conversation_id = conversation_id;
			axios
				.get(`/getConversationReplies/${conversation_id}`)
				.then((res) => {
					// console.log(res);
					this.conversation = res.data.conversation;
					this.replies = res.data.replies;
					this.$events.fire("LoadingOverlayHide");
				})
				.catch((err) => {
					console.error(err);
					this.$events.fire("LoadingOverlayHide");
				});
		},
		showConversation(item) {
			this.$events.fire("LoadingOverlayShow");
			window.location.href = `/customer/chat/${item.id}`;
		},
	},
};
</script>

<style lang="scss" scoped>
@import "resources/sass/mixins.scss";
.chat_ib p {
	font-size: 14px;
	color: #989898;
	margin: auto;
	white-space: nowrap !important;
	text-overflow: ellipsis !important;
	overflow: hidden !important;
}
</style>

<style lang="scss" scoped>
@import "resources/sass/mixins.scss";
.container {
	max-width: 1170px;
	margin: auto;
}
img {
	max-width: 100%;
}
.inbox_people {
	background: #f8f8f8 none repeat scroll 0 0;
	float: left;
	overflow: hidden;
	width: 40%;
	border-right: 1px solid #c4c4c4;
}
.inbox_msg {
	border: 1px solid #c4c4c4;
	clear: both;
	overflow: hidden;
}
.top_spac {
	margin: 20px 0 0;
}

.recent_heading {
	float: left;
	width: 40%;
}
.srch_bar {
	display: inline-block;
	text-align: right;
	width: 60%;
}
.headind_srch {
	padding: 10px 29px 10px 20px;
	overflow: hidden;
	border-bottom: 1px solid #c4c4c4;
}

.recent_heading h4 {
	color: #05728f;
	font-size: 21px;
	margin: auto;
}
.srch_bar input {
	border: 1px solid #cdcdcd;
	border-width: 0 0 1px 0;
	width: 80%;
	padding: 2px 0 4px 6px;
	background: none;
}
.srch_bar .input-group-addon button {
	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
	border: medium none;
	padding: 0;
	color: #707070;
	font-size: 18px;
}
.srch_bar .input-group-addon {
	margin: 0 0 0 -27px;
}

.chat_ib h5 {
	font-size: 15px;
	color: #464646;
	margin: 0 0 8px 0;
}
.chat_ib h5 span {
	font-size: 13px;
	float: right;
}
.chat_ib p {
	font-size: 14px;
	color: #989898;
	margin: auto;
}
.chat_img {
	float: left;
	width: 11%;
	img {
		object-fit: cover;
		border-radius: 50%;
	}
}
.chat_ib {
	float: left;
	padding: 0 0 0 15px;
	width: 88%;
}

.chat_people {
	overflow: hidden;
	clear: both;
}
.chat_list {
	border-bottom: 1px solid #c4c4c4;
	margin: 0;
	padding: 18px 16px 10px;
}
.inbox_chat {
	//   height: 550px;
	height: var(--palex-height);
	overflow-y: scroll;
	@include mobile {
		text-align: center !important;
		height: var(--palex-height);
	}
}

.active_chat {
	background: #ebebeb;
}

.incoming_msg_img {
	display: inline-block;
	width: 6%;
}
.received_msg {
	display: inline-block;
	padding: 0 0 0 10px;
	vertical-align: top;
	width: 92%;
}
.received_withd_msg p {
	background: #ebebeb none repeat scroll 0 0;
	border-radius: 3px;
	color: #646464;
	font-size: 14px;
	margin: 0;
	padding: 5px 10px 5px 12px;
	width: 100%;
}
.time_date {
	color: #747474;
	display: block;
	font-size: 12px;
	margin: 8px 0 0;
}
.received_withd_msg {
	width: 57%;
	@include mobile {
		width: 80% !important;
	}
}
.mesgs {
	float: left;
	//   padding: 30px 15px 0 25px;
	padding: 10px 10px 0 10px;
	width: 60%;
}

.sent_msg p {
	background: #05728f none repeat scroll 0 0;
	border-radius: 3px;
	font-size: 14px;
	margin: 0;
	color: #fff;
	padding: 5px 10px 5px 12px;
	width: 100%;
}
.outgoing_msg {
	overflow: hidden;
	margin: 26px 0 26px;
}
.sent_msg {
	float: right;
	width: 46%;
	@include mobile {
		width: 85% !important;
	}
}
.input_msg_write input {
	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
	border: medium none;
	color: #4c4c4c;
	font-size: 15px;
	min-height: 48px;
	width: 100%;
}

.type_msg {
	border-top: 1px solid #c4c4c4;
	position: relative;
}
.msg_send_btn {
	background: #05728f none repeat scroll 0 0;
	border: medium none;
	border-radius: 50%;
	color: #fff;
	cursor: pointer;
	font-size: 17px;
	height: 33px;
	position: absolute;
	right: 0;
	top: 11px;
	width: 33px;
}
.messaging {
	padding: 0 0 50px 0;
}
.msg_history {
	//   height: 516px;
	height: var(--palex-height-2);
	overflow-y: auto;
	@include mobile {
		height: var(--palex-height-2);
	}
}
</style>

<style lang="scss" scoped>
// @import "resources/sass/mixins.scss";
// .palex-card {
//   background: white;
//   margin: 0.5rem;
//   padding: 0.5rem;
//   box-shadow: 4px 4px 4px 4px rgba(0, 174, 119, 0.5) !important;
// }
</style>

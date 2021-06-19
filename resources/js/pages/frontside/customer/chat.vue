<template>
  <div class="container mt-5">
    <!-- <h3 class="text-center">Messaging</h3> -->
    <div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people" :style="WindowInnerWidth > 540 ? '' : 'width:15%!important;'">
          <div v-if="WindowInnerWidth > 540" class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
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
          <div class="inbox_chat" :style="WindowInnerWidth > 540 ? '' : 'text-align:center !important;'">
            <div v-for="(item, index) in chatList" :key="index" class="chat_list" :class="item.is_active ? 'active_chat' : ''" :style="WindowInnerWidth > 768 ? '' : 'padding:5px !important;'">
              <div class="chat_people">
                <div class="chat_img" :style="WindowInnerWidth > 540 ? '' : 'float: none  !important; width: 100%  !important;'">
                  <img
                    src="https://ptetutorials.com/images/user-profile.png"
                    alt="sunil"
                    :style="WindowInnerWidth > 540 ? '' : 'width:35px !important; max-width:35px !important; height:35px !important; max-height:35px !important; '"
                  />
                </div>
                <div class="chat_ib" v-if="WindowInnerWidth > 540">
                  <h5>
                    {{ item.user_name }} <span class="chat_date">{{ item.date }}</span>
                  </h5>
                  <p>
                    {{ item.msg }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mesgs" :style="WindowInnerWidth > 540 ? '' : 'width:85%!important;'">
          <div class="msg_history">
            <div class="incoming_msg">
              <div class="incoming_msg_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="sunil" /></div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>Test which is a new approach to have all solutions</p>
                  <span class="time_date"> 11:01 AM | June 9</span>
                </div>
              </div>
            </div>
            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Test which is a new approach to have all solutions</p>
                <span class="time_date"> 11:01 AM | June 9</span>
              </div>
            </div>
            <div class="incoming_msg">
              <div class="incoming_msg_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="sunil" /></div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>Test, which is a new approach to have</p>
                  <span class="time_date"> 11:01 AM | Yesterday</span>
                </div>
              </div>
            </div>
            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Apollo University, Delhi, India Test</p>
                <span class="time_date"> 11:01 AM | Today</span>
              </div>
            </div>
            <div class="incoming_msg">
              <div class="incoming_msg_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="sunil" /></div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>We work directly with our designers and suppliers, and sell direct to you, which means quality, exclusive products, at a price anyone can afford.</p>
                  <span class="time_date"> 11:01 AM | Today</span>
                </div>
              </div>
            </div>
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a message" />
              <button class="msg_send_btn" type="button"><i class="fab fa-telegram-plane"></i></button>
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
      WindowInnerWidth: null,
      chatList: [
        {
          is_active: true,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
        {
          is_active: false,
          user_name: "Ronald Vincent Bustillo",
          msg: "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
          date: "Jun 20",
        },
      ],
    };
  },
  created() {
    this.WindowInnerWidth = window.innerWidth;
    window.addEventListener("resize", this.myEventHandler);
  },
  destroyed() {
    window.removeEventListener("resize", this.myEventHandler);
  },
  methods: {
    myEventHandler(e) {
      console.log(Window.innerWidth);
      this.WindowInnerWidth = window.innerWidth;
    },
  },
};
</script>

<style lang="scss" scoped>
.chat_ib p {
  font-size: 14px;
  color: #989898;
  margin: auto;
  white-space: nowrap !important;
  text-overflow: ellipsis !important;
  overflow: hidden !important;
}
</style>

<style scoped>
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
  height: 550px;
  overflow-y: scroll;
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
}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
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
  height: 516px;
  overflow-y: auto;
}
</style>

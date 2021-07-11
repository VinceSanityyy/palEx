<template>
  <Loading :active.sync="is_loading" :background-color="background_color" :can-cancel="false" :is-full-page="fullPage" :color="loading_color" :height="height" :width="width">
    <div class="w-100 text-center">
      <div>
        <img :src="logo_img_src_1" :class="logo_img_class_1" alt="Group Icon" :style="logo_style_1" />
      </div>
      <div>
        <img :src="logo_img_src_2" :class="logo_img_class_2" alt="Group LOGO" :style="logo_style_2" />
      </div>
    </div>
  </Loading>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  components: {
    Loading,
  },
  data() {
    return {
      is_loading: false,
      groupMsg: "",
      fullPage: true,
      height: 128,
      width: 128,
      loading_color: "#28a745",
    //   background_color: "#e1f6e5",
    //   background_color: "#1b5b27",
    //   background_color: "#08190d",
    //   background_color: "#08190d",
      background_color: "rgba(8, 25, 13, 0.9)",
    //   background_color: "#00ae77",
    //   background_color: "#86db96",
    //   background_color: "#de93cc",
    //   background_color: "#de93cc",
      //   loho_stle:'height: 200px; width: auto; border-radius: 50%',
      logo_style_1: "height: auto; width:25%; animation-duration:2.0s",
      logo_style_2: "height: auto; width:50%; animation-duration:10s",
      logo_img_src_1: "/img/logo/palex-whirl.png",
      logo_img_class_1: "ld ld-cycle",
      logo_img_src_2: "/img/logo/palex1.png",
     logo_img_class_2: "ld ld-rubber-h",
    //   logo_img_class_2: "",
    };
  },
  events: {
    LoadingOverlayShow() {
      this.is_loading = true;
    },
    LoadingOverlayHide() {
      this.is_loading = false;
    },
  },
};
</script>
<style lang="scss" scoped>
.logoImage {
  height: 50px;
}
.groupEmailand {
  font-size: 12px;
}

.footer {
  height: 30px;
  width: 100%;
  position: fixed;
  bottom: 0;
  .dcenter {
    img {
      height: auto;
      width: 130px;
    }
  }
  @media (max-width: 475px) {
    .dleft {
      font-size: 10px;
      padding-left: 2px !important;
    }
    .dcenter {
      font-size: 10px;
      img {
        height: auto;
        width: 90px;
      }
    }
    .dcopyright {
      font-size: 10px;
      padding-right: 2px !important;
    }
  }
}
</style>

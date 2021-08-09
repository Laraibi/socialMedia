<template>
  <el-timeline-item
    :timestamp="Message.date"
    placement="top"
    size="large"
    v-loading="loading"
    element-loading-text="Chargement..."
  >
    <template v-slot:dot>
      <el-avatar :src="senderImageUrl" ></el-avatar>
    </template>
    <el-card
      :class="senderName == 'you' ? 'bg-success' : 'bg-info'"
      class="success"
    >
      <h4>
        <strong> {{ senderName }}</strong>
      </h4>
      <p class="mx-5">{{ Message.body }}</p>
    </el-card>
  </el-timeline-item>
</template>
<script>
import axios from "axios";
let moment = require("moment");
export default {
  name: "message",
  props: {
    id: {
      type: Number,
      value: -1,
    },
  },
  data() {
    return {
      Message: {},
      loading: true,
    };
  },
  computed: {
    senderName() {
      return this.Message.senderId == window.Laravel.user.id
        ? "you"
        : this.Message.senderName;
    },
    senderImageUrl() {
      // console.log(this);
      if (this.Message.sender) {
        if (
          this.Message.sender.image_path == null ||
          this.Message.sender.image_path == ""
        ) {
          return "https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png";
        } else {
          return (
            window.location.origin +
            "/storage/user_images/" +
            this.Message.sender.image_path
          );
        }
      }
    },
  },
  methods: {
    load() {
      if (this.id !== -1) {
        axios.get("/api/messageDetails?id=" + this.id).then((res) => {
          this.Message = res.data;
          this.Message.date = moment(this.Message.date).format(
            "YYYY-MM-DD HH:mm:ss"
          );
          this.loading = false;
        });
      }
    },
  },
  watch: {
    id() {
      this.load();
    },
  },
  created() {
    this.load();
  },
};
</script>

<style>
.message {
  border-radius: 10px;
}
.bg-success {
  background-color: #67c23a !important;
  color: #dcdfe6;
}
.bg-info {
  background-color: #909399 !important;
  color: #dcdfe6;
}
.el-timeline-item__dot{
  top:-0.8rem;
  left:-0.8rem;
  z-index: 10000 !important;
}
.el-timeline-item__timestamp{
    margin-left: 0.8rem !important;
}
</style>
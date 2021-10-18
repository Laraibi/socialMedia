<template>
  <el-timeline-item
    :timestamp="sendedAt"
    placement="top"
    size="large"
  >
    <template v-slot:dot>
      <el-avatar :src="senderImageUrl"></el-avatar>
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
let moment = require("moment");
export default {
  name: "message",
  props: {
    Message: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  computed: {
    sendedAt(){
      return moment(this.Message.created_at).format('Y-M-D HH:mm')
    },
    senderName() {
      return this.Message.sender.id == window.Laravel.user.id
        ? "you"
        : this.Message.sender.name;
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
.el-timeline-item__dot {
  top: -0.8rem;
  left: -0.8rem;
  z-index: 10000 !important;
}
.el-timeline-item__timestamp {
  margin-left: 0.8rem !important;
}
</style>
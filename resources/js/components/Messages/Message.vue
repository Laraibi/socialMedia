<template>
    <el-timeline-item :timestamp="Message.date" placement="top"  v-loading="loading" element-loading-text="Chargement...">
      <el-card :class="senderName == 'you' ? 'bg-success' : 'bg-info'" class="success">
        <h4> <strong> {{ senderName }}</strong></h4>
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
      Message: {},loading:true
    };
  },
  computed: {
    senderName() {
      return this.Message.senderId == window.Laravel.user.id
        ? "you"
        : this.Message.senderName;
    },
  },
  methods: {
    load() {
      if (this.id !== -1) {
        // console.log(this.id)
        axios.get("/api/messageDetails?id=" + this.id).then((res) => {
          this.Message = res.data;
          this.Message.date = moment(this.Message.date).format(
            "YYYY-MM-DD HH:mm:ss"
          );
          this.loading=false
          // console.log
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
.bg-success{
  background-color: #67C23A !important;
  color :#DCDFE6;
}
.bg-info{
  background-color: #909399 !important;
  color :#DCDFE6;
}
</style>
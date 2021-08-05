<template>
  <div class="row m-1 p-2 message" :class="senderName == 'you' ? 'bg-success' : 'bg-info'" >
    <div class="col-3">
      <div class="row text-center justify-content-center">
        {{ senderName }}
      </div>
      <div class="row text-center justify-content-center">
        {{ Message.date }}
      </div>
    </div>
    <div class="col-9 h-100">
      <span class="align-middle">
        {{ Message.body }}
      </span>
    </div>
  </div>
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
  background-color: #7DCFB6 !important;
}
.bg-info{
  background-color: #279FB9 !important;
}
</style>
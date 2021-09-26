<template>
  <div class="row m-2"   >
      <div class="col--md-9 col-sm-12">
        <el-input
          type="textarea"
          :rows="2"
          placeholder="Nouveau Messaget"
          v-model="messageBody"
          @keyup.enter="send"
        >
        </el-input>
      </div>
      <div class="col-md-3 col-sm-12">
        <el-button type="success" class="h-100 w-100 " @click="send">Envoyer<i class="el-icon-upload2 el-icon-right"></i></el-button>
      </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "sentMessage",
  props: {
    receiverId: {
      type: Number,
      value: -1,
    },
  },
  data() {
    return { messageBody: "" };
  },
  methods: {
    send() {
      if (this.receiverId != -1) {
        axios
          .post("/api/sendMessage", {
            receiver_id: this.receiverId,
            body: this.messageBody,
          })
          .then((res) => {
            this.messageBody=''
            this.$emit('pushMsg',res.data);
          });
      }
    },
  },
};
</script>

<style>
textarea {
  resize: none !important;
}
</style>
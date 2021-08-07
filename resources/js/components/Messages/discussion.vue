<template>
  <sent-message :receiverId="id"></sent-message>
  <!-- <div class="my-2" id="disscussion"> -->
  <el-timeline id="disscussion" class="my-2"  v-loading="loading">
    <message v-for="(msg, key) in Messages" :key="key" :id="msg.id"></message>
  </el-timeline>
  <!-- </div> -->
</template>

<script>
import axios from "axios";
import Message from "./Message.vue";

import sentMessage from "./sentMessage.vue";
export default {
  name: "discussion",
  props: {
    id: {
      type: Number,
      value: -1,
    },
  },
  components: {
    Message,
    sentMessage,
  },
  data() {
    return {
      Messages: [],loading:true,
    };
  },
  watch: {
    id() {
      this.load();
    },
  },
  methods: {
    load() {
      this.Messages = [];
        this.loading=true
      if (this.id != -1) {
        axios
          .get("/api/getDisscussion?withUserId=" + this.id)
          .then((res) => {
            this.Messages = res.data
            this.loading=false
            });
      }
    },
  },
  created() {
    this.load();
  },
};
</script>

<style>
#disscussion {
  overflow-y: scroll;
  height: 30rem;
  padding: 10px;
}
</style>
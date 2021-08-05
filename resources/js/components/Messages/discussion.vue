<template>
  <sent-message :receiverId="id"></sent-message>
  <div class="my-2" id="disscussion">
    <message v-for="(msg, key) in Messages" :key="key" :id="msg.id"></message>
  </div>
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
      Messages: [],
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
      if (this.id != -1) {
        axios
          .get("/api/getDisscussion?withUserId=" + this.id)
          .then((res) => (this.Messages = res.data));
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
}
</style>
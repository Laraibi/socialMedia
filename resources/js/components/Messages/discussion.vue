<template>
  <table class="table">
    <thead>
      <tr>
        <th>Sender</th>
        <th>Receiver</th>
        <th>DateTime</th>
        <th>Body</th>
      </tr>
    </thead>
    <tbody>
      <message v-for="(msg, key) in Messages" :key="key" :id="msg.id"></message>
    </tbody>
  </table>
</template>

<script>
import axios from "axios";
import Message from "./Message.vue";
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
      if (this.id != -1) {
        axios
          .get("/api/getDisscussion?withUserId=" + this.id)
          .then((res) => (this.Messages = res.data));
        // .then((res) => (console.log(res.data)))
        // .then((res) => console.log(res))
        // .catch((e) => console.log(e));
      }
    },
  },
  created() {
    this.load();
  },
};
</script>

<style>
</style>
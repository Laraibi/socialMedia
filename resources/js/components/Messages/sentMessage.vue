<template>
  <div class="row">
    <div class="row">
      <div class="col-10">
        <textarea
          placeholder="Nouveau Message"
          class="form-control"
          id="body"
          v-model="messageBody"
        ></textarea>
      </div>
      <div class="col-2">
        <button class="btn btn-primary h-100 w-100" @click="send">Send</button>
      </div>
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
  created() {
    // axios.get("/api/users").then((res) => (this.usersList = res.data));
    // axios.get("/api/users").then((res) => (console.log(res.data)));
  },
  methods: {
    send() {
      if (this.receiverId != -1) {
        axios
          .post("/api/sendMessage", {
            receiver_id: this.receiverId,
            body: this.messageBody,
          })
          .then((res) => console.log(res.data));
      }
    },
  },
};
</script>

<style>
.btn-primary{
  background-color: #7DCFB6;
  border:#7DCFB6 !important;
}
</style>
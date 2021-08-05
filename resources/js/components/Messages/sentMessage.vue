<template>
  <div class="row">
    <h2>Nouveau Message</h2>
    <div class="row">
      <div class="col-12">
        <label for="userName">To : </label>
        <select id="userName" class="form-select" v-model="receiverId">
          <option v-for="(user, key) in usersList" :key="key" :value="user.id">
            {{ user.name + "(" + user.email + ")" }}
          </option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <label for="body">Body : </label>
        <textarea
          class="form-control"
          id="body"
          v-model="messageBody"
          rows="5"
        ></textarea>
      </div>
    </div>
    <div class="row justofy-content-center">
      <div class="col-4">
        <button class="btn btn-primary" @click="send">Send</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "sentMessage",
  data() {
    return { usersList: [], receiverId: -1, messageBody: "" };
  },
  created() {
    axios.get("/api/users").then((res) => (this.usersList = res.data));
    // axios.get("/api/users").then((res) => (console.log(res.data)));
  },
  methods: {
    send() {
    //   alert(this.receiverId);
    axios.post('/api/sendMessage',{'receiver_id':this.receiverId,'body':this.messageBody}).then((res)=>console.log(res.data));
    },
  },
};
</script>

<style>
</style>
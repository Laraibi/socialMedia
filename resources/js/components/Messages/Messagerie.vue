<template>
  <div class="row">
    <div class="col-2">
      <ul class="p-0 m-0" v-if="userMessages.length > 0">
        <li class="nav-item" v-for="(user, key) in discusionsUsers" :key="key">
          
          <router-link
          
            class="nav-link disscussionITems"
            :to="{ name: 'discussion', params: { id: user.id } }"
            >{{ user.name }}</router-link
          >
        </li>
      </ul>
    </div>
    <div id="disscusion" class="col-10">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Message from "./Message.vue";
export default {
  name: "Messagerie",
  components: {
    Message,
  },
  data() {
    return {
      userMessages: [],
    };
  },
  computed: {
    discusionsUsers() {
      let arr = [];
      this.userMessages.forEach((item) => {
        if (
          arr.every((user) => user.id !== item.receiver_id) &&
          item.receiver_id !== window.Laravel.user.id
        ) {
          arr.push(item.receiver);
        }
        if (
          arr.every((user) => user.id !== item.sender_id) &&
          item.sender_id !== window.Laravel.user.id
        ) {
          arr.push(item.sender);
        }
      });
      return arr;
    },
  },
  created() {
    console.log(this.$router.getRoutes());
    axios.get("/api/messages").then((res) => (this.userMessages = res.data));
  },
};
</script>

<style>
ul {
  list-style: none;
}
.disscussionITems {
  background-color: #279fb9 !important  ;
  margin :2px 0 !important;
  color:thistle;
  text-align: center;
}
.disscussionITems:hover,.router-link-active  {
  opacity: 0.7;
  /* background-color: #279fb9 !important  ; */
  /* margin :2px 0 !important;
  color:thistle; */
}
</style>
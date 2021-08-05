<template>
  <div class="row">
    <div class="col-6">
      <ul class="" v-if="userMessages.length > 0">
        <li class="nav-item" v-for="(user, key) in discusionsUsers" :key="key">
          <router-link
            class="nav-link"
            :to="{ name: 'discussion', params: { id: user.id } }"
            >{{ user.name }}</router-link
          >
        </li>
      </ul>
      <div>
        <router-view></router-view>
      </div>
    </div>
    <div class="col-6">
      <sent-message></sent-message>
    </div>

    <!-- {{ discusionsUsers }} -->
  </div>
</template>

<script>
import axios from "axios";
import Message from "./Message.vue";
import sentMessage from "./sentMessage.vue";
// import discussion from "./discussion.vue";
// import listDiscussion from "./listDiscussion.vue";
export default {
  name: "Messagerie",
  components: {
    Message,
    sentMessage,
  },
  data() {
    return {
      userMessages: [],
    };
  },
  computed: {
    discusionsUsers() {
      //   console.log(window.Laravel.user.id);
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
ul{
    list-style: none;
}
</style>
<template>
  <div class="row">
    <div class="col-3">
      <ul class="p-0 m-0" v-if="userMessages.length > 0">
        <li class="nav-item">
          <el-select-v2
            v-model="newDisscussionSelectedUsers"
            filterable
            :options="selectOptions"
            placeholder="Nouvelle Discussion"
            @change="addDisscussion"
            class="w-100"
          />
        </li>
        <li class="nav-item" v-for="(user, key) in discusionsUsers" :key="key">
          <router-link
            class="nav-link disscussionITems"
            :to="{ name: 'discussion', params: { id: user.id } }"
            >{{ user.name }}</router-link
          >
        </li>
      </ul>
    </div>
    <div id="disscusion" class="col-9">
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
      registredUsers: [],
      newDisscussionSelectedUsers: [],
    };
  },
  computed: {
    selectOptions() {
      return this.registredUsers
        .filter((user) =>
          this.discusionsUsers.every((user2) => user.id != user2.id)
        )
        .map((user) => ({
          value: user.id,
          label: user.name,
        }));
    },
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
    this.loadMessages();
    this.loadRegistredUsers();
  },
  methods: {
    loadMessages() {
      axios.get("/api/messages").then((res) => (this.userMessages = res.data));
    },
    loadRegistredUsers() {
      axios.get("/api/users").then((res) => (this.registredUsers = res.data));
    },
    addDisscussion() {
      this.userMessages.push({
        sender_id: window.Laravel.user.id,
        receiver_id: this.newDisscussionSelectedUsers,
        sender: {
          id: window.Laravel.user.id,
          name: window.Laravel.user.name,
        },
        receiver: {
          id: this.newDisscussionSelectedUsers,
          name: this.registredUsers.filter(
            (user) => user.id == this.newDisscussionSelectedUsers
          )[0].name,
        },
      });
      this.$router.push({
        name: "discussion",
        params: { id: this.newDisscussionSelectedUsers },
      });
      this.newDisscussionSelectedUsers = [];
    },
  },
};
</script>

<style>
ul {
  list-style: none;
}
.disscussionITems,el-select-v2 {
  background-color: #279fb9 !important  ;
  margin: 2px 0 !important;
  color: thistle;
  text-align: center;
}
.disscussionITems:hover,
.router-link-active {
  opacity: 0.7;
  /* background-color: #279fb9 !important  ; */
  /* margin :2px 0 !important;
  color:thistle; */
}
</style>
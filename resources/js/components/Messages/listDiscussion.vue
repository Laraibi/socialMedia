<template>
  <div>
    <ul>
      <!-- <li v-for="(user, key) in listUsers" :key="key">{{ user.name }}</li> -->
      <li v-for="(user, key) in listUsers" :key="key">
          <router-link :to="{ name: '/Messagerie/discussion/:with', params: { with:  user.id  }}">{{user.name}}</router-link>
      </li>
    </ul>
    <div>
        <router-view></router-view>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "listDiscussion",
  props: {
    listUsersID: {
      type: Array,
      value: [],
    },
  },
  data() {
    return {
      listUsers: [],
    };
  },
  watch: {
    listUsersID() {
      this.load();
    },
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      this.listUsers = [];
      this.listUsersID.forEach((id) => {
        axios
          .get("/api/getUser?user_id=" + id)
          .then((res) => this.listUsers.push(res.data));
      });
    },
  },
};
</script>

<style>
</style>
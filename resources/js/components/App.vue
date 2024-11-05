<template>
  <el-menu
    :router="true"
    :default-active="'/home'"
    v-if="isLoggedIn"
    class="el-menu-demo mb-3 sticky-top"
    mode="horizontal"
    background-color="#545c64"
    text-color="#fff"
    active-text-color="#ffd04b"
  >
    <el-menu-item index="/home"> Home </el-menu-item>
    <el-menu-item index="/profile">Profile</el-menu-item>
    <el-menu-item index="/Messagerie"> Messagerie </el-menu-item>
    <el-menu-item @click="logout" index="">Logout</el-menu-item>
  </el-menu>
  <el-menu
    :router="true"
    v-else
    :default-active="'/'"
    class="el-menu-demo mb-3 sticky-top"
    mode="horizontal"
    background-color="#545c64"
    text-color="#fff"
    active-text-color="#ffd04b"
  >
    <el-menu-item index="/">Login</el-menu-item>
    <el-menu-item index="/register"> Register</el-menu-item>
  </el-menu>
  <div class="row">
    <div class="container-lg container-fluid-sm">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      isLoggedIn: false,
      transitionName: "",
    };
  },
  created() {
    if (window.Laravel.isLoggedin) {
      this.isLoggedIn = true;
      // this.subscribeNewMessages();
    }
  },
  methods: {
    logout(e) {
      // e.preventDefault();
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/logout")
          .then((response) => {
            if (response.data.success) {
              window.location.href = "/";
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
    // subscribeNewMessages() {
    //   Echo.private("newMessage." + window.Laravel.user.id).listen(
    //     "newMessage",
    //     (e) => {          
    //       this.$notify({
    //         title: "Success",
    //         message: "New Message from " + e.Message.sender.name,
    //         type: "success",
    //         showClose: false,
    //       });
    //       state.newMessages.push(e.Message);
    //     }
    //   );
    // },
  },
};
</script>

<style>
.el-menu-demo {
  position: sticky !important;
}
.el-form-item__label {
  font-size: 14px !important;
  font-weight: bold;
  text-decoration: underline;
}
</style>
<template>
  <div class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav" v-if="isLoggedIn">
            <router-link to="/home" class="nav-item nav-link">Home</router-link>
            <router-link to="/profile" class="nav-link">Profile</router-link>
            <router-link to="/Messagerie" class="nav-link"
              >Messagerie</router-link
            >
            <a class="nav-item nav-link" style="cursor: pointer" @click="logout"
              >Logout</a
            >
          </div>
          <div class="navbar-nav" v-else>
            <router-link to="/" class="nav-item nav-link">login</router-link>
            <router-link to="/register" class="nav-item nav-link"
              >Register</router-link
            >
          </div>
        </div>
      </div>
    </nav>
    <div class="row">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      Message: "Books Management",
      isLoggedIn: false,
      transitionName: "",
    };
  },
  // watch: {
  //   '$route'(to, from) {
  //     const toDepth = to.path.split("/").length;
  //     const fromDepth = from.path.split("/").length;
  //     this.transitionName = toDepth < fromDepth ? "slide-right" : "slide-left";
  //   },
  // },
  created() {
    if (window.Laravel.isLoggedin) {
      this.isLoggedIn = true;
    }
  },
  methods: {
    logout(e) {
      e.preventDefault();
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/logout")
          .then((response) => {
            if (response.data.success) {
              window.location.href = "/";
            } else {
              console.log(response);
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>

<style>
</style>
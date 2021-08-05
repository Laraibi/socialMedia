<template>
  <div class="row justify-content-center">
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          <h6 class="card-title">Login</h6>
        </div>
      </div>
      <div class="card-body">
        <div class="row" v-if="error !== null">{{ error }}</div>
        <div class="row">
          <input
            type="text"
            placeholder="email"
            v-model="email"
            class="form-control"
          />
        </div>
        <div class="row">
          <input
            type="password"
            placeholder="password"
            v-model="password"
            class="form-control"
          />
        </div>
        <div class="row">
          <button class="btn btn-primary" @click="loginSubmit">login</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "login",
  data() {
    return {
      email: "",
      password: "",
      error: null,
    };
  },
  methods: {
    loginSubmit() {
      //   e.preventDefault();
      if (this.password.length > 0) {
        axios.get("/sanctum/csrf-cookie").then((response) => {
          axios
            .post("api/login", {
              email: this.email,
              password: this.password,
            })
            .then((response) => {
              console.log(response.data);
              if (response.data.success) {
                this.$router.go("/home");
              } else {
                this.error = response.data.message;
              }
            })
            .catch(function (error) {
              console.error(error);
            });
        });
      }
    },
  },
  beforeRouteEnter(to, from, next) {
    if (window.Laravel.isLoggedin) {
      return next("home");
    }
    next();
  },
};
</script>

<style>
</style>
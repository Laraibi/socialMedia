<template>
  <div class="row justify-content-center">
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Register</h4>
        </div>
        <div class="card-body">
          <div class="row" v-if="error !== null">
            {{ error }}
          </div>
          <div class="row">
            <input
              type="text"
              placeholder="Name"
              v-model="Name"
              class="form-control"
            />
          </div>
          <div class="row">
            <input
              type="text"
              placeholder="Email"
              v-model="Email"
              class="form-control"
            />
          </div>
          <div class="row">
            <input
              type="password"
              placeholder="Password"
              v-model="Password"
              class="form-control"
            />
          </div>
          <div class="row">
            <button class="btn btn-primary" @click="registerSubmit">
              Register
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "register",
  data() {
    return {
      Name: "",
      Email: "",
      Password: "",
      error: null,
    };
  },
  methods: {
    registerSubmit() {
      if (this.Password.length > 0) {
        axios.get("/sanctum/csrf-cookie").then((response) => {
          axios
            .post("api/register", {
              name: this.Name,
              email: this.Email,
              password: this.Password,
            })
            .then((response) => {
              if (response.data.success) {
                window.location.href = "/login";
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
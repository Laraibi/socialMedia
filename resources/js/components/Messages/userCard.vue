<template>
  <div class="card">
    <div class="card-header">
      <h5 class="card-title text-center">{{ user.name }}</h5>
    </div>
    <div class="card-body">
      <div class="my-2 row justify-content-center">
        <div class="col-6">
          <img
            :src="userImg"
            alt=""
            id="cardUserImage"
            class="image rounded img-fluid img-thumbnail"
          />
        </div>
      </div>
      <div class="my-2 row">
        <div class="col-4">
          <small class="fw-bold">Email:</small>
        </div>
        <div class="col-8">
          <span class="text-bold">{{ user.email }}</span>
        </div>
      </div>
      <div class="my-2 row">
        <div class="col-4">
          <small class="fw-bold">Sexe:</small>
        </div>
        <div class="col-8">
          <span class="text-bold">{{ userSexe }}</span>
        </div>
      </div>
      <div class="my-2 row">
        <div class="col-4">
          <small class="fw-bold">Age:</small>
        </div>
        <div class="col-8">
          <span class="text-bold">{{ userAge }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import axios from "axios";
export default {
  name: "userCard",
  props: {
    id: {
      type: Number,
      value: -1,
    },
  },
  data() {
    return {
      user: {},
    };
  },
  watch: {

    $route() {
    //   console.log(to);
    //   console.log(to.params.id);
    //   if(to.params.id){
        //   this.id=to.params.id;
          this.load();
    //   }
    },
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      axios.get("/api/getUser?user_id=" + this.$route.params.id).then((res) => {
        this.user = res.data;
      });
    },
  },
  computed: {
    userAge() {
      return moment().diff(this.user.DateOfBirth, "years");
    },
    userSexe() {
      return this.user.isMale == 1 ? "Male" : "Female";
    },
    userImg() {
      if (this.user) {
        if (this.user.image_path == null || this.user.image_path == "") {
          return "https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png";
        } else {
          return (
            window.location.origin +
            "/storage/user_images/" +
            this.user.image_path
          );
        }
      }
    },
  },
};
</script>
<style>
#cardUserImage {
  max-height: 100%;
  max-width: 100%;
}
</style>
<template>
  <div class="row justify-content-center">
    <div class="col">
      <input type="text" placeholder="First Name" v-model="Personne.firstName" class="form-control" />
    </div>
    <div class="col">
      <input type="text" placeholder="Last Name" v-model="Personne.lastName" class="form-control" />
    </div>
    <div class="col">
      <input type="text" placeholder="Age" v-model="Personne.age" class="form-control" />
    </div>
    <div class="col">
      <button class="btn btn-primary" @click="addPersonne">Add</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "formPersonne",
  data() {
    return {
      Personne: {
        firstName: "",
        lastName: "",
        age: 0,
      },
    };
  },
  methods: {
    addPersonne() {
      axios.post("/api/personnes", { ...this.Personne }).then((res) => {
        this.$emit("pushPersonne", res.data);
        this.Personne = {
          firstName: "",
          lastName: "",
          age: 0,
        }
      });
    },
  },
};
</script>

<style>
</style>
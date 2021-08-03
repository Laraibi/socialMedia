<template>
  <div class="row">
    <formPersonne @pushPersonne="pushPersonne"></formPersonne>
  </div>
  <div class="row justify-content-center">
    <div class="col-10">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Age</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(Personne, key) in listPersonne" :key="key">
            <th>{{ Personne.id }}</th>
            <td>
              <span v-if="key !== editingKey">{{ Personne.firstName }}</span>
              <input
                v-if="key == editingKey"
                v-model="Personne.firstName"
                type="text"
                class="form-control"
              />
            </td>
            <td>
              <span v-if="key !== editingKey">{{ Personne.lastName }}</span>
              <input
                v-if="key == editingKey"
                v-model="Personne.lastName"
                type="text"
                class="form-control"
              />
            </td>
            <td>
              <span v-if="key !== editingKey">{{ Personne.age }}</span>
              <input
                v-if="key == editingKey"
                v-model="Personne.age"
                type="text"
                class="form-control"
              />
            </td>
            <td>
              <button class="btn btn-info" @click="this.editingKey = key">
                <i class="bi bi-pencil-square"></i>
              </button>
              <button class="btn btn-danger" @click="deletePersonne(key)">
                <i class="bi bi-trash-fill"></i>
              </button>
              <button
                v-if="key == editingKey"
                class="btn btn-success"
                @click="updatePersonne(key)"
              >
                <i class="bi bi-save"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import formPersonne from "./formPersonne.vue";
export default {
  name: "listPersonnes",
  components: {
    formPersonne,
  },
  data() {
    return {
      listPersonne: [],
      editingKey: -1,
    };
  },
  created() {
    axios.get("/api/personnes").then((res) => (this.listPersonne = res.data));
  },
  methods: {
    pushPersonne(Personne) {
      this.listPersonne.push(Personne);
    },
    deletePersonne(key) {
      if (confirm("sure?")) {
        axios.delete("/api/personnes/" + this.listPersonne[key].id).then(() => {
          this.listPersonne.splice(key, 1);
        });
      }
    },
    // toggleEditingKey(key){
    //     this.editingKey=key
    // },
    updatePersonne(key) {
      axios
        .put("/api/personnes/" + this.listPersonne[key].id, {
          ...this.listPersonne[key],
        })
        .then(() => (this.editingKey = -1));
    },
  },
  beforeRouteEnter(to, from, next) {
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/";
    }
    next();
  },
};
</script>

<style>
</style>
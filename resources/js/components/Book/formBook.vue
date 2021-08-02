<template>
  <div class="row justofy-content-center">
    <div class="col">
      <div class="row">
        <div class="col">
          <input
            type="text"
            v-model="book.Name"
            id="Name"
            class="form-control d-inline" placeholder="Name"
          />
        </div>
        <div class="col">
          <input
            type="text"
            v-model="book.Author"
            id="Author"
            class="form-control d-inline" placeholder="Author"
          />
        </div>
        <div class="col">
          <button class="btn-primary btn" @click.prevent="addBook">Add</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "formBook",
  data() {
    return {
      book: {
        Name: "",
        Author: "",
      },
    };
  },
  methods: {
    addBook() {
      axios.post("/api/books", { ...this.book }).then((res) => {
        this.$emit("pushBook", res.data);
        this.book = { Name: "", Author: "" };
      });
    },
  },
};
</script>

<style>
</style>
<template>
  <div class="row justify-content-center">
    <div class="col-8">
      <formBook @pushBook="pushBook"></formBook>
    </div>
    <div class="col-lg-8 col-sm-12">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <td>Name</td>
            <td>Author</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(book, key) in listBooks" :key="key">
            <th>{{ book.id }}</th>
            <td>
              <span v-if="editingKey !== key">
                {{ book.Name }}
              </span>
              <input
                type="text"
                v-if="editingKey == key"
                v-model="book.Name"
                class="form-control"
              />
            </td>
            <td>
              <span v-if="editingKey !== key">
                {{ book.Author }}
              </span>
              <input
                type="text"
                v-if="editingKey == key"
                v-model="book.Author"
                class="form-control"
              />
            </td>
            <td>
              <button
                class="btn-info btn"
                @click.prevent="changeEditngKey(key)"
              >
                <i class="bi bi-pencil-square"></i>
              </button>
              <button class="btn-danger btn" @click="deleteBook(key)">
                <i class="bi bi-trash-fill"></i>
              </button>
              <button
                class="btn btn-success"
                v-if="editingKey == key"
                @click="saveBook(key)">
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
import formBook from "./formBook.vue";
export default {
  name: "listBooks",
  components: {
    formBook,
  },
  data() {
    return {
      listBooks: [],
      editingKey: -1,
    };
  },
  created() {
    axios.get("/api/books").then((res) => (this.listBooks = res.data));
  },
  methods: {
    deleteBook(key) {
      if (confirm("Sure?")) {
        axios
          .delete("/api/books/" + key, {
            header: {},
            data: { book_id: this.listBooks[key].id },
          })
          .then(() => this.listBooks.splice(key, 1));
      }
    },
    pushBook(Book) {
      this.listBooks.push(Book);
    },
    changeEditngKey(key) {
      this.editingKey = key;
    },
    saveBook(key) {
      axios
        .get("/api/books/" + key + "/edit", {
          params: {
            book_id: this.listBooks[key].id,
            name: this.listBooks[key].Name,
            author: this.listBooks[key].Author,
          },
        })
        .then((this.editingKey = -1));
    },
  },
};
</script>

<style>
td{
    white-space: nowrap;
}
</style>
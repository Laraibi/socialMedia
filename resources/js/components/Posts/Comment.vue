<template>
  <el-dialog
    title="Commentaires"
    v-model="commentDialogVisile"
    :before-close="toggleComment"
  >
    <div class="row">
      <div class="col-8">
        <textarea class="form-control" v-model="newComment.content"></textarea>
      </div>
      <div class="col-4">
        <button class="btn btn-success" @click="addComment">Commenter</button>
      </div>
    </div>
    <div class="row">
      <ul>
        <li v-for="(comment, key) in Commentaires" :key="key">
          <div class="row">
                <div class="col-2 border border-1-dark">
                {{ comment.user.name }}
                </div>
                <div class="col-6 border border-1-dark">
                {{ comment.content }}
                </div>
                <div class="col-4 border border-1-dark">
                {{ createdTime(comment.timeStamp.created) }}
                </div>
          </div>
        </li>
      </ul>
    </div>
  </el-dialog>
</template>

<script>
import axios from "axios";
import moment from 'moment';
// import moment from "moment";
export default {
  name: "Comment",
  props: {
    commentDialogVisile: {
      type: Boolean,
      value: false,
    },
    postItem: {
      type: Object,
      value: {},
    },
  },
  data() {
    return {
      Commentaires: [],
      newComment: {
        post_id: this.postItem.id,
        content: "",
      },
    };
  },
  watch: {
    commentDialogVisile() {
      this.load();
    },
  },
  computed: {
    created() {
      return "";
    },
  },
  methods: {
    createdTime(time){
        return moment(time).format( "YYYY-MM-DD HH:mm:ss")
    },
    addComment() {
      axios.post("/api/addComment", { ...this.newComment }).
        then((res) => {
          this.Commentaires.unshift(res.data.data);
          this.newComment.content=''
          this.$emit('incrementComments')
        });
    },
    toggleComment() {
      this.$emit("toggleComment");
    },
    load() {
      if (this.commentDialogVisile) {
        axios
          .get("/api/postComments?post_id=" + this.postItem.id)
          .then((res) => {
            this.Commentaires = res.data.data;
          });
      }
    },
  },
};
</script>

<style>
</style>
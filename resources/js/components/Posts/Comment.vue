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
        <li class="" v-for="(comment, key) in Commentaires" :key="key">
          <div class="row commentRow">
            <div class="col-2 align-middle">
              <!-- {{ comment.user.name }} -->

              <img
                class="userImg image image-fluid "
                :src="userImgUrl(comment.user.image_path)"
                alt=""
              />
            </div>
            <div class="col-6 align-middle text-align-right">
              {{ comment.content }}
            </div>
            <div class="col-4 align-middle text-align-right">
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
import moment from "moment";
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
    userImgUrl(base_path) {
      if (base_path == null || base_path == "") {
        return "https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png";
      } else {
        return window.location.origin + "/storage/user_images/" + base_path;
      }
    },
    createdTime(time) {
      return moment(time).format("YYYY-MM-DD HH:mm:ss");
    },
    addComment() {
      axios.post("/api/addComment", { ...this.newComment }).then((res) => {
        this.Commentaires.unshift(res.data.data);
        this.newComment.content = "";
        this.$emit("incrementComments");
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
.commentRow{
  color:honeydew;padding: 10px;
  /* border: 1px gray solid ; */
  background-color: gray;
  opacity: 0.7;
  border-radius: 5px;
  margin: 5px 2px;
}
.userImg{
  height: 50px;
  width: 50px;
  border: 1px gray solid ;
  border-radius: 50%;
}
</style>
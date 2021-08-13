<template>
  <!-- {{PostItem}} -->
  <el-card :body-style="{ padding: '0px' }">
    <div id="header">
      <div class="row p-3">
        <div class="col border-bottom pb-2 d-flex align-items-center">
          <img
            :src="userImage"
            style="height: 3rem; width: 3rem; border-radius: 50%"
            alt=""
          />
          <span class="text-bold display-5 mx-2">{{ PostItem.user.name }}</span>
          <time class="time ms-auto me-2">
            <small
              ><em>{{ created_at }}</em></small
            >
          </time>
        </div>
      </div>
    </div>
    <el-image
      style="width: 100%; height: 450px"
      v-if="postImage"
      :src="postImage"
      :preview-src-list="[postImage]"
    >
    </el-image>
    <div style="padding: 26px">
      <span>{{ PostItem.content }}</span>
      <div class="bottom mt-3">
        <el-badge :value="PostItem.likeCount" class="mx-2">
          <el-button
            @click="like"
            :type="PostItem.isLiked ? 'success' : 'info'"
            icon="el-icon-heart-empty"
            size="mini"
            round
            >J'aime</el-button
          >
        </el-badge>

        <el-badge :value="PostItem.commentsCount" class="mx-2">
          <el-button
            type="info"
            icon="el-icon-s-comment"
            size="mini"
            round
            @click="toggleComment"
            >Commenter</el-button
          >
          <comment :commentDialogVisile="Dialogcomment" :postItem="PostItem" @toggleComment="toggleComment" @incrementComments="PostItem.commentsCount++"></comment>
        </el-badge>
      </div>
    </div>
  </el-card>
</template>

<script>
import moment from "moment";
import axios from "axios";
import Comment from "./Comment.vue";
export default {
  name: "postItem",
  components: {
    Comment,
  },
  data() {
    return {
      Dialogcomment: false,
    };
  },
  props: {
    PostItem: {
      type: Object,
      value: {},
    },
  },
  methods: {
    like() {
      // this.$emit("likePost", this.PostItem.id);
      axios.post("api/like", { post_id: this.PostItem.id }).then((res) => {
        this.PostItem.isLiked = res.data.isLiked;
        this.PostItem.likeCount += res.data.isLiked ? 1 : -1;
      });
    },
    toggleComment() {      
      this.Dialogcomment = !this.Dialogcomment;
    },
  },
  computed: {
     userImage() {
      if (
        this.PostItem.user.image_path &&
        this.PostItem.user.image_path !== ""
      ) {
        return (
          window.location.origin +
          "/storage/user_images/" +
          this.PostItem.user.image_path.replace("\\", "")
        );
      } else {
        return "https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png";
      }
    },
    postImage() {
      if (this.PostItem.image_path && this.PostItem.image_path !== "") {
        return (
          window.location.origin + this.PostItem.image_path.replace("\\", "")
        );
      } else {
        return false;
      }
    },
    created_at() {
      return moment(this.PostItem.timeStamp.created).format(
        "YYYY-MM-DD HH:mm:ss"
      );
    },
  },
};
</script>

<style>
.image {
  height: 200px;
}
</style>
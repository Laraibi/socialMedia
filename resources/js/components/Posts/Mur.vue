<template>
  <el-row type="flex" class="row-bg" justify="center">
    <el-col :lg="16" :sm="24">
      <add-post @pushPost="pushPost"> </add-post> </el-col
  ></el-row>
  <el-row type="flex" class="row-bg" justify="center">
    <el-col :lg="16" :sm="24">
      <post-item
        class="my-2"
        v-for="(post, key) in Posts"
        :key="key"
        :PostItem="post"
        :isLiked="likedPosts.includes(post.id)"
        @likePost="likePost"
      ></post-item> </el-col
  ></el-row>
</template>

<script>
import postItem from "./postItem.vue";
import addPost from "./addPost.vue";
import axios from "axios";

export default {
  name: "Mur",
  components: {
    postItem,
    addPost,
  },
  data() {
    return {
      Posts: [],
      likedPosts: [12, 14, 5, 16],
    };
  },
  methods: {
    loadPosts() {
      axios.get("/api/posts").then((res) => (this.Posts = res.data.data));
    },
    pushPost(post) {
      this.Posts.unshift(post);
    },
    likePost(postId) {
      if (this.likedPosts.includes(postId)) {
        this.likedPosts.splice(this.likedPosts.indexOf(postId),1);
      } else {
        this.likedPosts.push(postId);
      }
    },
    unlikePost(postId) {
      console.log(postId);
      // console.log(this.likedPosts.indexOf(postId))
      this.likedPosts.splice(this.likedPosts.indexOf(postId));
      // console.log('this.likedPosts:')
      // console.log(this.likedPosts)
    },
  },
  created() {
    this.loadPosts();
  },
};
</script>

<style>
</style>
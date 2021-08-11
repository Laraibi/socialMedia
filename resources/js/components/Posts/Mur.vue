<template>
  <el-row type="flex" class="row-bg" justify="center">
    <el-col :span="16">
      <add-post> </add-post> </el-col
  ></el-row>
  <el-row type="flex" class="row-bg" justify="center">
    <el-col :span="16">
      <post
        class="my-2"
        v-for="(post, key) in Posts"
        :key="key"
        :PostItem="post"
      ></post> </el-col
  ></el-row>
</template>

<script>
import Post from "./Post.vue";
import addPost from "./addPost.vue";
import axios from "axios";

export default {
  name: "Mur",
  components: {
    Post,
    addPost,
  },
  data() {
    return {
      Posts: [],
    };
  },
  methods: {
    loadPosts() {
      axios.get("/api/posts").then((res) => (this.Posts = res.data.data));
    },
  },
  created() {
    this.loadPosts();
  },
};
</script>

<style>
</style>
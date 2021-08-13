<template>
  <el-row type="flex" class="row-bg page-component__scroll" justify="center">
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
    };
  },
  methods: {
    loadPosts() {
      axios.get("/api/posts").then((res) => (this.Posts = res.data.data));
    },
    pushPost(post) {
      this.Posts.unshift(post);
    },
  },
  created() {
    this.loadPosts();
  },
};
</script>

<style>
</style>
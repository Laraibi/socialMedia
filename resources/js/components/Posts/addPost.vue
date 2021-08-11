<template>
  <el-row type="flex" class="row-bg" justify="center">
    <el-col :span="16">
      <el-input
        type="textarea"
        :rows="2"
        placeholder="Say Somthing"
        v-model="Post.content"
        @keyup.enter="sendPost"
      >
      </el-input>
    </el-col>
    <el-col :span="8">
      <el-button type="success" class="h-100 w-100" @click="sendPost"
        >Poster<i class="el-icon-upload2 el-icon-right"></i
      ></el-button>
    </el-col>
  </el-row>
</template>

<script>
import axios from "axios";
export default {
  name: "addPost",
  data() {
    return {
      Post: {
        content: "",
        image_path: "",
      },
    };
  },
  methods: {
    sendPost() {
      axios
        .post("/api/posts", { ...this.Post })
        .then((res) => console.log(res.data));
    },
  },
};
</script>

<style>
</style>
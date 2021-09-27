<template>
  <el-row type="flex" :gutter="20" class="row-bg" justify="center">
    <el-col :span="12" class="h-100">
      <el-input
        type="textarea"
        placeholder="Say Somthing"
        v-model="Post.content"
        @keyup.enter="sendPost"
      >
      </el-input>
    </el-col>
    <el-col :span="6">
      <el-upload
        ref="upload"
        id="upladPostImage"
        multiple="false"
        action="/api/uploadImage"
        name="post_image"
        list-type="picture"
        :headers="headers"
        :on-preview="handlePictureCardPreview"
        :onSuccess="handleUploadImageSuccess"
        :on-remove="handlaRemomeImage"
      >
        <el-button
          type="primary"
          :disabled="Post.post_image == '' ? false : true"
          >Upload<i class="el-icon-plus el-icon-right mx-1"></i
        ></el-button>
      </el-upload>
      <el-dialog v-model="dialogVisible">
        <img style="width: 100%" :src="postImgUrl" alt="" />
      </el-dialog>
    </el-col>
    <el-col :span="6">
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
      upladObject: [],
      Post: {
        content: "",
        post_image: "",
      },
      dialogVisible: false,
      headers: {
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
      },
    };
  },
  computed: {
    postImgUrl() {
      return this.Post.post_image;
    },
  },
  methods: {
    sendPost() {
      axios.post("/api/posts", { ...this.Post }).then((res) => {
        this.$emit("pushPost", res.data.data);
        this.Post.content = "";
        this.Post.post_image = "";
        this.$refs.upload.clearFiles();
      });
    },
    handlePictureCardPreview() {
      this.dialogVisible = true;
    },
    handleUploadImageSuccess(res) {
      this.Post.post_image = res.image_path
        .replace("\\", "")
        .replace("public", "storage");
    },
    handlaRemomeImage() {
      this.Post.post_image = "";
    },
  },
};
</script>

<style>
#upladPostImage div,
#upladPostImage div button {
  width: 100% !important;
}
</style>
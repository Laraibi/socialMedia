<template>
  <!-- {{ user }} -->
  <el-row type="flex" class="row-bg" justify="center">
    <el-col :span="16">
      <el-form ref="user" :model="user" label-width="10rem">
        <el-form-item label="Email">
          <el-input v-model="user.email" :disabled="true"></el-input>
        </el-form-item>
        <el-form-item label="Name">
          <el-input v-model="user.name"></el-input>
        </el-form-item>
        <el-form-item label="Sexe">
          <el-radio-group v-model="user.isMale">
            <el-radio label="1">Male</el-radio>
            <el-radio label="0">Female</el-radio>
          </el-radio-group>
        </el-form-item>
        <el-form-item label="Date de Naissance">
          <el-date-picker
            v-model="user.DateOfBirth"
            type="date"
            placeholder="Choisir une date"
            format="YYYY-MM-DD"
            value-format="YYYY-MM-DD"
          >
          </el-date-picker>
        </el-form-item>
        <el-form-item label="Picture">
          <el-upload
            :multiple="false"
            name="user_image"
            class="avatar-uploader"
            list-type="picture-card"
            action="/api/uploadImage"
            :headers="headers"
            :auto-upload="true"
            :show-file-list="false"
            :onSuccess="handleAvatarSuccess"
          >
            <img v-if="imageUrl" :src="imageUrl" class="avatar" />
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          </el-upload>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click.prevent="onSubmit">Update</el-button>
          <el-button @click.prevent="load">Cancel</el-button>
        </el-form-item>
      </el-form>
    </el-col>
  </el-row>
</template>

<script>
import axios from "axios";
export default {
  name: "profile",
  data() {
    return {
      user: {},
      oldUser: {},
      imageUrl: "",
      headers: {
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
      },
    };
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      // console.log("load");
      // this.user = window.Laravel.user;
      this.user = _.cloneDeep(window.Laravel.user);
      this.user.isMale = this.user.isMale.toString();
      if (this.user.image_path !== null && this.user.image_path !== "") {
        this.imageUrl =
          window.location.origin +
          "/storage/user_images/" +
          this.user.image_path;
      }
    },
    handleAvatarSuccess(res) {
      this.imageUrl = res.image_path
        .replace("\\", "")
        .replace("public", "storage");
    },
    onSubmit() {
      let postData = {
        user_id: this.user.id,
        name: this.user.name,
        Dob: this.user.DateOfBirth,
        user_image:
          this.imageUrl == ""
            ? ""
            : this.imageUrl.split("/")[this.imageUrl.split("/").length - 1],
      };
      axios.post("/api/editProfile", { ...postData }).then((res) => {
        // this.$toast.success(`Profile updated`);
        this.user = res.data;
        window.Laravel.user = this.user;
        this.user.isMale = this.user.isMale.toString();
        this.imageUrl =
          window.location.origin +
          "/storage/user_images/" +
          res.data.image_path;
        this.$notify({
          title: "Success",
          message: "Profile updated.",
          type: "success",
          showClose: false,
        });
      });
    },
  },
  // beforeRouteEnter(to, from, next) {
  //   if (!window.Laravel.isLoggedin) {
  //     window.location.href = "/";
  //   }
  //   next();
  // },
};
</script>

<style>
.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.avatar-uploader .el-upload:hover {
  border-color: #409eff;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
}
</style>
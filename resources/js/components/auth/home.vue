<template>
  <div class="row">
    <div class="col-3">Hello {{ userName }}</div>
  </div>
</template>

<script>
export default {
  name: "home",
  data() {
    return {
      userName: "",
    };
  },
  created() {
    if (window.Laravel.user) {
      this.userName = window.Laravel.user.name;
    }
  },
};
</script>

<style>
</style>
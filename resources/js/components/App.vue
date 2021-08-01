<template>
  <div class="row justify-content-center">
    <div class="row justify-content-center">
      <div class="col-lg-3 col-sm-6">
        <h2 class="">{{ Message }}</h2>
      </div>
    </div>
    <div class="row">
        <listBooks></listBooks>
    </div>
  </div>
</template>

<script>
import listBooks from './Book/listBooks.vue'
export default {
    components:{
        listBooks,
    },
  data() {
    return {
      Message: "Books Management",
    };
  },
};
</script>

<style>
</style>
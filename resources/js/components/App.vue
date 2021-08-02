<template>
  <div class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <router-link to="/Books" class="nav-link">Books</router-link>
            <router-link to="/Personnes" class="nav-link"
              >Personnes</router-link
            >
          </div>
        </div>
      </div>
    </nav>
    <div class="row">
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      Message: "Books Management",
    };
  },
};
</script>

<style>
</style>
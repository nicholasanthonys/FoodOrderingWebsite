<template>
  <!-- Side Navbar -->
  <div class="wrapper">
    <nav id="sidebar">
      <div class="sidebar-header">
        <img class="logo" src="../assets/logo-kitchen-black.png" alt="Logo Kitchen" />
      </div>

      <h3>welcome</h3>
      <h3 class="name">
        <u>{{name}}</u>
      </h3>
    </nav>
  </div>
</template>

<script>
export default {
  name: "ProfileNavbar",
  props: {
    name: String
  }
};
</script>

<style scoped>
.wrapper {
  display: flex;
  align-items: stretch;
  width: 15%;
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  z-index: 999;
  background: #c9c5c1;
  color: #fff;
}

#sidebar {
  width: 100%;
  height: 100%;
}

h3,
.name {
  color: black;
}
.logo {
  width: 80%;
  display: block;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 80px;
}
</style>
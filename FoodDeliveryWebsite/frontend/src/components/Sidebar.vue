<template>
  <!-- Side Navbar -->
  <div class="wrapper">
    <nav id="sidebar">
      <div class="sidebar-header">
        <img class="logo" src="../assets/logo-kitchen-black.png" alt="Logo Kitchen" />
      </div>

      <ul class="list-unstyled components">
        <li>
          <a href="#" class="link-to-other" active>Pasta</a>
        </li>
        <li>
          <a href="#" class="link-to-other">Steak</a>
        </li>
        <li>
          <a href="#" class="link-to-other">Pizza</a>
        </li>
        <li>
          <a href="#" class="link-to-other">Rice</a>
        </li>
        <li>
          <a href="#" class="link-to-other">Soup</a>
        </li>
        <li>
          <a href="#" class="link-to-other">Salad</a>
        </li>
        <li>
          <a href="#" class="link-to-other">Drinks</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

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
  background: #4a4a4a;
  color: #fff;
}

#sidebar {
  width: 100%;
  height: 100%;
}

.link-to-other {
  font-size: 16px;
  color: #fff;
}

.link-to-other:hover .link-to-other:focus {
  text-decoration: underline;
  text-decoration-color: #fff;
}

.link-to-other:active .link-to-other:visited {
  color: #ff9d9d;
}

li {
  text-align: center;
  margin-bottom: 41px;
}

.logo {
  width: 80%;
  display: block;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 80px;
}
</style>
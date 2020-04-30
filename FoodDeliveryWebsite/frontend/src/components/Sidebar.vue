<template>
  <!-- Side Navbar -->
  <div class="wrapper">
    <nav id="sidebar">
      <div class="sidebar-header">
        <img class="logo" src="../assets/logo-kitchen-black.png" alt="Logo Kitchen" />
      </div>

      <ul class="list-unstyled components">
        <li>
          <a id="pasta" ref="pasta" href="/menupasta" class="link-to-other" :class="pasta">Pasta</a>
        </li>
        <li>
          <a id="steak" ref="steak" href="/menusteak" class="link-to-other" :class="steak">Steak</a>
        </li>
        <li>
          <a id="pizza" ref="pizza" href="/menupizza" class="link-to-other" :class="pizza">Pizza</a>
        </li>
        <li>
          <a id="rice" ref="rice" href="/menurice" class="link-to-other" :class="rice">Rice</a>
        </li>
        <li>
          <a id="soup" ref="soup" href="/menusoup" class="link-to-other" :class="soup">Soup</a>
        </li>
        <li>
          <a id="salad" ref="salad" href="/menusalad" class="link-to-other" :class="salad">Salad</a>
        </li>
        <li>
          <a id="drinks" ref="drinks" href="/menudrinks" class="link-to-other" :class="drinks">Drinks</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pasta: '',
      steak: '',
      pizza: '',
      rice: '',
      soup: '',
      salad: '',
      drinks: ''
    }
  },
  mounted: function () {
    this.$root.$on('changeActive', (link) => {
      switch (link) {
        case "pasta":
          this.pasta = 'active';
          break;
        case "steak":
          this.steak = 'active';
          break;
        case "pizza":
          this.pizza = 'active';
          break;
        case "rice":
          this.rice = 'active';
          break;
        case "soup":
          this.soup = 'active';
          break;
        case "salad":
          this.salad = 'active';
          break;
        case "drinks":
          this.drinks = 'active';
          break;
      }
    })
  }
}
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

.link-to-other:hover, .link-to-other:focus {
  text-decoration: underline;
  text-decoration-color: #fff;
}

.link-to-other.active, .link-to-other.active:hover {
  color: #ff9d9d;
  text-decoration: none;
  cursor: default;
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
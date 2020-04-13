<template>
  <div id="app">
    <Navbar/>
    <HelloWorld msg="Welcome to Your Vue.js App"/>
  </div>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'
import Navbar from './components/Navbar.vue'

import jQuery from 'jquery'
import 'bootstrap/dist/css/bootstrap.css'

// Install BootstrapVue
global.jQuery = jQuery
global .$ = jQuery
 

export default {
  name: 'App',
  components: {
    HelloWorld,
    Navbar
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin:0px;
  padding:0px;
}
</style>

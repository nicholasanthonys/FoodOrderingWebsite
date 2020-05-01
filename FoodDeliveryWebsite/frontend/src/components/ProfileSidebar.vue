<template>
  <!-- Side Navbar -->
  <div class="wrapper">
    <nav id="sidebar">
      <div class="sidebar-header">
        <img class="logo" src="../assets/logo-kitchen-black.png" alt="Logo Kitchen" />
      </div>

      <h3 class="welcome">Welcome</h3>
      <h3 class="name">
        <u> {{ name }}!</u>
      </h3>
    </nav>
  </div>
</template>

<script>
import {getUser} from '@/services';
import Cookies from 'js-cookie';

export default {
  name: "ProfileNavbar",
  data(){
    return{
      name : ""
    }
  },
  methods : {
    async fillName(){
      try{
        let res = await getUser(Cookies.get('email'));
        if(res.status >= 200 && res.status < 300){
          this.name = res.data.user.name;
        }
      }catch(err){
        console.log(err);
      }
    }
  },
  mounted(){
    this.fillName();
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
  overflow: hidden;
}

#sidebar {
  width: 100%;
  height: 100%;
}

.welcome, .name {
  color: black;
  padding-left: 2vw;
  font-size: 24px;
  line-height: 36px;
}

.logo {
  width: 80%;
  display: block;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 80px;
}
</style>
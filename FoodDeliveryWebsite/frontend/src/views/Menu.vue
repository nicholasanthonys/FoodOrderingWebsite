<template>
  <div class="menu-pasta">
    <!---Sidebar-->
    <Sidebar />

    <div class="content">
      <!-- Navbar -->
      <Navbar id="navbar" />

      <!-- Content of Menu -->
      <div class="menu-row row">
        <div class="menu" v-for="menu in menus" :key="menu.id">
          <img class="menu-img" v-bind:src="menu.url_image" alt="Menu" />

          <p class="menu-name"> {{menu.name}} </p>
          <p class="menu-price">Rp {{menu.price}} </p>

          <button class="detail_menu" v-on:click="goToDetail(menu.id)">Detail Menu</button>
          <button class="pesan">Pesan</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar";
import Sidebar from "../components/Sidebar";
import { 
  getMenuPasta,
  getMenuSteak,
  getMenuPizza,
  getMenuRice,
  getMenuSoup,
  getMenuSalad,
  getMenuDrinks

} from "@/services";
export default {
  components: {
    Navbar,
    Sidebar
  },
  data: function() {
    return {
      menus: []
    };
  },
  methods: {
    fillMenus: async function() {
      try {
        let res = null;
        let path = this.$router.history.current.fullPath;
        switch (path) {
          case '/menupasta':
             res = await getMenuPasta();
             break;

          case '/menusteak' :
            res = await getMenuSteak();
            break;

          case '/menupizza':
            res = await getMenuPizza();
            break;
          
          case '/menurice' : 
            res = await getMenuRice();
            break;

          case '/menusoup' : 
            res = await getMenuSoup();
            break;

          case '/menusalad' :
            res = await getMenuSalad();
            break;

          case '/menudrinks' : 
            res = await getMenuDrinks();
            break;
          

        }

        console.log("res data is ");
        if (res.status >= 200 && res.status < 300) {
          this.menus = res.data.menus;
        }
      } catch (err) {
        console.log(err);
      }
    },
    goToDetail: function(id) {
      this.$router.push("/detailmenu/" + id);
    }
  },
  mounted: function() {
    this.fillMenus();
    console.log("route is ");
    console.log(this.$router.history.current.fullPath == "/menusteak");
  }
};
</script>

<style scoped>
.menu-pasta {
  /*semetara font family poppins belum ada */
  /* font-family: Poppins; */
  width: auto;
  height: auto;
  padding-bottom: 20px;
  background-color: #282828;
}

.content {
  width: 85%;
  margin-left: 15%;
}

.menu-row {
  margin-top: 55px;
  margin-right: 0px;
  margin-left: 0px;
}

.menu {
  margin-bottom: 30px;
  width: 18.75%;
  height: auto;
  padding-bottom: 18px;
  min-height: 400px;
  margin-left: 5%;
  border-radius: 10px;
  background-color: #fff;
}

.menu-img {
  width: 100%;
  height: 200px;
  object-fit: fill;
  border-radius: 10px 10px 0px 0px;
}

.menu-name {
  margin-top: 11.5px;
  margin-bottom: 0px;
  font-style: bold;
  font-size: 18px;
  color: #0b3993;
  text-align: center;
}

.menu-price {
  font-size: 14px;
  margin-bottom: 25px;
  color: #000;
  text-align: center;
}

.detail_menu {
  width: 80%;
  max-width: 170px;
  height: 45px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  border-radius: 10px;
  color: #fff;
  margin-bottom: 12px;
  background-color: #275dc5;
  box-shadow: 0px 2px rgba(0, 0, 0, 0.25);
}

.pesan {
  width: 80%;
  max-width: 170px;
  height: 45px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  border-radius: 10px;
  color: #fff;
  background-color: #bf9e6b;
  box-shadow: 0px 2px rgba(0, 0, 0, 0.25);
}
</style>
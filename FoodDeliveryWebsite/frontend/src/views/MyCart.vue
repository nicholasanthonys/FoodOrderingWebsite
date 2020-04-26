<template>
  <div class="menu-pasta">
    <!---Sidebar-->
    <Sidebar />

    <div class="content">
      <!-- Navbar -->
      <Navbar id="navbar" />

      <!-- Content of Menu -->
      <div class="menu-row row">
        <b-card no-body class="overflow-hidden menu" style="max-width: 540px;" v-for="menu in menus" v-bind:key="menu.id">
          <b-row no-gutters>
            <b-col md="6">
              <b-card-img
                v-bind:src="menu.url_image"
                alt="Image"
                class="rounded-1"
              ></b-card-img>
            </b-col>
            <b-col md="6">
              <b-card-body v-bind:title="menu.name">
                <b-card-text>
                  <h6> {{ menu.quantity }} pcs - Rp.{{ menu.price * menu.quantity }}</h6>
                  <p class="max-lines"> {{ menu.description }} </p>
                </b-card-text>
              </b-card-body>
            </b-col>
          </b-row>
        </b-card>
      </div>

      <b-button v-if="menus != null" class="button-order">Order</b-button>
    </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar";
import Sidebar from "../components/Sidebar";
import Cookies from "js-cookie";
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
    fillMenus() {
      try {
        //get array cart from cookie

        let email = Cookies.get("email");
        let cart = JSON.parse(Cookies.get("cart-" + email));
        console.log("my cart is");
        console.log(cart);
        
        this.menus = cart;


        // let res = await getMenuPasta();
        // console.log("res data is ");
        // if (res.status >= 200 && res.status < 300) {
        //   this.menus = res.data.menus;
        // }
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
  }
};
</script>

<style scoped>
.menu-pasta {
  /*semetara font family poppins belum ada */
  /* font-family: Poppins; */
  width: auto;
  min-height: 100vh;
  height: auto;
  padding-bottom: 20px;
  background-color: #282828;
}

.content {
  width: 85%;
  margin-left: 15%;
}

.menu-row {
  margin-top: 20px;
  margin-right: 0px;
  margin-left: 0px;
}

.menu {
  margin-bottom: 30px;
  width: 100%;
  height: auto;
  padding: 20px 20px 0px 20px;
  margin-left: 5%;
  border-radius: 10px;
  background-color: #fff;
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

.button-order {
  display: block;
  width: 40%;
  height: 50px;
  margin: 20px auto 20px auto;
  transition-duration: 0.4s;
  color: white;
  background-color: #BF9E6B;
}

.button-order:hover {
  transform: translateY(1px);
  filter: brightness(85%);
  cursor: pointer;
}

.button-order:active {
  transform: translateY(2px);
  filter: brightness(75%);
}

.max-lines {
  text-overflow: ellipsis;
  overflow: hidden;
  word-wrap: break-word;
  display: -webkit-box;
  display: -moz-box;
  line-height: 24px;
  max-height: 96px;
  line-clamp: 5;
  -webkit-line-clamp: 5;
  -moz-box-orient: vertical;
  -webkit-box-orient: vertical;
}
</style>
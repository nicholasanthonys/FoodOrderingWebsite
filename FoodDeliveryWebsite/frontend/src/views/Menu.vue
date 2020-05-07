<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<template>
  <div class="menu-pasta">
    <!---Sidebar-->
    <Sidebar v-if="this.$router.history.current.fullPath != '/promo'" />

    <div class="content">
      <!-- Navbar -->
      <Navbar id="navbar" />

      <!-- Content of Menu -->
      <div class="menu-row row">
        <div class="menu" v-for="menu in menus" :key="menu.id">
          <img class="menu-img" v-bind:src="menu.url_image" alt="Menu" />
          <img
            v-if="menu.chef_recommended"
            class="menu-logo"
            src="../assets/chef-recommend.png"
            alt="Chef Recommend Logo"
          />

          <p class="menu-name">{{menu.name}}</p>
          <div class="price" v-if="menu.promo">
            <p class="menu-price" style="margin-bottom:0px;">
              <span class="strikethrough">Rp {{menu.old_price}}</span>
            </p>
            <p class="menu-price">Rp {{menu.price}}</p>
          </div>
          <div class="price" v-else>
            <p class="menu-price">Rp {{menu.price}}</p>
          </div>
          <button class="detail_menu" v-on:click="goToDetail(menu.id)">Detail Menu</button>
          <button
            class="pesan"
            v-on:click="setSelectedMenu(menu.id,menu.type, menu.name, menu.price, menu.url_image,menu.description)"
            v-b-modal.modal-center
          >Pesan</button>
        </div>
      </div>
    </div>

    <div id="modal">
      <b-modal
        id="modal-center"
        class="modal-body styling=modal"
        ref="modal"
        centered
        size="lg"
        hide-footer
        hide-header
        header-text-variant="light"
        body-text-variant="light"
        body-border-variant="transparent"
        content-class="shadow"
        @ok="handleOk"
      >
        <div class="modal-header modal-title">
          <p id="b-title">Konfirmasi Pesanan Ini?</p>
        </div>

        <div class="content-modal">
          <h6>Konfirmasi pesanan anda</h6>

          <h6>{{ selectedMenu.name }}</h6>

          <b-img class="modal-img" thumbnail fluid v-bind:src="selectedMenu.url_image" rounded></b-img>

          <div class="form-group row" style="margin-left: 0px">
            <h6
              class="col-sm-4"
              style="text-align: left; padding: 0px; margin: auto 20px auto 0px;"
            >Quantity :</h6>

            <div v-on:click="plusQuantity()" id="button-plus" class="col-sm-1">+</div>

            <b-form-input
              id="input-1"
              class="col-sm-2"
              v-model="selectedMenu.quantity"
              type="number"
              min="1"
              required
              placeholder="Enter quantity"
            ></b-form-input>

            <div v-on:click="minusQuantity()" id="button-minus" class="col-sm-1">-</div>
          </div>

          <h6 style="margin-bottom: 20px">Total: Rp {{ selectedMenu.price * selectedMenu.quantity }}</h6>
        </div>

        <b-button class="button-ya" v-on:click="handleOk">Pesan Sekarang</b-button>
      </b-modal>
    </div>

    <div class="button-cart" v-on:click="goToMyCart">
      <img src="@/assets/cart.png" alt="Cart" />
    </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar";
import Sidebar from "../components/Sidebar";
import Cookies from "js-cookie";

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
      menus: [],
      selectedMenu: {
        id: 0,
        type: "",
        name: "",
        price: 0,
        quantity: 0,
        url_image: "",
        description: ""
      }
    };
  },
  methods: {
    fillMenus: async function() {
      try {
        let res = null;
        let path = this.$router.history.current.fullPath;
        switch (path) {
          case "/menupasta":
            res = await getMenuPasta();
            this.$root.$emit("changeActive", "pasta");
            break;

          case "/menusteak":
            res = await getMenuSteak();
            this.$root.$emit("changeActive", "steak");
            break;

          case "/menupizza":
            res = await getMenuPizza();
            this.$root.$emit("changeActive", "pizza");
            break;

          case "/menurice":
            res = await getMenuRice();
            this.$root.$emit("changeActive", "rice");
            break;

          case "/menusoup":
            res = await getMenuSoup();
            this.$root.$emit("changeActive", "soup");
            break;

          case "/menusalad":
            res = await getMenuSalad();
            this.$root.$emit("changeActive", "salad");
            break;

          case "/menudrinks":
            res = await getMenuDrinks();
            this.$root.$emit("changeActive", "drinks");
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
    },
    goToMyCart() {
      this.$router.push("/mycart");
    },
    setSelectedMenu(id, type, name, price, url_image, description) {
      this.selectedMenu.id = id;
      this.selectedMenu.name = name;
      this.selectedMenu.price = price;
      this.selectedMenu.url_image = url_image;
      this.selectedMenu.type = type;
      this.selectedMenu.description = description;
      this.selectedMenu.quantity = 1;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler
      this.handleSubmit();
    },
    checkSessionExist() {
      const valid = this.$session.exists();
      console.log("valid ? " + valid);
      return valid;
    },
    handleSubmit() {
      // Nicho tolong isi ini
      // Exit when the form isn't valid
      if (!this.checkSessionExist()) {
        alert("You have to log in first");
      } else {
        //push selectedmenu ke cart
        let email = Cookies.get("email");
        let cart = JSON.parse(Cookies.get("cart-" + email));

        //cek apakah sudah ada di cart kalo ada tinggal tambahin quantity nya;
        let isMenuInCart = false;
        cart.forEach(element => {
          if (element.id == this.selectedMenu.id) {
            let quantity = parseInt(element.quantity);
            quantity += parseInt(this.selectedMenu.quantity);
            element.quantity = quantity;
            isMenuInCart = true;
          }
        });

        //jika menu tidak ada di cart maka push sebagai menu baru di cart
        if (!isMenuInCart) {
          cart.push(this.selectedMenu);
        }

        //timpa nilai cookie nya
        Cookies.set("cart-" + email, JSON.stringify(cart));
      }

      // Push the name to submitted names
      // this.submittedNames.push(this.name);

      // Hide the modal manually
      this.$nextTick(() => {
        this.$bvModal.hide("modal-center");
      });
    },
    plusQuantity() {
      this.selectedMenu.quantity = this.selectedMenu.quantity + 1;
    },
    minusQuantity() {
      if (this.selectedMenu.quantity > 1) {
        this.selectedMenu.quantity = this.selectedMenu.quantity - 1;
      }
    }
  },
  mounted: function() {
    this.fillMenus();
    this.$root.$emit("doesnt need logo", "there sidebar");
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
  margin-top: 30px;
  margin-right: 0px;
  margin-left: 0px;
  position: relative;
}

.menu {
  margin-bottom: 30px;
  flex: 0 0 20%;
  height: auto;
  padding-bottom: 18px;
  min-height: 400px;
  margin-left: 2.5%;
  margin-right: 2.5%;
  border-radius: 10px;
  background-color: #fff;
  position: relative;
}

.menu-img {
  width: 100%;
  height: 200px;
  object-fit: fill;
  border-radius: 10px 10px 0px 0px;
  position: relative;
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

.button-cart {
  position: fixed;
  bottom: 0px;
  right: 0px;
  margin-bottom: 20px;
  margin-right: 20px;
  width: 80px;
  height: 80px;
  border-radius: 40px;
  background-color: #bf9e6b;
  transition-duration: 0.4s;
}

.button-cart img {
  width: 50px;
  height: 50px;
  margin: 15px;
}

.button-cart:hover {
  cursor: pointer;
  transform: translateY(-4px);
  filter: brightness(110%);
}

.button-cart:active {
  transform: translateY(4px);
  filter: brightness(90%);
}

.shadow {
  background-color: #887962 !important;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

#b-title {
  display: block;
  text-align: center;
  font-weight: bold;
  font-size: 18px;
  line-height: 27px;
  width: 100%;
}

.modal-title {
  text-align: center;
  border-bottom: none;
}

.content-modal {
  width: 100%;
  padding-left: 2em;
  padding-right: 2em;
}

.modal-img {
  display: block;
  margin: 0px auto 0.5rem auto;
  max-width: 40vw;
  max-height: 40vh;
}

.button-ya {
  width: 40%;
  height: 3em;
  display: block;
  margin: 0.5rem auto 1rem auto;
  background-color: #bf9e6b;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 10px;
  transition-duration: 0.4s;
}

#button-plus {
  margin: 0px;
  border-radius: 10px 0px 0px 10px;
  background-color: white;
  color: black;
  min-width: 40px;
  max-width: 40px;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  border-bottom: 1px solid black;
  border-top: 1px solid black;
  border-left: 1px solid black;
  transition-duration: 0.4s;

  /* Text can't be selected */
  user-select: none; /* supported by Chrome and Opera */
  -webkit-user-select: none; /* Safari */
  -khtml-user-select: none; /* Konqueror HTML */
  -moz-user-select: none; /* Firefox */
  -ms-user-select: none; /* Internet Explorer/Edge */
}

#button-minus {
  margin: 0px;
  border-radius: 0px 10px 10px 0px;
  background-color: white;
  min-width: 40px;
  max-width: 40px;
  color: black;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  border-bottom: 1px solid black;
  border-top: 1px solid black;
  border-right: 1px solid black;
  transition-duration: 0.4s;

  /* Text can't be selected */
  user-select: none; /* supported by Chrome and Opera */
  -webkit-user-select: none; /* Safari */
  -khtml-user-select: none; /* Konqueror HTML */
  -moz-user-select: none; /* Firefox */
  -ms-user-select: none; /* Internet Explorer/Edge */
}

#button-minus:hover,
#button-plus:hover {
  cursor: pointer;
  background-color: #bf9e6b;
}

#button-minus:active,
#button-plus:active {
  transform: translateY(2px);
}

#input-1 {
  border-radius: 0px;
  border: none;
  border-bottom: 1px solid black;
  border-top: 1px solid black;
  min-width: 100px;
  max-width: 100px;
}

.strikethrough {
  position: relative;
}

.strikethrough:before {
  position: absolute;
  content: "";
  left: 0px;
  top: 50%;
  right: 0px;
  border-top: 1.5px solid red;

  transform: rotate(-5deg);
  -moz-transform: rotate(-5deg);
  -ms-transform: rotate(-5deg);
  -o-transform: rotate(-5deg);
  -webkit-transform: rotate(-5deg);
}

.menu-logo {
  position: absolute;
  z-index: 5;
  width: 100px;
  height: 100px;
  right: -25px;
  top: -25px;

  transform: rotate(20deg);
  -moz-transform: rotate(20deg);
  -ms-transform: rotate(20deg);
  -o-transform: rotate(20deg);
  -webkit-transform: rotate(20deg);
}
</style>
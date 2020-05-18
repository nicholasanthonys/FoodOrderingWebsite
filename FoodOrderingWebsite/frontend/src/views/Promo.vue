<template>
  <div id="promo">
    <Navbar />
    <b-carousel
      id="carousel-1"
      fade
      v-model="slide"
      :interval="4000"
      controls
      indicators
      background="#ababab"
      img-width="1024"
      img-height="480"
      style="text-shadow: 1px 1px 2px #333;"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
      <!-- Text slides with image -->
      <b-carousel-slide img-src="../assets/bg_home_1.png" style="filter: brightness(70%);">
        <h3 style="margin-bottom: 24px; text-align: left;">"Lapar? Mau Makan?"</h3>
        <h3 style="margin-bottom: 35%; margin-left: 100px; text-align: left;">Pesan saja di sini...</h3>
      </b-carousel-slide>

      <!-- Slides with custom text -->
      <b-carousel-slide img-src="../assets/bg_home_2.png" style="filter: brightness(70%);">
        <h3 style="margin-bottom: 24px; text-align: left;">"Pengen Bakery?"</h3>
        <h3 style="margin-bottom: 35%; margin-left: 100px; text-align: left;">Pesan saja di sini...</h3>
      </b-carousel-slide>

      <!-- Slides with image only -->
      <b-carousel-slide img-src="../assets/bg_home_3.png" style="filter: brightness(70%);">
        <h3 style="margin-bottom: 24px; text-align: left;">"Pengen yang banyak?"</h3>
        <h3 style="margin-bottom: 35%; margin-left: 100px; text-align: left;">Pesan saja di sini...</h3>
      </b-carousel-slide>

      <!-- Slides with img slot -->
      <!-- Note the classes .d-block and .img-fluid to prevent browser default image alignment -->
      <!-- <b-carousel-slide>
        <template v-slot:img>
          <img
            class="d-block img-fluid w-100"
            width="1024"
            height="480"
            src="https://picsum.photos/1024/480/?image=55"
            alt="image slot"
          />
        </template>
      </b-carousel-slide>-->

      <!-- Slide with blank fluid image to maintain slide aspect ratio -->
      <!-- <b-carousel-slide caption="Blank Image" img-blank img-alt="Blank image">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eros felis, tincidunt
          a tincidunt eget, convallis vel est. Ut pellentesque ut lacus vel interdum.
        </p>
      </b-carousel-slide>-->
    </b-carousel>

    <div class="content">
      <div class="container">
        <div class="title-1">
          <h4 class>We Have Some Promo..</h4>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat sunt facere odio possimus reiciendis magni laudantium recusandae ullam accusamus corporis cum ducimus, facilis laborum illo dolore qui? Consectetur, doloribus quos!
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae debitis laudantium alias dolorum explicabo. Beatae porro necessitatibus nemo eveniet modi soluta aliquam, cupiditate, minima non rem nulla temporibus, iste nesciunt.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, obcaecati corporis sunt enim ipsum veniam? Esse non nostrum sunt. Earum, quidem. Magni itaque dicta aspernatur nihil veritatis quasi error odit.
          </p>
        </div>

        <div class="title-2">
          <h4>How to Use the Promo??</h4>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat sunt facere odio possimus reiciendis magni laudantium recusandae ullam accusamus corporis cum ducimus, facilis laborum illo dolore qui? Consectetur, doloribus quos!
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae debitis laudantium alias dolorum explicabo. Beatae porro necessitatibus nemo eveniet modi soluta aliquam, cupiditate, minima non rem nulla temporibus, iste nesciunt.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, obcaecati corporis sunt enim ipsum veniam? Esse non nostrum sunt. Earum, quidem. Magni itaque dicta aspernatur nihil veritatis quasi error odit.
          </p>
        </div>

        <!--- Menu promo-->
        <div id="menu-promo">
          <h4>Menu Promo</h4>
          <div class="container-fluid overflow-auto">
            <div class="menu-row row flex-row flex-nowrap">
              <div class="menu" v-for="promo in menusPromo" :key="promo.id">
                <img class="menu-img" v-bind:src="promo.url_image" alt="Menu" />

                <p class="menu-name">{{promo.name}}</p>
                <p class="menu-price" style="margin-bottom: 0px;"><span class="strikethrough">Rp {{promo.old_price}}</span> </p>
                <p class="menu-price">Rp {{promo.new_price}}</p>

                <button class="detail_menu" v-on:click="goToDetail(promo.menu_id)">Detail Menu</button>
                <button
                  class="pesan"
                  v-on:click="setSelectedMenu(promo.menu_id,promo.type, promo.name, promo.new_price, promo.url_image,promo.description)"
                  v-b-modal.modal-center
                >Pesan</button>
              </div>
            </div>
          </div>
        </div>
        <!--- Menu Promo end -->

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

                <div v-on:click="minusQuantity()" id="button-minus" class="col-sm-1">-</div>

                <b-form-input
                  id="input-1"
                  class="col-sm-2"
                  v-model="selectedMenu.quantity"
                  type="number"
                  min="1"
                  required
                  placeholder="Enter quantity"
                ></b-form-input>

                <div v-on:click="plusQuantity()" id="button-plus" class="col-sm-1">+</div>
              </div>

              <h6
                style="margin-bottom: 20px"
              >Total: Rp {{ selectedMenu.price * selectedMenu.quantity }}</h6>
            </div>

            <b-button class="button-ya" v-on:click="handleOk">Pesan Sekarang</b-button>
          </b-modal>
        </div>
      </div>
      <!---CONTAINER END -->
    </div>
    <!--- content end -->
    <div class="button-cart" v-on:click="goToMyCart">
      <img src="@/assets/cart.png" alt="Cart" />
    </div>
    <Footer style="padding-bottom: 20px" />
  </div>
</template>

<script>
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import { getMenuPromo } from "@/services";
import Cookies from "js-cookie";

export default {
  name: "Promo",
  components: {
    Navbar,
    Footer
  },
  data() {
    return {
      slide: 0, 
      sliding: null,
      menusPromo: [],
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
    async getMenuPromo() {
      try {
        let res = await getMenuPromo();
        if (res.status >= 200 && res.status < 300) {
          this.menusPromo = res.data.promo;
          console.log("promo is");
          console.log(res.data.promo);
        }
      } catch (err) {
        console.log(err);
      }
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
    },
    goToDetail: function(id) {
      this.$router.push("/detailmenu/" + id);
    },
    goToMyCart() {
      this.$router.push("/mycart");
    },
    onSlideStart() {
      //dari referensinya pake parameter slide tapi gak work disini karena variable slide gak dipake
      //https://bootstrap-vue.js.org/docs/components/carousel/
      //   slide
      this.sliding = true;
    },
    onSlideEnd() {
      //dari referensinya pake parameter slide tapi gak work disini karena variable slide gak dipake
      //https://bootstrap-vue.js.org/docs/components/carousel/
      //   slide
      this.sliding = false;
    }
  },
  mounted: function() {
    this.$root.$emit("doesnt need logo", "there sidebar");
    this.getMenuPromo();
  }
};
</script>

<style  scoped>
#app #promo {
  background-color: #282828;
  min-height: 100vh;
  height: auto;
}
#app .content {
  color: white;
  padding-bottom: 80px;
  padding-top: 100px;
}

#app .carousel {
  /* position:  absolute; */
  width: 100%;
  margin-top: -60px;
  z-index: 0 !important;
}
/* override carousel indicator yang bulet */
#app .carousel >>> li {
  border-radius: 50%;
  width: 10px;
  height: 10px;
  border: 20px solid transparent;
}

#app #menu-promo {
  margin-top: 200px;
}

#app h4 {
  margin-bottom: 40px;
}

#app .navbar-light >>> .navbar-brand {
  color: red !important;
}

#app .title-1 {
  margin-bottom: 200px;
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

#button-minus {
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

#button-plus {
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

/* Custom Scrollbar */
/* width */
::-webkit-scrollbar {
  width: 20px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #bf9e6b; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #9b7843;
}
</style>
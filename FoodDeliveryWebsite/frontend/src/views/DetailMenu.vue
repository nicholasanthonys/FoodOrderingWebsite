<template>
  <div class="detail-menu">
    <!---Sidebar-->
    <Sidebar />
    <div class="content">
      <!-- Navbar -->
      <Navbar id="navbar" />

      <b-row class="detail-menu-row">
        <b-col cols="4">
          <b-img class="menu-img" thumbnail fluid v-bind:src="menu.url_image" rounded="Bottom-rounded image"></b-img>
        </b-col>

        <b-col cols="8">
          <h5 class="title"> {{ menu.name }} </h5>
          <h6 class="price"> {{ menu.price }} </h6>
          <div class="description">
            <p> {{menu.description}} </p>
          </div>

          <div>
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
              <b-form-group
                id="input-group-1"
                label="Quantity : "
                label-for="input-1">

                <div class="form-group row" style="margin-left: 0px">
                  <div v-on:click="plusQuantity()" id="button-plus" class="col-sm-1">+</div>

                  <b-form-input
                  id="input-1"
                  class="col-sm-2"
                  v-model="quantity"
                  type="number"
                  min="1"
                  required
                  placeholder="Enter quantity">
                  </b-form-input>

                  <div v-on:click="minusQuantity()" id="button-minus" class="col-sm-1">-</div>
                </div>
              </b-form-group>

              <div class="row" style="margin-left: 0px">
                <b-button class="button-pesan col-sm-4" v-b-modal.modal-center>Pesan</b-button>
              </div>

              <div class="row" style="margin-left: 0px">
                <b-button class="button-reset col-sm-4" type="reset" variant="danger">Reset</b-button>
              </div>
            </b-form>
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
              body-bg-variant="dark"
              body-border-variant="transparent"
              content-class="shadow"
              @ok="handleOk">

              <div class="modal-header modal-title">
                <p id="b-title">Konfirmasi Pesanan Ini?</p>
              </div>

              <div class="content-modal">
                <h6>Konfirmasi pesanan anda</h6>
                <h6> {{ menu.name }} </h6>
                <h6> {{ quantity }} pcs</h6>
                <b-img class="modal-img" thumbnail fluid v-bind:src="menu.url_image" rounded></b-img>
                <h6 style="margin-bottom: 20px;">Total: Rp {{ menu.price * quantity }} </h6>
              </div>

              <b-button class="button-ya" v-on:click="handleOk">Pesan Sekarang</b-button>
            </b-modal>
          </div>

        </b-col>
      </b-row>
    </div>

    <div class="button-cart" v-on:click="goToMyCart">
      <img src="@/assets/cart.png" alt="Cart" />
    </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar";
import Sidebar from "../components/Sidebar";
import { getDetailMenu } from "@/services";
import Cookies from "js-cookie";

export default {
  components: {
    Navbar,
    Sidebar
  },
  data: function() {
    return {
      menu: "",
      quantity: 1,
      show: true,
      priceInRupiah: ""

      // name: '',
      //   nameState: null,
      //   submittedNames: []
    };
  },
  methods: {
    fillMenu: async function() {
      try {
        let id = this.$route.params.menuID;
        let res = await getDetailMenu(id);
        if (res.status >= 200 && res.status < 300) {
          this.menu = res.data.menu;
          console.log(this.menu);
        }
      } catch (err) {
        console.log(err);
      }
    },
    onSubmit(evt) {
      evt.preventDefault();
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.quantity = 1;
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },

    checkSessionExist() {
      const valid = this.$session.exists();
      console.log("valid ? " + valid);
      return valid;
    },
    // resetModal() {
    //   this.name = "";
    //   this.nameState = null;
    // },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler
      this.handleSubmit();
    },
    handleSubmit() {
      // Exit when the form isn't valid
      if (!this.checkSessionExist()) {
        alert("You have to log in first");
      } else {
        let menuOrder = {
          id: this.menu.id,
          type: this.menu.type,
          name: this.menu.name,
          url_image: this.menu.url_image,
          description: this.menu.description,
          quantity: this.quantity,
          price: this.menu.price
        };
        //push menuOrder ke cart
        let email = Cookies.get("email");
        let cart = JSON.parse(Cookies.get("cart-" + email));

        //cek apakah sudah ada di cart kalo ada tinggal tambahin quantity nya;
        let isMenuInCart = false;
        cart.forEach(element => {
          if (element.id == menuOrder.id) {
            let quantity = parseInt(element.quantity);
            quantity += parseInt(menuOrder.quantity);
            element.quantity = quantity;
            isMenuInCart = true;
          }
        });

        //jika menu tidak ada di cart maka push sebagai menu baru di cart
        if (!isMenuInCart) {
          cart.push(menuOrder);
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
      this.quantity = this.quantity + 1;
    },
    minusQuantity() {
      if (this.quantity > 1) {
        this.quantity = this.quantity - 1;
      }
    },
    goToMyCart(){
      this.$router.push('/mycart');
    }
  },
  mounted: function() {
    this.fillMenu();
    // this.convertToRupiah();

    //coba dapetin value cookie cart nya
    let email = Cookies.get("email");
    let cart = JSON.parse(Cookies.get("cart-" + email));
    console.log("my cart is");
    console.log(cart);
  }
};
</script>

<style scoped>
.detail-menu {
  /*semetara font family poppins belum ada */
  /* font-family: Poppins; */
  width: auto;
  height: auto;
  min-height: 100vh;
  padding-bottom: 20px;
  background-color: #282828;
}

.content {
  width: 85%;
  margin-left: 15%;
  color: white;
}

.detail-menu-row {
  margin-top: 20px;
  margin-right: 0px;
  margin-left: 0px;
}

.menu-img {
  display: flex;
  width: 90%;
  height: auto;
  margin-left: auto;
  margin-right: auto;
}

.title {
  color: #BF9E6B;
  font-size: 20px;
  font-weight: 500;
}

.price {
  font-size: 18px;
  color: white;
  font-weight: normal;
  margin-bottom: 38px;
}

.description {
  font-size: 15px;
  color: white;
  margin-bottom: 30px;
}

#input-1 {
  border-radius: 0px;
  border: none;
  border-bottom: 1px solid black;
  border-top: 1px solid black;
  min-width: 100px;
  max-width: 100px;
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

#button-minus:hover, #button-plus:hover {
  cursor: pointer;
  background-color: #BF9E6B;
}

#button-minus:active, #button-plus:active {
  transform: translateY(2px);
}

.button-pesan {
  margin-bottom: 20px;
  background-color: #BF9E6B;
  color: white;
  box-shadow:  0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 10px;
  max-width: 180px;
  min-width: 180px;
  transition-duration: 0.4s;
}

.button-pesan:hover, .button-ya:hover {
  transform: translateY(-1px);
  filter: brightness(85%);
  color: white;
  cursor: pointer;
}

.button-reset {
  margin-bottom: 20px;
  color: white;
  box-shadow:  0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 10px;
  max-width: 180px;
  min-width: 180px;
}

.shadow {
  background-color: #887962 !important;
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
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
}

.button-ya {
  width: 40%;
  height: 3em;
  display: block;
  margin: 0.5rem auto 1rem auto;
  background-color: #BF9E6B;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 10px;
  transition-duration: 0.4s;
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
</style>
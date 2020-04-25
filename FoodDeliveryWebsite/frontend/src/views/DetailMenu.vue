<template>
  <div class="detail-menu">
    <!---Sidebar-->
    <Sidebar />
    <div class="content">
      <!-- Navbar -->
      <Navbar id="navbar" />

      <b-row class="detail-menu-row">
        <b-col cols="4">
          <b-img thumbnail fluid v-bind:src="menu.url_image" rounded="Bottom-rounded image"></b-img>
        </b-col>

        <b-col cols="8">
          <h5 class="title">{{menu.name}}</h5>
          <h6 class="price">Rp.{{menu.price}}/pcs</h6>
          <div class="description">
            <p>{{menu.description}} Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laborum magnam optio repudiandae fugiat accusamus veniam sunt. Est possimus at incidunt vero exercitationem nulla repellendus velit sequi. Sapiente mollitia aperiam eligendi!</p>
          </div>

          <div>
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
              <b-form-group
                id="input-group-1"
                label="Quantity:"
                label-for="input-1"
                description="Order Quantity"
              >
                <b-form-input
                  id="input-1"
                  v-model="quantity"
                  type="number"
                  min="1"
                  required
                  placeholder="Enter email"
                ></b-form-input>
              </b-form-group>

              <!-- <b-button type="submit" variant="primary">Pesan</b-button> -->
              <b-button v-b-modal.modal-center>Order</b-button>
              <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
          </div>

          <div id="modal">
            <b-modal
              id="modal-center"
              ref="modal"
              centered
              title="Masukkan ke Chard ?"
              size="lg"
              @ok="handleOk"
            >
              <h6>Masukkan ke Chart ?</h6>
              <h6>{{menu.name}}</h6>
              <h6>{{quantity}} pcs</h6>
              <b-img thumbnail fluid v-bind:src="menu.url_image" rounded></b-img>
              <h6>Total Rp {{menu.price * quantity}}</h6>
            </b-modal>
          </div>
        </b-col>
      </b-row>
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
      show: true

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
      this.quantity = 0;
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
    }
  },
  mounted: function() {
    this.fillMenu();

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
  padding-bottom: 20px;
  background-color: #282828;
}

.content {
  width: 85%;
  margin-left: 15%;
  color: white;
}

.detail-menu-row {
  margin-top: 55px;
  margin-right: 0px;
  margin-left: 0px;
}
</style>
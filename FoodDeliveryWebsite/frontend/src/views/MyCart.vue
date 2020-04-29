<template>
  <div class="menu-pasta">
    <!---Sidebar-->
    <Sidebar />

    <div class="content">
      <!-- Navbar -->
      <Navbar id="navbar" />

      <!-- Content of Menu -->
      <div class="menu-row row">
        <b-card
          no-body
          class="overflow-hidden menu"
          style="max-width: 540px;"
          v-for="(menu, index) in menus"
          v-bind:key="menu.id"
        >
          <b-row no-gutters>
            <b-col md="6">
              <b-card-img v-bind:src="menu.url_image" alt="Image" class="rounded-1"></b-card-img>
            </b-col>
            <b-col md="6">
              <b-card-body v-bind:title="menu.name">
                <b-card-text>
                  <h6>{{ menu.quantity }} pcs - Rp.{{ menu.price * menu.quantity }}</h6>
                  <p class="max-lines">{{ menu.description }}</p>
                </b-card-text>
              </b-card-body>
            </b-col>
            <b-button
              class="button-edit col-sm-4"
              v-on:click="openModal('modal-center-edit',menu.id,menu.type, menu.name, menu.price, menu.url_image,menu.description,menu.quantity,index)"
            >Edit</b-button>
          </b-row>
          <b-button
            class="button-edit col-sm-4"
            v-on:click="openModal('modal-center-remove',menu.id,menu.type, menu.name, menu.price, menu.url_image,menu.description,menu.quantity,index)"
          >remove</b-button>
        </b-card>
      </div>

      <div id="modal">
        <!--- MODAL EDIT -->
        <b-modal
          id="modal-center-edit"
          class="modal-body styling=modal"
          ref="modal-center-edit"
          centered
          size="lg"
          hide-footer
          hide-header
          header-text-variant="light"
          body-text-variant="light"
          body-bg-variant="dark"
          body-border-variant="transparent"
          content-class="shadow"
          @ok="handleOk($event,'modal-center-edit')"
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

            <h6
              style="margin-bottom: 20px"
            >Total: Rp {{ selectedMenu.price * selectedMenu.quantity }}</h6>
          </div>

          <b-button class="button-ya" v-on:click="handleOk($event,'modal-center-edit')">Confirm Edit</b-button>
        </b-modal>
        <!---END MODAL EDIT -->

        <!---MODAL REMOVE -->
        <b-modal
          id="modal-center-remove"
          class="modal-body styling=modal"
          ref="modal-center-remove"
          centered
          size="lg"
          hide-footer
          hide-header
          header-text-variant="light"
          body-text-variant="light"
          body-bg-variant="dark"
          body-border-variant="transparent"
          content-class="shadow"
          @ok="handleOk"
        >
          <div class="modal-header modal-title">
            <p id="b-title">Remove item</p>
          </div>

          <div class="content-modal">
            <h6>This item will be removed from your cart</h6>

            <h6>{{ selectedMenu.name }}</h6>

            <b-img class="modal-img" thumbnail fluid v-bind:src="selectedMenu.url_image" rounded></b-img>

            <h6
              class="col-sm-4"
              style="text-align: left; padding: 0px; margin: auto 20px auto 0px;"
            >Quantity : {{selectedMenu.quantity}}</h6>

            <h6
              style="margin-bottom: 20px"
            >Total: Rp {{ selectedMenu.price * selectedMenu.quantity }}</h6>
          </div>

          <b-button
            class="button-ya"
            v-on:click="handleOk($event,'modal-center-remove')"
          >Remove this item</b-button>
        </b-modal>
        <!---END MODAL REMOVE -->

        <!--MODAL CLEAR -->
        <b-modal
          id="modal-center-clear"
          class="modal-body styling=modal"
          ref="modal-center-clear"
          centered
          size="lg"
          hide-footer
          hide-header
          header-text-variant="light"
          body-text-variant="light"
          body-bg-variant="dark"
          body-border-variant="transparent"
          content-class="shadow"
          @ok="handleOk"
        >
          <div class="modal-header modal-title">
            <p id="b-title">Remove item</p>
          </div>

          <div class="content-modal">
            <h6>All item in your cart will be lost</h6>
            <h2>Clear Cart ?</h2>
          </div>
          <b-button class="button-ya" v-on:click="handleOk($event,'modal-center-clear')">Clear Cart</b-button>
        </b-modal>
        <!---END MODAL CLEAR -->
      </div>

      <b-button v-if="menus.length != 0" class="button-order">Order</b-button>

      <b-button
        v-if="menus.length != 0"
        class="button-clear"
        @click="openModal('modal-center-clear')"
      >clear</b-button>

      <div v-if="menus.length == 0" class="empty">
        <img src="@/assets/cart.png" alt="Empty Cart" />
        <h3 class="cart-empty">Your cart is empty, please order first...</h3>
      </div>
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
      email: Cookies.get("email"),
      menus: [],
      selectedMenu: {
        id: 0,
        type: "",
        name: "",
        price: 0,
        quantity: 0,
        url_image: "",
        description: "",
        index: 0
      }
    };
  },
  methods: {
    fillMenus() {
      try {
        //get array cart from cookie
        let cart = JSON.parse(Cookies.get("cart-" + this.email));
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
    },
    openModal(
      ref,
      id,
      type,
      name,
      price,
      url_image,
      description,
      quantity,
      index
    ) {
      this.selectedMenu.id = id;
      this.selectedMenu.name = name;
      this.selectedMenu.price = price;
      this.selectedMenu.url_image = url_image;
      this.selectedMenu.type = type;
      this.selectedMenu.description = description;
      this.selectedMenu.quantity = quantity;
      this.selectedMenu.index = index;

      this.$refs[ref].show();
    },
    hideModal(ref) {
      this.$refs[ref].hide();
    },
    handleOk(bvModalEvt, ref) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler

      console.log("ref is " + ref);
      this.handleSubmit(ref);
    },
    handleSubmit(ref) {
      // Nicho tolong isi ini
      switch (ref) {
        case "modal-center-edit":
          this.menus[
            this.selectedMenu.index
          ].quantity = this.selectedMenu.quantity;
          break;

        case "modal-center-remove":
          this.menus.splice(this.selectedMenu.index, 1);
          console.log("after remove, the menu is");
          console.log(this.menus);
          break;

        case "modal-center-clear":
          this.menus = [];
          break;
      }

      //timpa nilai cookie nya
      Cookies.set("cart-" + this.email, JSON.stringify(this.menus));

      // Hide the modal manually
      this.$nextTick(() => {
        this.$refs[ref].hide();
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
  padding: 20px;
  margin-left: 5%;
  border-radius: 10px;
  background-color: #fff;
}

.button-order {
  display: block;
  width: 40%;
  height: 50px;
  margin: 20px auto 20px auto;
  transition-duration: 0.4s;
  color: white;
  background-color: #bf9e6b;
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

.empty {
  width: 100%;
  height: 100%;
}

.empty img {
  display: block;
  width: 100px;
  height: 100px;
  margin: 0px auto 20px auto;
}

.cart-empty {
  color: white;
  display: block;
  margin: auto;
  text-align: center;
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
</style>
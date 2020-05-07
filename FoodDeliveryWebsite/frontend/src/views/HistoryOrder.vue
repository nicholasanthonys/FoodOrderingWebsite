<template>
  <div class="history-order">
    <Sidebar />
    <div class="content">
      <Navbar id="navbar" />

      <!--content of menu -->
      <div class="menu-row">
        <!--card untuk menu yang diorder-->
        <b-button
          v-if="orderHistory.length != 0"
          class="button-clear"
          @click="openModal('modal-center-clear')"
        >Clear History</b-button>

        <div v-if="orderHistory.length == 0" class="empty">
          <img src="@/assets/cart.png" alt="Empty Cart" />
          <h3 class="history-empty">You haven't order anything yet...</h3>
        </div>
        
        <div class="history card" v-for="order in orderHistory" :key="order.id">
          
          <h1 class="order-date">Order Date : {{ order.order_time }} </h1>

          <p style="margin-bottom: 0px;">Your Order : </p>
          <b-card
            v-for="menu in order.menus"
            :key="menu.id"
            no-body
            class="overflow-hidden order-detail"
          >
            <b-row no-gutters>
              <b-col md="4">
                <b-card-img v-bind:src="menu.url_image" alt="Image" class="rounded-10 order-img"></b-card-img>
              </b-col>
              <b-col md="8">
                <b-card-body style="padding: 10px 20px 10px 20px">  
                  <b-card-text class="order-name"> {{ menu.name }} </b-card-text>
                  <b-card-text class="order-description"> {{ menu.description }} </b-card-text>
                  <b-card-text class="order-quantity">Quantity <span style="padding-left: 9px" /> : {{ menu.pivot.quantity }} pcs</b-card-text>
                  <b-card-text class="order-price">Price <span style="padding-left: 32px" /> : Rp {{ menu.pivot.price }}/pcs</b-card-text>
                  <b-card-text class="order-subtotal">Subtotal <span style="padding-left: 10px" /> : Rp {{ menu.pivot.price * menu.pivot.quantity }} </b-card-text>
                </b-card-body>
              </b-col>
            </b-row>
          </b-card>
          <div class="row" style="margin-left: 0px; margin-top: 10px;">
            <h1 class="order-total col-sm-4">Total Price </h1>
            <h1 class="order-total col-sm-8"> : {{ order.total_price}}</h1>
          </div>
        </div>
      </div>

      <div id="modals">
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
          body-border-variant="transparent"
          content-class="shadow"
          @ok="handleOk"
        >
          <div class="modal-header modal-title">
            <p id="b-title">Clear History Order</p>
          </div>

          <div class="content-modal">
            <h6>All your order history will be lost</h6>
            <h5 style="font-weight: bold;">Are you sure?</h5>
          </div>
          <b-button class="button-ya" v-on:click="handleOk($event, 'modal-center-clear')">Clear Cart</b-button>
        </b-modal>
        <!---END MODAL CLEAR -->
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar";
import Sidebar from "../components/Sidebar";
import Cookies from "js-cookie";
import { loadOrderHistory, clearOrderHistory } from "@/services";
export default {
  components: {
    Navbar,
    Sidebar
  },
  data: function() {
    return {
      email: Cookies.get("email"),
      orderHistory: []
    };
  },
  methods: {
    async loadHistory() {
      try {
        let res = await loadOrderHistory(this.email);
        if (res.status >= 200 && res.status < 300) {
          this.orderHistory = res.data;
          console.log("order hisotry");
          console.log(this.orderHistory);
        }
      } catch (err) {
        console.log(err);
      }
    },
    async clearHistory() {
      try {
        let res = await clearOrderHistory(this.email);
        if (res.status >= 200 && res.status < 300) {
          console.log("Message");
          console.log(res.data.message);
          console.log("email response");
          console.log(res.data.email);
          this.orderHistory = [];
        }
      } catch (err) {
        console.log(err);
      }
    },
    openModal(ref) {
      console.log("opening modal " + ref);
      this.$refs[ref].show();
    },
    handleOk(bvModalEvt, ref) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler

      console.log("ref is " + ref);
      this.handleSubmit(ref);
    },
    handleSubmit(ref) {
      switch (ref) {
        case "modal-center-clear":
          console.log("anda memencet clear");
          this.clearHistory();
          break;
      }

      // Hide the modal manually
      this.$nextTick(() => {
        this.$refs[ref].hide();
      });
    }
  },
  mounted() {
    this.loadHistory();
    this.$root.$emit("doesnt need logo", "there sidebar");
    console.log("email is " + this.email);
  }
};
</script>

<style scoped>
.history-order {
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
  color: white;
}

.menu-row {
  margin-top: 20px;
  margin-right: 0px;
  margin-left: 0px;
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

.button-clear {
  display: block;
  width: 40%;
  height: 50px;
  margin: 20px auto 20px auto;
  transition-duration: 0.4s;
  color: white;
  background-color: #bf9e6b;
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
  padding-left: 3em;
  padding-right: 3em;
}

.history {
  width: 80%;
  margin: 20px auto 20px auto;
  padding: 20px;
  color: black;
}

.order-date, .order-total {
  font-size: 18px;
  font-weight: bold;
}

.order-img {
  width: 100%;
  height: 160px;
  object-fit: fill;
  -o-object-fit: fill;
  display: block;
  margin: auto;
}

.order-detail {
  width: 100%;
  margin: 5px auto 5px auto;
  height: 160px;
}

.order-name {
  font-weight: bold;
  font-size: 16px;
  margin-bottom: 5px;
}

.order-description {
  text-overflow: ellipsis;
  overflow: hidden;
  word-wrap: break-word;
  display: -webkit-box;
  display: -moz-box;
  line-height: 14px;
  font-size: 14px;
  max-height: 32px;
  line-clamp: 2;
  -webkit-line-clamp: 2;
  -moz-box-orient: vertical;
  -webkit-box-orient: vertical;
  margin-bottom: 5px;
}

.order-quantity, .order-price, .order-subtotal {
  margin-bottom: 5px;
  font-size: 14px;
}

.order-total {
  padding: 0px;
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

.history-empty {
  color: white;
  display: block;
  margin: auto;
  text-align: center;
}
</style>
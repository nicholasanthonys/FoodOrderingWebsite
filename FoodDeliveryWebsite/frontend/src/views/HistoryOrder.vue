<template>
  <div class="history-order">
    <Sidebar />
    <div class="content">
      <Navbar id="navbar" />

      <!--content of menu -->
      <div class="menu-row row">
        <!--card untuk menu yang diorder-->
        <b-button
          v-if="orderHistory.length != 0"
          class="button-clear"
          @click="openModal('modal-center-clear')"
        >Clear History</b-button>
        <div v-for="order in orderHistory" :key="order.id">
          <h1>{{order.order_time}}</h1>
          <b-card
            v-for="menu in order.menus"
            :key="menu.id"
            no-body
            class="overflow-hidden"
            style="max-width: 100%;height:300px;margin:auto;margin-bottom:40px; color:black"
          >
            <b-row no-gutters>
              <b-col md="6">
                <b-card-img v-bind:src="menu.url_image" alt="Image" class="rounded-0"></b-card-img>
              </b-col>
              <b-col md="6">
                <b-card-body v-bind:title="menu.name">
                  <b-card-text>{{menu.description}}</b-card-text>
                  <b-card-text>quantity : {{menu.pivot.quantity}} pcs</b-card-text>
                  <b-card-text>price : {{menu.pivot.price}}/pcs</b-card-text>
                  <b-card-text>subtotal : {{menu.pivot.price * menu.pivot.quantity}}/pcs</b-card-text>
                </b-card-body>
              </b-col>
            </b-row>
          </b-card>
          <h1>Total Price :{{ order.total_price}}</h1>
          <!--ini garis lex-->
          <div class="line-break" style="background-color:white;width:100%;height:10px;"></div>
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

.menu {
  margin-bottom: 30px;
  width: 100%;
  height: auto;
  padding: 10px 20px 20px 20px;
  margin-left: 5%;
  border-radius: 10px;
  background-color: #fff;
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
</style>
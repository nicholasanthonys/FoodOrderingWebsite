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
          <h6 class="price">{{menu.price}}</h6>
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
              <b-button v-b-modal.modal-center>Open Modal</b-button>
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
              @show="resetModal"
              @hidden="resetModal"
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

    // checkFormValidity() {
    //   const valid = this.$refs.form.checkValidity();
    //   this.nameState = valid;
    //   return valid;
    // },
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
      // if (!this.checkFormValidity()) {
      //   return;
      // }

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
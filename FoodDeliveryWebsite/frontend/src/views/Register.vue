<template>
<body>
  <Navbar />
  <b-container>
    <b-row>
      <b-col></b-col>
      <b-col class="mt-5">
        <h1 class="title">Sign Up</h1>
        <p class="title mt-5">{{message}}</p>
        <div class="form">
          <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <!---Fullname -->
            <b-form-group id="input-group-fullname" class="input-title" label-for="input-0">
              <b-form-input
                id="register-fullname"
                v-model="fullname"
                type="text"
                required
                placeholder="Full Name"
              ></b-form-input>
            </b-form-group>
            <!---end of fullname -->

            <!--- email -->
            <b-form-group id="input-group-email" class="input-title" label-for="input-1">
              <b-form-input
                id="login-email"
                v-model="email"
                type="email"
                required
                placeholder="Email"
              ></b-form-input>
            </b-form-group>
            <!--- end of email -->

            <!--- password -->
            <b-form-group id="input-group-password" class="input-title" label-for="input-1">
              <b-form-input
                id="login-password"
                v-model="password"
                type="password"
                placeholder="Password"
                required
              ></b-form-input>
            </b-form-group>
            <!-- end of password -->

            <!--- confirm password -->
            <b-form-group id="input-group-confirm-password" class="input-title" label-for="input-1">
              <b-form-input
                id="confirm-password"
                v-model="confirmPassword"
                type="password"
                placeholder="Retype Password"
                required
              ></b-form-input>
            </b-form-group>
            <!-- end of confirm password -->

            <!---date of birth --->
            <b-form-group id="input-group-dob" class="input-title" label-for="input-1">
              <b-form-datepicker
                id="example-datepicker"
                v-model="DOB"
                class="mb-2"
                placeholder=" Date Of Birth"
              ></b-form-datepicker>
            </b-form-group>
            <!--- end of date of birth -->

            <!---address -->
            <b-form-group id="input-group-address" class="input-title" label-for="input-0">
              <b-form-input
                id="register-fullname"
                v-model="address"
                type="text"
                required
                placeholder="Address"
              ></b-form-input>
            </b-form-group>
            <!---end of address -->

            <!---province -->
            <b-form-group id="input-group-province" class="input-title" label-for="input-0">
              <model-select :options="provinceOptions" v-model="province" placeholder="Province"></model-select>
            </b-form-group>
            <!---end of province -->

            <!---city -->
            <b-form-group id="input-group-city" class="input-title" label-for="input-0">
              <modelSelect
                v-if="province == null "
                :options="cityOptions"
                v-model="city"
                placeholder="City"
                :isDisabled="true"
              ></modelSelect>
              <modelSelect v-else :options="cityOptions" v-model="city" placeholder="City"></modelSelect>
            </b-form-group>
            <!---end of city -->

            <b-button
              pill
              block
              id="btn-login-submit"
              class="mt-5"
              type="submit"
              variant="info"
            >Submit</b-button>
          </b-form>
        </div>
      </b-col>
      <b-col></b-col>
    </b-row>
  </b-container>
</body>
</template>

<script>
import Navbar from "../components/Navbar";
import { ModelSelect } from "vue-search-select";

import { getProvincies, getCitiesByProvince } from "@/services";

export default {
  components: {
    Navbar,
    ModelSelect
  },
  data() {
    return {
      message: "Hello, Let's Join",

      fullname: "",
      email: "",
      password: "",
      confirmPassword: "",
      DOB: "",
      address: "",
      province: null,
      city: null,

      provinceOptions: [],

      cityOptions: [{ id: 0, text: "Select Province First" }],

      show: true
    };
  },
  watch: {
    // whenever province changes, this function will run
    province: function() {
      console.log(this.province);
      let idProvince = this.province;
      this.fillCityOptions(idProvince);
    }
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      // alert(JSON.stringify(this.form));
      this.authenticationUser();
    },
    fillProvinceOptions: async function() {
      try {
        let resp = await getProvincies();
        if (resp.status >= 200 && resp.status < 300) {
          this.provinceOptions = resp.data.provinces;
        }
      } catch (err) {
        console.log(err);
      }
    },
    fillCityOptions: async function(idProvince) {
      try {
        let resp = await getCitiesByProvince(idProvince);
        if (resp.status >= 200 && resp.status < 300) {
          console.log(resp.data);
          this.cityOptions = resp.data.cities;
        }
      } catch (err) {
        console.log(err);
      }
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.email = "";
      this.password = "";
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    }
  },
  mounted: function() {
    this.fillProvinceOptions();
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#app .title {
  text-align: center;
  color: white;
}
#app .input-title {
  color: white;
}

#app #btn-login-submit {
  background-color: #bf9e6b;
}

body {
  background: linear-gradient(
      to bottom,
      rgba(11, 11, 11, 0.5),
      rgba(11, 11, 11, 0.5)
    ),
    url("../assets/bg-register.png");
  height: 100vh;
  background-size: cover !important;
}
</style>

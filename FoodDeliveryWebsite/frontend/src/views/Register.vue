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
            <!---name -->
            <b-form-group id="input-group-name" class="input-title" label-for="input-0">
              <b-form-input
                id="register-name"
                v-model="name"
                type="text"
                required
                placeholder="Full Name"
              ></b-form-input>
            </b-form-group>
            <!---end of name -->

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
                id="register-name"
                v-model="address"
                type="text"
                required
                placeholder="Address"
              ></b-form-input>
            </b-form-group>
            <!---end of address -->

            <!---province -->
            <b-form-group id="input-group-province" class="input-title" label-for="input-0">
              <model-select :options="provinceOptions" v-model="province" placeholder="Province" size="3"></model-select>
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
              style="margin-bottom: 10px"
            >Submit</b-button>

            <span style="display: block; text-align: center; color: white; margin-bottom: 50px;">
              Already Have an Account? Login
              <router-link to="/" class="link">Here</router-link>
            </span>
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

import { getProvincies, getCitiesByProvince, registerUser } from "@/services";

export default {
  components: {
    Navbar,
    ModelSelect
  },
  data() {
    return {
      message: "Hello, Let's Join",

      name: "",
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
      let isFormValidated = this.validateRegisterForm();
      console.log("isform validated " + isFormValidated);
      if (isFormValidated) {
        let form = {
          name: this.name,
          email: this.email,
          password: this.password,
          dob: this.DOB,
          address: this.address,
          province: this.city,
          city: this.city
        };
        this.register(form);
      }
    },
    validateRegisterForm: function() {
      //check if string has value
      console.log('panjang name ' + this.name.length)
      console.log('trim ?' + this.name.trim());
      if (
        //cek apakah nama kosong atau hanya mengandung spasi
        (this.name.trim()) &&
        this.email &&
        this.password &&
        this.confirmPassword &&
        this.DOB &&
        this.address &&
        this.province &&
        this.city
      ) {
        if (this.password != this.confirmPassword) {
          this.message = "password doesn't match!";
          return false;
        }
        return true;
      } else {
        this.message = "please fill all the input";
        console.log("input kosong");
        return false;
      }
    },
    register: async function(form) {
      try {
        let resp = await registerUser(form);
        if (resp.status >= 200 && resp.status < 300) {
          console.log(resp.data);
          //redirect to login page
          this.$router.push("/");
        }
      } catch (err) {
        this.message = "register failed";

        console.log(err);
      }
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
  height: auto;
  min-height: 100vh;
  background-size: cover !important;
  background-attachment: fixed;
  background-repeat: no-repeat;
  overflow: auto;
  padding-bottom: 50px;
}

.link {
  color: #BF9E6B;
  font-weight: bold;
}

.link:hover {
  text-decoration: underline #BF9E6B;
}

.link:active {
  color: #887962;
  text-decoration: underline #887962;
}
</style>

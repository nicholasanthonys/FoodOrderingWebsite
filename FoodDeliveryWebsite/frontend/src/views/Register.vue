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
                v-model="form.fullname"
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
                v-model="form.email"
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
                v-model="form.password"
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
                v-model="form.confirmPassword"
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
                v-model="form.DOB"
                class="mb-2"
                placeholder=" Date Of Birth"
              ></b-form-datepicker>
            </b-form-group>
            <!--- end of date of birth -->

            <!---address -->
            <b-form-group id="input-group-address" class="input-title" label-for="input-0">
              <b-form-input
                id="register-fullname"
                v-model="form.address"
                type="text"
                required
                placeholder="Address"
              ></b-form-input>
            </b-form-group>
            <!---end of address -->

            <!---province -->
            <b-form-group id="input-group-province" class="input-title" label-for="input-0">
              <model-select
                :options="provinceOptions"
                v-model="form.province"
                placeholder="Province"
              ></model-select>
            </b-form-group>
            <!---end of province -->

            <!---city -->
            <b-form-group id="input-group-city" class="input-title" label-for="input-0">
              <model-select :options="cityOptions" v-model="form.city" placeholder="City"></model-select>
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
          <!-- <b-card class="mt-3" header="Form Data Result">
            <pre class="m-0">{{ form }}</pre>
          </b-card>-->
        </div>
      </b-col>
      <b-col></b-col>
    </b-row>
  </b-container>
</body>
</template>

<script>
import Navbar from "../components/Navbar";
import { authentication } from "@/services";

import { ModelSelect } from "vue-search-select";

export default {
  components: {
    Navbar,
    ModelSelect
  },
  data() {
    return {
      message: "Hello, Let's Join",
      form: {
        fullname: "",
        email: "",
        password: "",
        confirmPassword: "",
        DOB: "",
        address: "",
        province: null,
        city: null
      },
      provinceOptions: [
        { value: "a", text: "This is First option" },
        { value: "b", text: "Selected Option" },
        { value: { C: "3PO" }, text: "This is an option with object value" },
        { value: "d", text: "This one is disabled", disabled: true }
      ],

      cityOptions: [
        { value: "a", text: "This is First option" },
        { value: "b", text: "Selected Option" },
        { value: { C: "3PO" }, text: "This is an option with object value" },
        { value: "d", text: "This one is disabled", disabled: true }
      ],

      show: true
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      // alert(JSON.stringify(this.form));
      this.authenticationUser();
    },
    authenticationUser: async function() {
      try {
        let res = await authentication(this.form);
        console.log("response is ");
        this.user = res.data.user;
        if (this.user != null) {
          //session start
          this.$session.start();

          //redirect
          this.$router.push("/home");
        } else {
          this.message = "Log In Failed";
          //destroy session
          this.$session.destroy();
        }
      } catch (error) {
        console.error(error);
      }
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.email = "";
      this.form.password = "";
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    }
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

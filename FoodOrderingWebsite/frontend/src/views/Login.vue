<template>
<body>
  <Navbar />
  <b-container>
    <b-row>
      <b-col></b-col>
      <b-col class="mt-5">
        <h1 class="title">Log In</h1>
        <p class="title mt-5">{{message}}</p>
        <div class="form">
          <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <b-form-group
              id="input-group-1"
              class="input-title"
              label="Email address:"
              label-for="input-1"
            >
              <b-form-input
                id="login-email"
                v-model="form.email"
                type="email"
                required
                placeholder="Email"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="input-group-1"
              class="input-title"
              label="Password:"
              label-for="input-1"
            >
              <b-form-input
                id="login-password"
                v-model="form.password"
                type="password"
                placeholder="Password"
                required
              ></b-form-input>
            </b-form-group>

            <b-button
              pill
              block
              id="btn-login-submit"
              class="mt-5"
              type="submit"
              variant="info"
            >Submit</b-button>
          </b-form>

          <span style="display: block; text-align: center; color: white; margin-top: 10px;">
            Don't Have an Account? Register
            <router-link to="/register" class="link">Here</router-link>
          </span>

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
import { loginUser } from "@/services";
import Cookies from "js-cookie";

export default {
  components: {
    Navbar
  },
  data() {
    return {
      message: "Welcome Back, Guess",
      form: {
        email: "",
        password: ""
      },
      user: null,
      show: true
    };
  },
  beforeCreate: function() {
    //kalo session ada redirect ke home
    if (this.$session.exists()) {
      this.$router.push("/home");
    }
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      // alert(JSON.stringify(this.form));
      this.authenticationUser();
    },

    authenticationUser: async function() {
      try {
        let res = await loginUser(this.form);
        console.log("response is ");
        this.user = res.data.user;
        if (this.user != null) {
          //session start
          this.$session.start();

          //redirect
          this.$router.push("/home");

          //set email cookie
          Cookies.set("email", this.form.email);
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
    url("../assets/backgroundLanding.png");
  height: auto;
  min-height: 100vh;
  background-size: cover !important;
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

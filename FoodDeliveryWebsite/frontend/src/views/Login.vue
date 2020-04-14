<template>
<body>
  <div></div>
  <b-container >
    <b-row>
      <b-col></b-col>
      <b-col class="mt-5">
        <h1 class="title">Log In</h1>
        <p class ="title mt-5">Welcome Back, Guess</p>
        <div class="form">
          <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <b-form-group
              id="input-group-1"
              class="input-title"
              label="Email address:"
              label-for="input-1"
              description="We'll never share your email with anyone else."
            >
              <b-form-input
                id="login-email"
                v-model="form.email"
                type="email"
                required
                placeholder="Enter email"
              ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" class = "input-title" label="Your Name:" label-for="input-2">
              <b-form-input id="input-2" v-model="form.name" required placeholder="Password"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-3" label="Food:" label-for="input-3">
              <b-form-select id="input-3" v-model="form.food" :options="foods" required></b-form-select>
            </b-form-group>

            <b-form-group id="input-group-4">
              <b-form-checkbox-group v-model="form.checked" id="checkboxes-4">
                <b-form-checkbox value="me">Check me out</b-form-checkbox>
                <b-form-checkbox value="that">Check that out</b-form-checkbox>
              </b-form-checkbox-group>
            </b-form-group>

            <b-button type="submit" variant="info">Submit</b-button>
            <b-button type="reset" variant="danger">Reset</b-button>
          </b-form>
          <b-card class="mt-3" header="Form Data Result">
            <pre class="m-0">{{ form }}</pre>
          </b-card>
        </div>
      </b-col>
      <b-col></b-col>
    </b-row>
  </b-container>
</body>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      form: {
        email: "",
        name: "",
        food: null,
        checked: []
      },
      foods: [
        { text: "Select One", value: null },
        "Carrots",
        "Beans",
        "Tomatoes",
        "Corn"
      ],
      show: true
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      alert(JSON.stringify(this.form));
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.email = "";
      this.form.name = "";
      this.form.food = null;
      this.form.checked = [];
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
#app .form {
  /* background-color: red;
  z-index: 2; */
}

#app .title {
  text-align:center;
  color:white;
}
#app  .input-title{
  color: white;
}
body {
  background-image: linear-gradient(
      to bottom,
      rgba(11, 11, 11, 0.5),
      rgba(11, 11, 11, 0.5)
    ),
    url("../assets/backgroundLanding.png");

  position: relative;
  height: 700px;
  background-size: cover;
}
</style>

<template>
  <div class="update-password-container">
    <ProfileSidebar />
    <div class="content">
      <Navbar id="navbar" />

      <h1 class="content-title">Update your password</h1>

      <b-container>
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
          <!--------input name ---->
          <b-form-group id="input-group-0" class="input-row" label-for="input-0">
            <img src="../assets/password.png" class="icon" alt="Password" />
            <b-form-input
              id="update-name"
              v-model="form.currentPassword"
              type="password"
              class="icon-holder"
              required
              placeholder="Old Password"
            ></b-form-input>
          </b-form-group>
          <!-------END input name ---->

          <!--------input email ---->
          <b-form-group id="input-group-1" class="input-row" label-for="input-1">
            <img src="../assets/password.png" class="icon" alt="Password" />
            <b-form-input
              id="update-email"
              v-model="form.newPassword"
              type="password"
              class="icon-holder"
              required
              placeholder="New Password"
            ></b-form-input>
          </b-form-group>
          <!--------END input email ---->

          <!--------input email ---->
          <b-form-group
            id="input-group-2"
            class="input-row"
            label-for="input-2"
            style="margin-bottom: 70px"
          >
            <img src="../assets/password.png" class="icon" alt="Password" />
            <b-form-input
              id="update-email"
              v-model="form.confirmNewPassword"
              type="password"
              class="icon-holder"
              required
              placeholder="Confirm New Password"
            ></b-form-input>
          </b-form-group>
          <!--------END input email ---->

          <b-button block id="btn-update-password" class="mt-5" type="submit" variant="info">Confirm</b-button>

          <b-button block id="btn-cancel" class="mt-5" @click="onReset" variant="info">Cancel</b-button>
        </b-form>
      </b-container>
    </div>
  </div>
</template>

<script>
import ProfileSidebar from "@/components/ProfileSidebar";
import Navbar from "@/components/Navbar";
import Cookies from "js-cookie";
import { updatePassword } from "@/services";

export default {
  name: "UpdatePassword",
  components: {
    ProfileSidebar,
    Navbar
  },
  data() {
    return {
      email: Cookies.get("email"),
      form: {
        currentPassword: "",
        newPassword: "",
        confirmNewPassword: ""
      },
      show: true
    };
  },
  methods: {
    async updatePassword() {
      try {
        let res = await updatePassword(
          this.email,
          this.form.currentPassword,
          this.form.newPassword
        );
        if (res.status >= 200 && res.status < 300) {
          alert(res.data.status);
        }
      } catch (err) {
        console.log(err);
      }
    },
    onSubmit(evt) {
      evt.preventDefault();
      // alert(JSON.stringify(this.form));

      if (this.form.newPassword == this.form.confirmNewPassword) {
        this.updatePassword();
      } else {
        alert("Password doesnt match");
      }
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      console.log("on reset clicked");
      this.form.currentPassword = "";
      this.form.newPassword = "";
      this.form.confirmNewPassword = "";
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    }
  },
  mounted() {
    console.log("email : " + this.email);
    this.$root.$emit("doesnt need logo", "there sidebar");
  }
};
</script>

<style scoped>
.update-password-container {
  /*semetara font family poppins belum ada */
  /* font-family: Poppins; */
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
}

.content {
  width: 85%;
  margin-left: 15%;
}

.container {
  color: white !important;
}

.content-title {
  text-align: center;
  color: white;
  font-size: 48px;
  font-weight: 300;
  line-height: 72px;
  margin-bottom: 50px;
}

#btn-update-password {
  width: 30vw;
  height: 50px;
  border-radius: 10px;
  margin: 0px auto 40px auto;
  background-color: #bf9e6b;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  font-weight: 500;
  font-size: 18px;
  line-height: 27px;
  letter-spacing: 0.2em;
  color: white;
  text-align: center;
  display: block;
  border: 1px solid transparent;
}

#btn-update-password:hover {
  cursor: pointer;
  filter: brightness(90%);
  text-decoration: none;
}

#btn-cancel {
  width: 30vw;
  height: 50px;
  border-radius: 10px;
  margin: 0px auto 40px auto;
  background-color: #c9c5c1;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  font-weight: 500;
  font-size: 18px;
  line-height: 27px;
  letter-spacing: 0.2em;
}

#btn-cancel:hover {
  cursor: pointer;
  filter: brightness(90%);
}

.input-row {
  margin-bottom: 30px;
  position: relative;
  width: 30vw;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.icon {
  width: 25px;
  height: 25px;
  position: absolute;
  top: 6.5px;
  left: 12.5px;
  z-index: 2;
}

.icon-holder,
input.search {
  height: 38px;
  padding-left: 50px;
}
</style>
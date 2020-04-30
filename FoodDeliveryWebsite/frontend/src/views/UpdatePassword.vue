<template>
  <div class="update-password-container">
    <ProfileSidebar />
    <div class="content">
      <Navbar id="navbar" />
      <b-container>
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
          <!--------input name ---->
          <b-form-group
            id="input-group-0"
            class="input-title"
            label="Current Password:"
            label-for="input-0"
          >
            <b-form-input
              id="update-name"
              v-model="form.currentPassword"
              type="password"
              required
              placeholder="Enter your current password"
            ></b-form-input>
          </b-form-group>
          <!-------END input name ---->

          <!--------input email ---->
          <b-form-group
            id="input-group-1"
            class="input-title"
            label="New Password:"
            label-for="input-1"
          >
            <b-form-input
              id="update-email"
              v-model="form.newPassword"
              type="password"
              required
              placeholder="Enter your new password"
            ></b-form-input>
          </b-form-group>
          <!--------END input email ---->

          <b-button
            pill
            block
            id="btn-update-profile"
            class="mt-5"
            type="submit"
            variant="info"
          >Confirm</b-button>

          <b-button
            pill
            block
            id="btn-update-profile"
            class="mt-5"
            @click="onReset"
            variant="info"
          >Cancel</b-button>
        </b-form>
      </b-container>
    </div>
  </div>
</template>

<script>
import ProfileSidebar from "@/components/ProfileSidebar";
import Navbar from "@/components/Navbar";
import Cookies from "js-cookie";
import {updatePassword}  from '@/services';

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
        newPassword: ""
      },
      show: true
    };
  },
  methods: {
    async updatePassword (){
        try{
            let res = await updatePassword(this.email, this.form.newPassword);
            if(res.status >=200 && res.status <300){
                alert('Update Password Berhasil');
            }
        }catch(err){
            console.log(err);
        }
    },
    onSubmit(evt) {
      evt.preventDefault();
      // alert(JSON.stringify(this.form));

      if(this.form.newPassword == this.form.currentPassword){
          this.updatePassword();
      }else{
          alert('Password doesnt match');
      }
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      console.log("on reset clicked");
      this.form.currentPassword = "";
      this.form.newPassword = "";
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    }
  },
  mounted(){
      console.log("email : " + this.email);
  }
};
</script>

<style scoped>
.update-password-container {
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

.container {
  color: white !important;
}
</style>
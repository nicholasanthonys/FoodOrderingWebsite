<template>
  <div class="profile-container">
    <ProfileSidebar :name="name" />
    <div class="content">
      <Navbar id="navbar" />

      <h1 class="content-title">Edit your profile</h1>

      <b-container>
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">

          <div class="row" style="margin-bottom: 70px">
            <!-- Left side -->
            <div class="col-sm-6" style="padding: 0px 5vw 0px 5vw">
              <!--------input name ---->
              <b-form-group id="input-group-0" class="input-row">
                <img src="../assets/username.png" class="icon" alt="Username" />
                <b-form-input id="update-name" class="icon-holder" v-model="name" type="text" required placeholder="Name"></b-form-input>
              </b-form-group>
              <!-------END input name ---->

              <!--------input email ---->
              <b-form-group
                id="input-group-1"
                class="input-row"
              >
                <img src="../assets/email.png" class="icon" alt="Email" />
                <b-form-input
                  id="update-email"
                  class="icon-holder"
                  v-model="email"
                  disabled
                  type="email"
                  required
                  placeholder="Email"
                ></b-form-input>
              </b-form-group>
              <!--------END input email ---->

              <!---date of birth --->
              <b-form-group id="input-group-dob" class="input-row" label-for="input-1">
                <b-form-datepicker
                  id="example-datepicker"
                  v-model="DOB"
                  class="mb-2"
                  placeholder="Date Of Birth"
                ></b-form-datepicker>
              </b-form-group>
              <!--- end of date of birth -->
            </div>

            <!-- Right side -->
            <div class="col-sm-6" style="padding: 0px 5vw 0px 5vw">
              <!---address -->
              <b-form-group id="input-group-address" class="input-row" label-for="input-0">
                <img src="../assets/home.png" class="icon" alt="Home Address" />
                <b-form-input
                  id="register-name"
                  class="icon-holder"
                  v-model="address"
                  type="text"
                  required
                  placeholder="Address"
                ></b-form-input>
              </b-form-group>
              <!---end of address -->

              <!---province -->
              <b-form-group id="input-group-province" class="input-row" label-for="input-0">
                <img src="../assets/location.png" class="icon" alt="Province" />
                <model-select class="icon-holder" :options="provinceOptions" v-model="province" placeholder="Province"></model-select>
              </b-form-group>
              <!---end of province -->

              <!---city -->
              <b-form-group id="input-group-city" class="input-row" label-for="input-0">
                <img src="../assets/city.png" class="icon" alt="City" />
                <modelSelect
                  v-if="province == null "
                  :options="cityOptions"
                  placeholder="City"
                  :isDisabled="true"
                  class="icon-holder"
                ></modelSelect>
                <modelSelect v-else class="icon-holder" :options="cityOptions" v-model="city"></modelSelect>
              </b-form-group>
              <!---end of city -->
            </div>
          </div>
          
          <b-button
            block
            id="btn-update-profile"
            type="submit"
            variant="info"
          >Confirm</b-button>

          <router-link
            id="btn-update-password"
            type="submit"
            variant="info"
            to="/updatepassword"
          >Update Password</router-link>

          <b-button
            block
            id="btn-cancel"
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
import { ModelSelect } from "vue-search-select";
import {
  getProvincies,
  getCitiesByProvince,
  getUser,
  updateProfile
} from "@/services";
import Cookies from "js-cookie";
export default {
  name: "Profile",
  components: {
    ProfileSidebar,
    Navbar,
    ModelSelect
  },
  data() {
    return {
      name: "",
      email: Cookies.get("email"),
      DOB: "",
      address: "",
      province: "",
      city: "",

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
    async getUser() {
      try {
        let resp = await getUser(this.email);
        if (resp.status >= 200 && resp.status < 300) {
          this.name = resp.data.user.name;
          this.DOB = resp.data.user.dob;
          this.address = resp.data.user.address;
          this.province = resp.data.user.province;
          this.city = resp.data.user.city;
        }
      } catch (err) {
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
    async updateProfile() {
      let form = {
        name: this.name,
        email: this.email,
        DOB: this.DOB,
        address: this.address,
        province: this.province,
        city: this.city
      };

      try {
        let resp = await updateProfile(form);
        if (resp.status >= 200 && resp.status < 300) {
         alert('update berhasil');
         console.log(resp.data);
         this.getUser();
        }
      } catch (err) {
        console.log(err);
      }
    },
    onSubmit(evt) {
      evt.preventDefault();
      // alert(JSON.stringify(this.form));
      this.updateProfile();
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values

      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    }
  },
  mounted: function() {
    var that = this;
    this.fillProvinceOptions().then(() => {
      that.getUser();
    });
    this.$root.$emit('doesnt need logo', 'there sidebar');
  }
};
</script>

<style scoped>
.profile-container {
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

.content-title {
  text-align: center;
  color: white;
  font-size: 48px;
  font-weight: 300;
  line-height: 72px;
  margin-bottom: 50px;
}

.container {
  color: white !important;
}

.input-row {
  margin-bottom: 30px;
  position: relative;
}

#btn-update-profile, #btn-update-password {
  width: 30vw;
  height: 50px;
  border-radius: 10px;
  margin: 0px auto 40px auto;
  background-color: #BF9E6B;
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

#btn-update-password {
  line-height: 50px;
}

#btn-update-profile:hover, #btn-update-password:hover {
  cursor: pointer;
  filter: brightness(90%);
  text-decoration: none;
}

#btn-cancel {
  width: 30vw;
  height: 50px;
  border-radius: 10px;
  margin: 0px auto 40px auto;
  background-color: #C9C5C1;
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

.icon {
  width: 25px;
  height: 25px;
  position: absolute;
  top: 6.5px;
  left: 12.5px;
  z-index: 2;
}

.icon-holder, input.search {
  height: 38px;
  padding-left: 50px;
}
</style>
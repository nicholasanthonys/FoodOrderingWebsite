<template>
  <div class="profile-container">
    <ProfileNavbar userName="nicholas" />
    <div class="content">
      <Navbar id="navbar" />

      <h1>Edit your profile</h1>

      <b-container>
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
          <!--------input name ---->
          <b-form-group id="input-group-0" class="input-title" label="Name:" label-for="input-0">
            <b-form-input id="update-name" v-model="name" type="text" required placeholder="Name"></b-form-input>
          </b-form-group>
          <!-------END input name ---->

          <!--------input email ---->
          <b-form-group
            id="input-group-1"
            class="input-title"
            label="Email address:"
            label-for="input-1"
          >
            <b-form-input
              id="update-email"
              v-model="email"
              disabled
              type="email"
              required
              placeholder="Email"
            ></b-form-input>
          </b-form-group>
          <!--------END input email ---->

    

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
            <model-select :options="provinceOptions" v-model="province" placeholder="Province"></model-select>
          </b-form-group>
          <!---end of province -->

          <!---city -->
          <b-form-group id="input-group-city" class="input-title" label-for="input-0">
            <modelSelect
              v-if="province == null "
              :options="cityOptions"
              placeholder="City"
              :isDisabled="true"
            ></modelSelect>
            <modelSelect v-else :options="cityOptions" v-model="city"></modelSelect>
          </b-form-group>
          <!---end of city -->

          <b-button
            pill
            block
            id="btn-update-profile"
            class="mt-5"
            type="submit"
            variant="info"
          >Confirm</b-button>
        </b-form>

        <!-- <b-card class="mt-3" header="Form Data Result">
            <pre class="m-0">{{ form }}</pre>
        </b-card>-->
      </b-container>
    </div>
  </div>
</template>

<script>
import ProfileNavbar from "@/components/ProfileNavbar";
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
    ProfileNavbar,
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
  }
};
</script>

<style scoped>
.profile-container {
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
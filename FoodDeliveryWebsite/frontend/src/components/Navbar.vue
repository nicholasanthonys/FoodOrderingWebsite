<template>
  <div class="NavBar">
    <b-navbar toggleable="lg">
      <b-navbar-brand
        href="#"
        variant="i"
        style="width: auto; margin-top: 0px;"
        v-if="needLogo == true"
      >
        <div class="logo" />
      </b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        
        <!-- <b-nav-form>
          <img class="search-icon" src="../assets/search.png" />
          <b-form-input
            size="sm"
            class="search-input"
            placeholder="Search"
            style="margin-right: 0px"
          ></b-form-input>
          <img class="filter-icon" src="../assets/filter.png" />

          <b-button
            size="sm"
            class="my-2 my-sm-0"
            type="submit"
            style="padding-right: 10px; padding-left: 10px;"
          >Search</b-button>
        </b-nav-form> -->

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-navbar-nav>
            <b-nav-item>
              <router-link to="/home">Home</router-link>
            </b-nav-item>
            <b-nav-item>
              <router-link to="/menupasta">Menu</router-link>
            </b-nav-item>
            <b-nav-item>
              <router-link to="/promo">Promo</router-link>
            </b-nav-item>

            <b-nav-item-dropdown
              right
              v-if="isSessionExist"
              class="button-member"
              style="padding: 0px 10px 0px 10px"
            >
              <template v-slot:button-content>
                <em>User</em>
              </template>
              <b-dropdown-item v-on:click="goToProfile">Profile</b-dropdown-item>
              <b-dropdown-item v-on:click="goToMyCart">My Cart</b-dropdown-item>
              <b-dropdown-item v-on:click="goToHistoryOrder">History Order</b-dropdown-item>
              <b-dropdown-item v-on:click="signOut">Sign Out</b-dropdown-item>
            </b-nav-item-dropdown>

            <b-nav-item v-else>
              <router-link to="/register" class="button-member">Become a Member</router-link>
            </b-nav-item>
          </b-navbar-nav>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
export default {
  name: "NavBar",
  data: function() {
    return {
      isSessionExist: Boolean,
      needLogo: true
    };
  },
  methods: {
    signOut: function() {
      this.$session.destroy();
      //redirect to login
      this.$router.push("/");
    },
    goToProfile() {
      this.$router.push("/profile");
    },
    goToMyCart() {
      this.$router.push("/mycart");
    },
    goToHistoryOrder() {
      this.$router.push("/historyorder");
    }
  },
  mounted: function() {
    this.isSessionExist = this.$session.exists();
    console.log("is session exists" + this.isSessionExist);
    console.log("from navbar route is ");
    console.log(this.$router);

    this.$root.$on("doesnt need logo", text => {
      if (text == "there sidebar") {
        this.needLogo = false;
      }
    });
  }
};
</script>

<style scoped>
/*melakukan seleksi lakukan seperti ini*/
#app .navbar-nav,
#app .navbar-light >>> .navbar-brand {
  background-color: transparent !important;

  z-index: 9 !important;
}

#app .navbar-nav >>> .nav-link,
#app .navbar-nav >>> .nav-link a,
#app .navbar-light >>> .navbar-brand {
  color: white !important;
  text-decoration: none;
}

#app .dropdown-item a {
  color: black !important;
  text-decoration: white;
}

.logo {
  background: url("../assets/logo-kitchen-black.png") no-repeat center;
  width: 125px;
  height: 75px;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.search-input {
  width: 12vw;
  border-radius: 0px;
  border-right: none;
  border-left: none;
  border-bottom: 1px solid black;
  border-top: 1px solid black;
}

.search-icon {
  width: 30px;
  height: 31px;
  background-color: white;
  padding: 5px;
  border-radius: 5px 0px 0px 5px;
  border-top: 1px solid black;
  border-bottom: 1px solid black;
  border-left: 1px solid black;
  border-right: none;
}

.search-icon:hover,
.filter-icon:hover {
  cursor: pointer;
}

.filter-icon {
  width: 30px;
  height: 31px;
  background-color: white;
  padding: 5px;
  border-radius: 0px 5px 5px 0px;
  border-top: 1px solid black;
  border-bottom: 1px solid black;
  border-right: 1px solid black;
  border-left: none;
  margin-right: 0.5rem;
}

.button-member {
  padding: 10px 25px 10px 25px;
  background-color: #bf9e6b;
  border-radius: 10px;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  transition-duration: 0.4s;
}

.button-member:hover {
  cursor: pointer;
  filter: brightness(90%);
}
</style>
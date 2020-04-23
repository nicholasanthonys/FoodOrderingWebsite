<template>
  <div class="NavBar">
    <b-navbar toggleable="lg">
      <b-navbar-brand href="#" variant="i">
        NavBar
        <!-- <div class="lol">
              tes
        </div>-->
      </b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-nav-form>
          <b-form-input size="sm" class="mr-sm-2" placeholder="Search"></b-form-input>
          <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
        </b-nav-form>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-navbar-nav>
            <b-nav-item href="/home">Home</b-nav-item>
            <b-nav-item href="#">Menu</b-nav-item>
            <b-nav-item href="#">Promo</b-nav-item>

            <b-nav-item-dropdown right v-if="isSessionExist" >
              <template v-slot:button-content>
                <em>User</em>
              </template>
              <b-dropdown-item href="#">Profile</b-dropdown-item>
              <b-dropdown-item href="#" v-on:click="signOut">Sign Out</b-dropdown-item>
            </b-nav-item-dropdown>

            <b-nav-item href="#" v-else >Become a Member</b-nav-item>
          </b-navbar-nav>

          <!-- <b-nav-item-dropdown right>
            <template v-slot:button-content>
              <em>User</em>
            </template>
            <b-dropdown-item href="#">Profile</b-dropdown-item>
            <b-dropdown-item href="#">Sign Out</b-dropdown-item>
          </b-nav-item-dropdown>-->
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
      isSessionExist: Boolean
    };
  },
  methods: {
    signOut: function() {
      this.$session.destroy();
      //redirect to login
      this.$router.push("/");
    }
  },
  mounted: function() {
    this.isSessionExist = this.$session.exists();
    console.log("is session exists" + this.isSessionExist);
    console.log("from navbar route is ");
    console.log(this.$router);
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
#app .navbar-light >>> .navbar-brand {
  color: white !important;
}

/*
#app    .navbar-brand {
    color: red !important;
}

#app    .navbar-brand .lol {
    color: blue !important;
}
#app  .navbar-nav .dropdown-item #en  {
    color:red !important;
} */
</style>
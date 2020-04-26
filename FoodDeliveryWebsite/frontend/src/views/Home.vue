<template>
  <div id="home">
    <Navbar />
    <b-carousel
      id="carousel-1"
      fade
      v-model="slide"
      :interval="4000"
      controls
      indicators
      background="#ababab"
      img-width="1024"
      img-height="480"
      style="text-shadow: 1px 1px 2px #333;"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
      <!-- Text slides with image -->
      <b-carousel-slide img-src="../assets/bg_home_1.png" style="filter: brightness(70%);">
        <h3 style="margin-bottom: 24px; text-align: left;">"Lapar? Mau Makan?"</h3>
        <h3 style="margin-bottom: 35%; margin-left: 100px; text-align: left;">Pesan saja di sini...</h3>
      </b-carousel-slide>

      <!-- Slides with custom text -->
      <b-carousel-slide img-src="../assets/bg_home_2.png" style="filter: brightness(70%);">
        <h3 style="margin-bottom: 24px; text-align: left;">"Pengen Bakery?"</h3>
        <h3 style="margin-bottom: 35%; margin-left: 100px; text-align: left;">Pesan saja di sini...</h3>
      </b-carousel-slide>

      <!-- Slides with image only -->
      <b-carousel-slide img-src="../assets/bg_home_3.png" style="filter: brightness(70%);">
        <h3 style="margin-bottom: 24px; text-align: left;">"Pengen yang banyak?"</h3>
        <h3 style="margin-bottom: 35%; margin-left: 100px; text-align: left;">Pesan saja di sini...</h3>
      </b-carousel-slide>

      <!-- Slides with img slot -->
      <!-- Note the classes .d-block and .img-fluid to prevent browser default image alignment -->
      <!-- <b-carousel-slide>
        <template v-slot:img>
          <img
            class="d-block img-fluid w-100"
            width="1024"
            height="480"
            src="https://picsum.photos/1024/480/?image=55"
            alt="image slot"
          />
        </template>
      </b-carousel-slide>-->

      <!-- Slide with blank fluid image to maintain slide aspect ratio -->
      <!-- <b-carousel-slide caption="Blank Image" img-blank img-alt="Blank image">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eros felis, tincidunt
          a tincidunt eget, convallis vel est. Ut pellentesque ut lacus vel interdum.
        </p>
      </b-carousel-slide>-->
    </b-carousel>

    <div class="content">
      <div class="container">
        <div class="title-1">
          <h4 class>We have some Place to Easier You</h4>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat sunt facere odio possimus reiciendis magni laudantium recusandae ullam accusamus corporis cum ducimus, facilis laborum illo dolore qui? Consectetur, doloribus quos!
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae debitis laudantium alias dolorum explicabo. Beatae porro necessitatibus nemo eveniet modi soluta aliquam, cupiditate, minima non rem nulla temporibus, iste nesciunt.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, obcaecati corporis sunt enim ipsum veniam? Esse non nostrum sunt. Earum, quidem. Magni itaque dicta aspernatur nihil veritatis quasi error odit.
          </p>
        </div>

        <div class="title-2">
          <h4>We Creating some New to Easier You</h4>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat sunt facere odio possimus reiciendis magni laudantium recusandae ullam accusamus corporis cum ducimus, facilis laborum illo dolore qui? Consectetur, doloribus quos!
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae debitis laudantium alias dolorum explicabo. Beatae porro necessitatibus nemo eveniet modi soluta aliquam, cupiditate, minima non rem nulla temporibus, iste nesciunt.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, obcaecati corporis sunt enim ipsum veniam? Esse non nostrum sunt. Earum, quidem. Magni itaque dicta aspernatur nihil veritatis quasi error odit.
          </p>
        </div>

        <!-- <p class="mt-4">
          Slide #: {{ slide }}
          <br />
          Sliding: {{ sliding }}
        </p>-->

        <!--- Menu Favorit-->
        <div id="menu-favorit">
          <h4>Menu Favorit</h4>
          <b-card-group deck>
            <!--- INI NANTI HARUS DI V FOR PAKE VUE UNTUK NGULANGIN DATA DARI DATABASE -->
            <b-card
              title="Nasi Goreng Sosis"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>Rp.17500</b-card-text>
              <b-button class="detail">Detail Menu</b-button>
              <b-button class="pesan">Pesan</b-button>
            </b-card>

            <b-card
              title="Nasi Goreng Sosis"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>Rp.17500</b-card-text>
              <b-button class="detail">Detail Menu</b-button>
              <b-button class="pesan">Pesan</b-button>
            </b-card>

            <b-card
              title="Nasi Goreng Sosis"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>Rp.17500</b-card-text>
              <b-button class="detail">Detail Menu</b-button>
              <b-button class="pesan">Pesan</b-button>
            </b-card>

            <b-card
              title="Nasi Goreng Sosis"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>Rp.17500</b-card-text>
              <b-button class="detail">Detail Menu</b-button>
              <b-button class="pesan">Pesan</b-button>
            </b-card>

            <b-card
              title="Nasi Goreng Sosis"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>Rp.17500</b-card-text>
              <b-button class="detail">Detail Menu</b-button>
              <b-button class="pesan">Pesan</b-button>
            </b-card>
          </b-card-group>
        </div>
        <!--- Menu Favorit end -->

        <!---Menu Terbaru -->
        <div id="menu-terbaru">
          <h4>Menu Terbaru</h4>
          <b-card-group deck>
            <!--- INI NANTI HARUS DI V FOR PAKE VUE UNTUK NGULANGIN DATA DARI DATABASE -->
            <b-card
              title="Nasi Goreng Sosis"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>Rp.17500</b-card-text>
              <b-button class="detail">Detail Menu</b-button>
              <b-button class="pesan">Pesan</b-button>
            </b-card>

            <b-card
              title="Nasi Goreng Sosis"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>Rp.17500</b-card-text>
              <b-button class="detail">Detail Menu</b-button>
              <b-button class="pesan">Pesan</b-button>
            </b-card>

            <b-card
              title="Nasi Goreng Sosis"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>Rp.17500</b-card-text>
              <b-button class="detail">Detail Menu</b-button>
              <b-button class="pesan">Pesan</b-button>
            </b-card>

            <b-card
              title="Nasi Goreng Sosis"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>Rp.17500</b-card-text>
              <b-button class="detail">Detail Menu</b-button>
              <b-button class="pesan">Pesan</b-button>
            </b-card>

            <b-card
              title="Nasi Goreng Sosis"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>Rp.17500</b-card-text>
              <b-button class="detail">Detail Menu</b-button>
              <b-button class="pesan">Pesan</b-button>
            </b-card>
          </b-card-group>
        </div>

        <!--- menu terbaru end -->
      </div>
      <!--- End of container -->
    </div>
    <!--- end of content -->
    <Footer style="padding-bottom: 20px;"/>
  </div>
</template>

<script>
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import Cookies from "js-cookie";
export default {
  components: {
    Navbar,
    Footer
  },
  beforeCreate: function() {
    //kalo session tidak ada redirect ke login
    // //dengan kode ini user harus login dulu untuk bisa ke /home
    // if(!this.$session.exists()){
    //   this.$router.push('/');
    // }

    //kalo user loggin(session exist true) bikin cart kosong
    if (this.$session.exists()) {
      let cart = [];
      let email = Cookies.get("email");

      //cart name akan jadi : cart-bokir@gmail.com
      //jika cart ingin di clear cukup cookies.set saja gak perlu pake if !
      // if (Cookies.get("cart-" + email) == null) {
        Cookies.set("cart-" + email, JSON.stringify(cart));
      // }
    }
  },
  data() {
    return {
      slide: 0,
      sliding: null
    };
  },
  methods: {
    onSlideStart() {
      //dari referensinya pake parameter slide tapi gak work disini karena variable slide gak dipake
      //https://bootstrap-vue.js.org/docs/components/carousel/
      //   slide
      this.sliding = true;
    },
    onSlideEnd() {
      //dari referensinya pake parameter slide tapi gak work disini karena variable slide gak dipake
      //https://bootstrap-vue.js.org/docs/components/carousel/
      //   slide
      this.sliding = false;
    }
  }
};
</script>

<style  scoped>
#app #home {
  background-color: #282828;
  height: auto;
  min-height: 100vh;
}

#app .content {
  color: white;
  padding-bottom: 80px;
  padding-top: 100px;
}

#app .carousel {
  /* position:  absolute; */
  width: 100%;
  margin-top: -60px;
  z-index: 0 !important;
}
/* override carousel indicator yang bulet */
#app .carousel >>> li {
  border-radius: 50%;
  width: 10px;
  height: 10px;
  border: 20px solid transparent;
}

#app .card {
  max-width: 200px;
  color: black !important;
  border: none;
}
#app .btn {
  display: block;
  margin-bottom: 10px;
  width: 150px;
  border-radius: 10px;
  border: none;
}

#app .detail {
  background-color: #275dc5;
}

#app .pesan {
  background-color: #bf9e6b;
}

#app .card-title {
  color: #0b3993 !important;
  text-align: center;
  font-size: 18px;
  font-weight: 500;
}

#app .card-text {
  text-align: center;
}

#app #menu-favorit {
  margin-top: 200px;
}

#app #menu-terbaru {
  margin-top: 100px;
}

#app h4 {
  margin-bottom: 40px;
}

#app .navbar-light >>> .navbar-brand {
  color: red !important;
}

#app .title-1 {
  margin-bottom: 200px;
}
</style>
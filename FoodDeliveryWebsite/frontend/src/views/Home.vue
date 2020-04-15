<template>
  <div id="home">
    <Navbar />
    <b-carousel
      id="carousel-1"
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
      <b-carousel-slide
        caption="First slide"
        text="Nulla vitae elit libero, a pharetra augue mollis interdum."
        img-src="https://picsum.photos/1024/480/?image=52"
      ></b-carousel-slide>

      <!-- Slides with custom text -->
      <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=54">
        <h1>Hello world!</h1>
      </b-carousel-slide>

      <!-- Slides with image only -->
      <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=58"></b-carousel-slide>

      <!-- Slides with img slot -->
      <!-- Note the classes .d-block and .img-fluid to prevent browser default image alignment -->
      <b-carousel-slide>
        <template v-slot:img>
          <img
            class="d-block img-fluid w-100"
            width="1024"
            height="480"
            src="https://picsum.photos/1024/480/?image=55"
            alt="image slot"
          />
        </template>
      </b-carousel-slide>

      <!-- Slide with blank fluid image to maintain slide aspect ratio -->
      <b-carousel-slide caption="Blank Image" img-blank img-alt="Blank image">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eros felis, tincidunt
          a tincidunt eget, convallis vel est. Ut pellentesque ut lacus vel interdum.
        </p>
      </b-carousel-slide>
    </b-carousel>

    <div class="content">
      <div class="container">
        <div class="title-1">
          <h4>We have some Place to Easier You</h4>
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
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar";
export default {
  components: {
    Navbar
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
  color: white;
}
#app .carousel {
  position:  absolute;
  width : 100%;
  top : 0;
}
/* override carousel indicator yang bulet */
#app .carousel >>> li {
  border-radius: 50%;
  width: 10px;
  height: 10px;
  border: 20px solid transparent;
}
</style>
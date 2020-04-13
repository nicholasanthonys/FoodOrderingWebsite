<template>
 
    <div class="jumbotron"></div>

  
</template>

<script>
export default {
  name: "HelloWorld",
  props: {
    msg: String
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>



.jumbotron {
  background-image: linear-gradient(
      to bottom,
      rgba(11, 11, 11, 0.5),
      rgba(11, 11, 11, 0.5)
    ),
    url("../assets/backgroundLanding.png");

  position: relative;
  height: 700px;
  background-size: cover;
  transform: translateY(-10%);
  z-index: -1;
}



.gradient {
}
</style>

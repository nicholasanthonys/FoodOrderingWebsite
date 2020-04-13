<template>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarTogglerDemo01"
      aria-controls="navbarTogglerDemo01"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#">Hidden brand</a>
      <form class="form-inline my-2 my-lg-0 search-bar">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>

      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="#">
            Home
            <span class="sr-only">(current)</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Menu</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Promo</a>
        </li>

        <li class="nav-item">
          <a class="nav-link link-member" href="#">Become a Member</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li>-->
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: "NavBar"
};
</script>

<style scoped>
.search-bar {
  margin-left: 400px;
}
.nav-link {
  font-style: normal;
  font-weight: bold;
  font-size: 15px;
  line-height: 22px;
  /* identical to box height */

  letter-spacing: -0.3px;

  color: #ffffff;
}

.link-member {
  background: #bf9e6b;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 10px;
  color: white;
  font-weight: bold;
  font-style: normal;
  font-weight: normal;
  font-size: 15px;
  line-height: 22px;
  /* identical to box height */

  text-align: center;
  letter-spacing: -0.3px;
}
</style>
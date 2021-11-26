<template>
  <div>
    <Navbar />
  </div>

  <div dir="rtl" lang="ar">
    <router-view />
  </div>
</template>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

*{
  margin:0;
  padding: 0;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
body{
  background: #fdfdfd !important;
}
</style>

<script>
import Navbar from "./views/layouts/navbar.vue";

export default{
  name: "App",
  components: {
    Navbar
  }
}
</script>


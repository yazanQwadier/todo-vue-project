<template>
  <div>
    <Navbar />
  </div>

  <div dir="rtl" lang="ar">
    <router-view />
  </div>
</template>

<style lang="scss">
  @font-face {
    font-family: tajawal;
    src: url('../public/fonts/Tajawal/Tajawal-Regular.ttf');
  }

  #app {
    font-family: tajawal, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
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
    color: #2c3e50;
  }

  .dark-mode{
    background: black !important;
    color: white !important;
  }
</style>

<script>
import Navbar from "./views/layouts/navbar.vue";

export default{
  name: "App",
  components: {
    Navbar
  },
  methods: {
     getUserFromStorage(){
      let storage = window.localStorage;
      let user = storage.getItem('user');
      if(user != null && user != undefined){
        user = JSON.parse(user);
        this.$store.commit('auth/setUserObject', user);
      }
    }
  },
  created: function(){
    this.getUserFromStorage();

    let dark_mode = localStorage.getItem("dark_mode");
    if( dark_mode == '1' ){
      window.document.body.classList.add("dark-mode");
      this.$store.commit('general/setDarkMode', true);
    }
    else{
      this.$store.commit('general/setDarkMode', false);
    }
  }
}
</script>
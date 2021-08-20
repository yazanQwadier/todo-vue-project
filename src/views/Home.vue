<template>
  <div class="home">
      <div v-if="user != null">
        <h3>Hello {{ user['username'] }}</h3>
      </div>
      <template v-else>
        <h3>Welcome Todo Visitor :)</h3>
      </template>
  </div>
</template>

<style scoped>

</style>

<script>
export default {
  name: "Home",
  data(){
    return {
      user: null
    }
  },
  created: function(){
    let storage = window.localStorage;
    let user = storage.getItem('user');
    if( user != null && user != undefined ){
      user = JSON.parse(user);
      this.user = user;
    }
  },
};
</script>

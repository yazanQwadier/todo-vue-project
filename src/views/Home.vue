<template>
  <div class="home" dir="rtl">
      <div class="container-fluid">

        <div v-if="user != null">
          <h3>
            مرحباً {{ user['username'] }}
          </h3>
          <p>قم بجدولة مهامك اليومية والاسبوعية والشهرية وكذلك السنوية بكل سهولة &#128165; </p>

          <section class="spikes my-1"></section>
          <br>

          <div class="row mx-0">
            <div class="col-12 col-md-4">
              <CategoriesTemplate />
            </div>
            
            <div class="col p-1 p-md-2">
              <TasksTemplate v-if="activeCategory != null" />
            </div>
          </div>
        </div>

        <template v-else>
          <WelcomeTemplate />
        </template>
      </div>
  </div>
</template>

<style scoped>
  .spikes {
    position: relative;
    background: #ffffff00;
    width: 80%;
    height: 5px;
    margin: 0px auto;
  }
  .spikes::after {
    content: '';
    position: absolute;
    right: 0;
    left: 0%;
    top: 100%;
    z-index: 10;
    display: block;
    height: 3px;
    background-size: 10px 100%;
    background-image: linear-gradient(135deg, #d5d5d5 25%, transparent 25%), 
                      linear-gradient(225deg, #959595 25%, transparent 25%);
    background-position: 0 0;
  }
</style>

<script>
import store from '../store/index';
import CategoriesTemplate from '../components/categories.vue';
import TasksTemplate from '../components/tasks/tasks.vue';
import WelcomeTemplate from '../components/welcome.vue';
import config from '../../public/config';
import axios from 'axios';

export default {
  name: "Home",
  store,
  components: {
    CategoriesTemplate,
    TasksTemplate,
    WelcomeTemplate,
  },
  computed: {
    user(){
      return this.$store.state.auth.user;
    },
    activeCategory: function(){
        return this.$store.state.categories.activeCategory;
    },
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
  created: function() {
    this.getUserFromStorage();

    axios.get( config.api_url() + "/priorities" )
        .then((response) => {
            // console.log(response.data)
            this.$store.commit('priorities/setPrioritiesList', response.data);
        })
        .catch(error => {
            console.log(error);
        });
  },
};
</script>

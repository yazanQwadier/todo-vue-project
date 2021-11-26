<template>
    <div>
        <div class="categories-layout">
            <ul class="p-0">
                <li v-for="category in categories" :key="category.id" 
                        :class="(activeCategory?.id == category.id)? 'active-category': ''"  @click="changeGlobalCategory(category)">
                    {{ category.title }} &#9989;
                </li>
            </ul>
        </div>

        
    </div>
</template>

<style scoped>
    .categories-layout{
        background: #fdfdfd;
        height: 65vh;
    }
    ul {
        list-style: none;
    }
    ul li {
        padding: 6px;
        font-size: 17px;
        background: #c7c7c700;
        border: 1px solid #f9f9f99c;
        border-radius: 8px;
        box-shadow: 0px 0px 1px #f5f5f53d;
        margin: 3px 5px;
        transition: 0.2s;
    }
    ul li:hover {
        cursor: pointer;
        border: 1px solid #9999999c;
    }
    .active-category{
        background: #f7f7f7;
        box-shadow: 0px 0px 20px #e1e1e1;
        font-weight: bold;
    }
</style>

<script>
import axios from 'axios'
import config from '../../public/config.js';

export default {
    name: "CategoriesTemplate",
    data(){
        return {
            categories: []
        }
    },
    computed: {
        "activeCategory": function(){
            return this.$store.state.categories.activeCategory;
        }
    },
    methods: {
        "changeGlobalCategory": function(category){
            this.$store.commit('categories/setGlobalCategory', category);
        }
    },
    created: function(){
        axios.get( config.api_url() + "/categories" )
            .then((response) => {
                this.categories = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    }
}
</script>
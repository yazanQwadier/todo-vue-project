<template>
    <div class="custom-navbar">
        <ul>
            <li>
                <img alt="Vue logo" src="../../assets/logo.png" class="brand" />
            </li>
            
            <li>
                <router-link to="/" tag="li">Home</router-link> |
            </li>

            <li>
                <router-link to="/about" tag="li">About</router-link>
            </li>

            <li>
                <template v-if="user == null">
                    <router-link to="/login" class="btn btn-secondary mx-1">Login</router-link>
                    <router-link to="/signup" class="btn btn-outline-secondary mx-1">Signup</router-link>
                </template>
                <template v-else>
                    <span class="text-light">{{ user['username'] }}</span>
                    <button type="button" class="btn btn-danger mx-1" @click="logout">logout</button>
                </template>
            </li>
        </ul>

    </div>
</template>

<style scoped>
    .custom-navbar{
        background: #505050;
    }
    ul{
        display: flex;
        align-items: center;
        list-style: none;
    }

    ul .brand{
        width: 70px;
    }

    ul li{
        margin: auto 10px;
    }

    ul li:first-child{
        margin: 10px 6%;
    }

    ul li:last-child{
        margin-left: auto;
    }

    ul li a {
        color: #f1f1f1;
        text-decoration: none;
        font-size: 18px;
    }
</style>

<script>
    import jQuery from "jquery";
    const $ = jQuery;
    window.$ = $;
    
    export default {
        name: "Navbar",
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
        methods: {
            "logout": function(){
                let storage = window.localStorage;
                storage.removeItem('user');
                window.location.href = "/";
            }
        }
    }
</script>

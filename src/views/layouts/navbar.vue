<template>
    <div class="custom-navbar" dir="rtl" lang="ar">
        <ul>
            <li>
                <img alt="Vue logo" src="../../../public/light-logo.png" class="brand" />
            </li>
            
            <li>
                <router-link to="/" tag="li">الرئيسية</router-link> |
            </li>

            <li>
                <template v-if="user == null">
                    <router-link to="/login" class="btn btn-secondary mx-1">تسجيل الدخول</router-link>
                    <router-link to="/signup" class="btn btn-outline-secondary mx-1">حساب جديد</router-link>
                </template>
                <template v-else>
                    <span class="text-light">{{ user['username'] }}</span>
                    <button type="button" class="btn btn-danger btn-sm mx-1" @click="logout">تسجيل الخروج</button>
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
        width: 80px;
    }

    ul li{
        margin: auto 10px;
    }

    ul li:first-child{
        margin: 10px 6%;
    }

    ul li:last-child{
        margin-inline-start: auto;
    }

    ul li a {
        color: #f1f1f1;
        text-decoration: none;
        font-size: 18px;
    }
</style>

<script>
    import jQuery from "jquery";
    import store from '../../store/index';

    const $ = jQuery;
    window.$ = $;
    
    export default {
        name: "Navbar",
        store,
        data(){
            return {
            }
        },
        computed: {
            user(){
                return this.$store.state.auth.user;
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
                this.$store.commit('auth/clearUser');
                window.location.href = "/";
            }
        }
    }
</script>

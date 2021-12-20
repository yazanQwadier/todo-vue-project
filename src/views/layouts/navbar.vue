<template>
    <div class="custom-navbar" dir="rtl" lang="ar">
        <ul>
            <li>
                <router-link to="/" tag="li">
                    <img alt="Vue logo" src="../../../public/light-logo.png" class="brand" />
                </router-link>
            </li>
            
            <li>
                <router-link to="/" tag="li">الرئيسية</router-link>
            </li>

            <li v-if="screenWidth > 500">
                <button type="button" class="btn btn-dark btn-sm rounded-pill mx-3" @click="toggleDarkMode">
                    الوضع الليلي
                    <fa icon="moon" color="yellow" />
                </button>           
            </li>

            <template v-if="screenWidth > 500">
                <li>
                    <template v-if="user == null">
                        <router-link to="/login" class="btn btn-dark btn-sm mx-1">تسجيل الدخول</router-link>
                        <router-link to="/signup" class="btn btn-outline-dark btn-sm mx-1">حساب جديد</router-link>
                    </template>
                    <template v-else>
                        <span class="text-light">{{ user['username'] }} <fa icon="user" /> </span>
                        <button type="button" class="btn btn-danger btn-sm rounded-pill mx-3" @click="logout">
                            تسجيل الخروج
                            <fa icon="sign-out-alt" />
                        </button>
                    </template>
                </li>
            </template>
            <template v-else>
                <button class="btn btn-sm bars-btn" @click="showMenu = !showMenu"> <fa icon="bars" /> </button>
            </template>
        </ul>

        <div class="menu-layout" v-if="showMenu">
            <ul>
                <li>
                    <button type="button" class="btn btn-dark btn-sm rounded-pill mx-3" @click="toggleDarkMode">
                        الوضع الليلي
                        <fa icon="moon" color="yellow" />
                    </button>           
                </li>
                
                <template v-if="user == null">
                    <li>
                        <a href="/login" class="mx-1">تسجيل الدخول</a>
                    </li>
                    <li>
                        <a href="/signup" class="mx-1">حساب جديد</a>
                    </li>
                </template>
                <template v-else>
                    <li>
                        <span class="text-light">{{ user['username'] }} <fa icon="user" /> </span>
                    </li>
                    <li>
                        <button type="button" class="btn btn-danger btn-sm rounded-pill mx-3" @click="logout">
                            تسجيل الخروج
                            <fa icon="sign-out-alt" />
                        </button>
                    </li>
                </template>
            </ul>
        </div>

    </div>
</template>

<style scoped>
    .custom-navbar{
        background: #353448;
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
    .bars-btn{
        background: #707070a8;
        color: #dfdfdf;
        margin-right: auto;
    }
    .bars-btn:hover,
    .bars-btn:focus{
        color: #dfdfdf;
    }
    .menu-layout{
        position: absolute;
        top: 63px;
        left: 0;
        width: 95%;
        background-color: #383838f0;
        z-index: 5555;
    }
    .menu-layout ul{
        flex-direction: column;
    }
    .menu-layout ul li{
        margin: 10px 6%;
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
        data: function(){
            return {
                showMenu: false,
            }
        },
        computed: {
            user(){
                return this.$store.state.auth.user;
            }
        },
        methods: {
            "logout": function(){
                let question = window.confirm('هل أنت متأكد من تسجيل الخروج ؟');
                if( question ){
                    this.clearSession();
                }
            },
            "clearSession": function(){
                window.localStorage.removeItem('user');
                this.$store.commit('auth/clearUser');
                window.location.href = "/";
            },
            "toggleDarkMode": function(){
                let dark_mode = window.localStorage.getItem('dark_mode');
                let dark_mode_status = false;
                if(dark_mode != undefined){
                    if(dark_mode == '0'){
                        window.localStorage.setItem('dark_mode', '1');
                        dark_mode_status = true;
                    } 
                    else{
                        window.localStorage.setItem('dark_mode', '0');
                        dark_mode_status = false;
                    }
                }
                else{
                    window.localStorage.setItem('dark_mode', '1');
                    dark_mode_status = true;
                }
                
                this.$store.commit('general/setDarkMode', dark_mode_status);
                window.document.body.classList.toggle('dark-mode');
            }
        },
        computed: {
            "screenWidth": function(){
                return window.innerWidth;
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
    }
</script>

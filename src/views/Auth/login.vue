<template>
    <div>
        <div class="login-layout">
            <form>
                <h3 class="my-1">تسجيل الدخول</h3>

                <div class="alert-status"></div>

                <input type="text" v-model="email" id="email-login" class="form-control my-2" placeholder="البريد الالكتروني">
                <input type="password" v-model="password" id="password-login" class="form-control my-2" placeholder="كلمة المرور">

                <button class="btn btn-success" type="button" v-on:click="login">دخول</button>
                <router-link to="/signup" class="new-account">انشاء حساب جديد <fa icon="user-circle" /></router-link>
            </form>
        </div>
    </div>
</template>

<style scoped>
    .login-layout {
        margin: 16vh auto;
    }
    form{
        width: 36%;
        margin: auto;
        background: #f9f9f9;
        border: 1px solid transparent;
        border-radius: 22px;
        padding: 18px;
    }
    .dark-mode form{
        background: #343434;
    }
    .new-account{
        color: #198754;
        text-decoration: none;
        font-size: 16px;
        text-align: start;
        display: block;
    }

    @media (max-width: 600px) {
        form{
            width: 80%;
        }
    }

    @media (max-width: 300px) {
        form{
            width: 90%;
        }
    }
</style>

<script>
    import axios from 'axios';
    import config from '../../../public/config';

    export default {
        name: "Login",
        data() {
            return {
                email: "",
                password: "",
            }
        },
        methods: {
            "login": function(){
                if(this.email != "" && this.password != ""){
                    var formData = new FormData();
                    formData.append('email', this.email);
                    formData.append('password', this.password);

                    axios.post( config.api_url()+ "/authentication/login", formData)
                        .then((response) => {
                            if( response.status == 200 ){
                                let status = response.data['status'];
                                if(status != "failed"){
                                    let user = {
                                        id: response.data.response['id'],
                                        username: response.data.response['username'],
                                        email: response.data.response['email'],
                                    };
                                    this.setUserInCache(user);
                                    window.location.href = "/";
                                }
                                else{
                                    let statusElement = document.getElementsByClassName('alert-status')[0];
                                    
                                    let newStatus = document.createElement('div');
                                    newStatus.classList.add('alert', 'alert-danger', 'p-1');
                                    newStatus.innerHTML = response.data['response'];
                                    statusElement.appendChild(newStatus);
                                }
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
                else{
                    alert('no data');
                }
            },
            "setUserInCache": function(user){
                window.localStorage.setItem('user', JSON.stringify(user));
            }
        }
    }
</script>
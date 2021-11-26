<template>
    <div>
        <form>
            <h3 class="my-1">انشاء حساب جديد</h3>
            
            <div class="alert-status"></div>

            <input type="text" v-model="username" id="username-signup" class="form-control my-2" placeholder="اسم المستخدم">
            <input type="text" v-model="email" id="email-signup" class="form-control my-2" placeholder="البريد الالكتروني">
            <input type="password" v-model="password" id="password-signup" class="form-control my-2" placeholder="كلمة المرور">

            <button class="btn btn-success" type="button" @click="register">انشاء</button>
            <router-link to="/login" class="login-link">تسجيل الدخول</router-link>
        </form>
    </div>
</template>

<style scoped>
    form{
        width: 36%;
        margin: auto;
        background: #f9f9f9;
        border: 1px solid transparent;
        border-radius: 22px;
        padding: 18px;
    }

    .login-link{
        color: #198754;
        text-decoration: none;
        font-size: 16px;
        text-align: start;
        display: block;
    }
</style>

<script>
import axios from 'axios';
import config from '../../../public/config';

export default {
    name: "SignUp",
    data(){
        return {
            username: '',
            email: '',
            password: ''
        }
    },
    methods: {
        'register': function(){
            if(this.email != "" && this.password != ""){

                let formData = new FormData();
                formData.append('username', this.username);
                formData.append('email', this.email);
                formData.append('password', this.password);

                axios.post( config.api_url() +"/authentication/register", formData)
                    .then((response) => {
                        if( response.status == 200 ){
                            if(response.data.status != "failed"){
                                let user = {
                                    id: response.data.response['id'],
                                    username: response.data.response['username'],
                                    email: response.data.response['email'],
                                };
                                this.setUserInCache(user);
                                window.location.href = "/";
                            }
                            else{
                                let type = response.data.type;
                                
                                // initialize layout for errors
                                let statusElement = document.getElementsByClassName('alert-status')[0];
                                statusElement.innerHTML = "";
                                
                                switch( type ){
                                    case "validate": {
                                        let errors = response.data.response;
                                        errors.forEach(err => {
                                            let error = this.generateError( err );
                                            statusElement.appendChild(error);
                                        });
                                        break;
                                    }
                                    
                                    case "exists": {
                                        let error = this.generateError( response.data['response'] );
                                        statusElement.appendChild(error);
                                        break;
                                    }
                                    default: console.log('unknown error');
                                }
                            }
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            else{
                alert('no data');
            }
        },
        "generateError": function(error){
            let newStatus = document.createElement('div');
            newStatus.classList.add('alert', 'alert-danger', 'p-1');
            newStatus.innerHTML = error;
            return newStatus;
        },
        "setUserInCache": function(user){
            window.localStorage.setItem('user', JSON.stringify(user));
        }
    }
}
</script>
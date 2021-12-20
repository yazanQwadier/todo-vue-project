<template>
    <div>
        <div class="welcome-body">
            <div class="welcome-info">
                <img src="../../public/light-logo.png" alt="Logo Image" class="welcome-logo" v-if="dark_mode">
                <img src="../../public/logo.png" alt="Logo Image" class="welcome-logo" v-else>

                <h2>أداة بسيطة وسهلة الاستخدام لتنظيم وجدولة المهام</h2>

                <p>
                    <router-link to="/login">سجّل دخولك</router-link>
                    وأنجز مهامك
                </p>
            </div>

            <div class="welcome-background">
                <img src="../../public/background.svg" alt="Background Image">
            </div>
        </div>
    </div>
</template>

<style scoped>
    .welcome-body{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .welcome-info{
        width: 43%;
    }
    .welcome-background{
        width: 50%;
    }
    .welcome-background img{
        width: 90%;
        margin-top: 5vh;
    }
    .welcome-logo{
        width: 115px;
        margin: 20px;
    }
    .welcome-info h2 {
        max-width: 400px;
        text-align: center;
        margin: 2px auto;
    }
    .welcome-info p {
        margin-top: 25px;
        color: #7e7e7e;
        font-size: 17px;
    }
    .welcome-info p a{
        text-decoration: none;
        color: #7278d3;
    }

    @media (max-width:300px) {
        .welcome-body{
            flex-direction: column;
        }
        .welcome-info {
            width: 100%;
        }
        .welcome-background {
            width: 95%;
        }
    }

    @media (max-width:600px) {
        .welcome-body{
            flex-direction: column;
        }
        .welcome-info {
            width: 90%;
        }
        .welcome-background {
            width: 90%;
        }
    }
</style>

<script>
export default {
    name: "WelcomeTemplate",
    computed: {
        dark_mode: function(){
            return this.$store.state.general.dark_mode;
        }
    }
}
</script>
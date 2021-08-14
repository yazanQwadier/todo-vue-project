<template>
    <div class="navbar">
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

            <li><button>=</button></li>
        </ul>

    </div>
</template>

<style scoped>
    .navbar{
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

    ul li:last-child button{
        width: 45px;
        padding: 5px;
        background: #d0d0d040;
        border: 1px solid #8c8c8c;
        border-radius: 5px;
        font-size: 18px;
        color: white;
    }

    ul li a {
        color: #f1f1f1;
        text-decoration: none;
        font-size: 18px;
    }
</style>

<script>
export default {
    name: "Navbar"
}
</script>
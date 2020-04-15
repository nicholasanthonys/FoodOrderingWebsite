<template>
    <div class="menu-pasta">
        
        <!-- Navbar -->
        <Navbar />

        <!-- Side Navbar -->
        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <img class="logo" src="../assets/logo.png" alt="Logo Kitchen" />
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a href="#" class="link-to-other">Pasta</a>
                    </li>
                    <li>
                        <a href="#" class="link-to-other">Steak</a>
                    </li>
                    <li>
                        <a href="#" class="link-to-other">Pizza</a>
                    </li>
                    <li>
                        <a href="#" class="link-to-other">Rice</a>
                    </li>
                    <li>
                        <a href="#" class="link-to-other">Soup</a>
                    </li>
                    <li>
                        <a href="#" class="link-to-other">Salad</a>
                    </li>
                    <li>
                        <a href="#" class="link-to-other">Drinks</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="content">
            <h1>Hello</h1>
        </div>
    </div>
</template>

<script>
import Navbar from '../components/Navbar'
export default {
 components : {
     Navbar
 }   
}
</script>

<style scoped>

template {
    background-color: #282828;
}

.menu-pasta{
    background-color: #282828;
}

.wrapper {
    display: flex;
    align-items: stretch;
    width: 180px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 999;
    background: #4A4A4A;
    color: #fff;
}

#sidebar {
    width: 100%;
    height: 100%;
}

a {
    color: #fff;
}

li {
    text-align: center;
    margin-bottom: 41px;
}

.logo {
    width: 80%;
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 80px;
}

</style>
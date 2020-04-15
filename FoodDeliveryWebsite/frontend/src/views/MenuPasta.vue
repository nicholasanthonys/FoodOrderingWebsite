<template>
    <div class="menu-pasta">
        <!-- Side Navbar -->
        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <img class="logo" src="../assets/logo-kitchen-black.png" alt="Logo Kitchen" />
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a href="#" class="link-to-other" active>Pasta</a>
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
            <!-- Navbar -->
            <Navbar id="navbar"/>

            <!-- Content of Menu -->
            <div class="menu-row row">
                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>

                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>

                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>

                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>
            </div>

            <div class="menu-row row">
                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>

                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>

                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>
                
                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>
            </div>

            <div class="menu-row row">
                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>

                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>

                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>
                
                <div class="menu">
                    <img class="menu-img" src="../assets/bg_home_1.png" alt="Menu" />

                    <p class="menu-name">Nasi Goreng Sosis</p>
                    <p class="menu-price">Rp17.500</p>

                    <button class="detail_menu">Detail Menu</button>
                    <button class="pesan">Pesan</button>
                </div>
            </div>

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
.menu-pasta {
    font-family: Poppins;
    width: auto;
    height: auto;
    padding-bottom: 20px;
    background-color: #282828;
}

.wrapper {
    display: flex;
    align-items: stretch;
    width: 15%;
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

.link-to-other {
    font-size: 16px;
    color: #fff;
}

.link-to-other:hover .link-to-other:focus {
    text-decoration: underline;
    text-decoration-color: #fff;
}

.link-to-other:active .link-to-other:visited {
    color: #FF9D9D;
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

.content {
    width: 85%;
    margin-left: 15%;
}

.menu-row {
    margin-top: 55px;
    margin-right: 0px;
    margin-left: 0px;
}

.menu {
    width: 18.75%;
    height: auto;
    padding-bottom: 18px;
    min-height: 400px;
    margin-left: 5%;
    border-radius: 10px;
    background-color: #fff; 
}

.menu-img {
    width: 100%;
    height: 200px;
    object-fit: fill;
    border-radius: 10px 10px 0px 0px;
}

.menu-name {
    margin-top: 11.5px;
    margin-bottom: 0px;
    font-style: bold;
    font-size: 18px;
    color: #0B3993;
    text-align: center;
}

.menu-price {
    font-size: 14px;
    margin-bottom: 25px;
    color: #000;
    text-align: center;
}

.detail_menu {
    width: 80%;
    max-width: 170px;
    height: 45px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    border-radius: 10px;
    color: #fff;
    margin-bottom: 12px;
    background-color: #275DC5;
    box-shadow: 0px 2px rgba(0, 0, 0, 0.25);
}

.pesan {
    width: 80%;
    max-width: 170px;
    height: 45px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    border-radius: 10px;
    color: #fff;
    background-color: #BF9E6B;
    box-shadow: 0px 2px rgba(0, 0, 0, 0.25);
}

</style>
<template>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <router-link class="nav-link" to="/">
                    <i class="mdi mdi-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/categorie">
                    <i class="mdi mdi-menu menu-icon"></i>
                    <span class="menu-title">Categories</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/menu">
                    <i class="mdi mdi-store menu-icon"></i>
                    <span class="menu-title">Menus</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/reservation">
                    <i class="mdi mdi-clipboard menu-icon"></i>
                    <span class="menu-title">Reservations</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/subscription">
                    <i class="mdi mdi-clipboard menu-icon"></i>
                    <span class="menu-title">Subscriptions</span>
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: 'sidebar',

        setup(){
            let asset = window.asset + 'images/'
        }
    }
</script>


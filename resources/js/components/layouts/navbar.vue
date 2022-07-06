<template>
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
                <router-link class="navbar-brand brand-logo" to="/"><img src="images/logo.svg" alt="logo"/></router-link>
                <router-link class="navbar-brand brand-logo-mini" to="/"><img src="images/logo-mini.svg" alt="logo"/></router-link>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-sort-variant"></span>
                </button>
            </div>  
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                        <span class="nav-profile-name">{{ user.username }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" id="dropping">
                        <a class="dropdown-item" @click="signOut()">
                            <i class="mdi mdi-logout text-primary"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
</template>

<script>
    import { useUserStore } from '@stores/user'
    import { useUserService } from '@services/userservice'

    export default {
        name: 'navbar',
        setup(){
            const user = useUserStore();
            const { signOut } = useUserService();

            return {
                user,
                signOut
            }
        }
    }
</script>
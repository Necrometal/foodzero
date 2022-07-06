<template>
    <suspense>
        <div class="container-scroller" >
            <Navbar />

            <div class="container-fluid page-body-wrapper">
                <Sidebar />

                <div class="main-panel">
                    <div class="content-wrapper">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </suspense>
</template>

<script>
    import { useTemplate } from '@composables/template'

    import Navbar from '@components/layouts/navbar.vue';
    import Sidebar from '@components/layouts/sidebar.vue';
    import Footer from '@components/layouts/footer.vue';

    export default {
        name: 'dashboard',

        components: {
            Navbar,
            Sidebar,
            Footer
        },

        setup(){
            useTemplate()
        }
    }
</script>
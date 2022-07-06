import { createRouter, createWebHistory } from 'vue-router'
import { useAuth } from '@middlewares/auth'

export function useRouter(){
    const checkIt = useAuth();

    let routes = [
        {
            path: '/',
            component: () => import('./components/dashboard.vue'),
            children: [
                {	
                    path: '', 
                    name: 'home', 
                    component: () => import('./pages/home.vue'),	
                },
                {	
                    path: 'categorie', 
                    name: 'categorie', 
                    component: () => import('./pages/categorie.vue'),	
                },
                {	
                    path: 'menu', 
                    name: 'menu', 
                    component: () => import('./pages/menus.vue'),	
                },
                {	
                    path: 'reservation', 
                    name: 'reservation', 
                    component: () => import('./pages/reservation.vue'),	
                },
                {	
                    path: 'subscription', 
                    name: 'subscription', 
                    component: () => import('./pages/subscription.vue'),	
                }
            ],
            async beforeEnter(to, from, next){
                let auth = await checkIt();
                if(auth == 1){
                    next('login');
                }else{
                    next();
                }
            }
        },
        {	
            path: '/login', 
            name: 'login', 
            component: () => import('./pages/login.vue'),
            async beforeEnter(to, from, next){
                let auth = await checkIt();
                if(auth == 2){
                    next('/');
                }else{
                    next();
                }
            }	
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'not-found',
            component: () => import('./pages/not-found.vue')
        }
    ];

    const router = createRouter({
        // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
        history: createWebHistory('/admin/'),
        routes, // short for `routes: routes`
    })

    return router
}
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', {
    state: () => {
        return {
            user: null,
        }
    },

    getters: {
        token: (state) => state.user ? state.user.token : null,
        username: (state) => state.user ? state.user.name : null,
        userId: (state) => state.user ? state.user.id : null,
    },

    actions: {
        login(data){
            this.user = data;
        },

        logout(){
            console.log('aro')
            this.user = null;
        }
    }
})
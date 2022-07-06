import secureStorage from "@tools/secure";
import { useUserStore } from "@stores/user";

export function useStoreService(){
    const store = useUserStore()

    // storage system
    function setToken(data){
        secureStorage.setItem('user', data);

        setStore(data)
    }

    function setStore(data){
        const user = {
            id: data.id,
            name: data.name,
            token: data.token,
        }

        store.login(user);
    }

    function getToken(){
        return secureStorage.getItem('user');
    }

    function removeToken(){
        secureStorage.removeItem('user');
        store.logout();
    }

    async function initToken(){
        let user = await getToken()
        if(user) setStore(user)
    }

    return {
        setToken,
        getToken,
        removeToken,
        initToken
    }
}
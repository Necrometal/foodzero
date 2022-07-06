import { useHttp } from "@tools/http";
import { useStoreService } from '@services/storeservice'
import { checkAuth, login, logout } from '@services/path'
import { reactive, ref } from "vue";
import { useRouter } from 'vue-router'

export function useUserService(){
    const { removeToken } = useStoreService();
    const route = useRouter()

    async function checkAuthValidity(){
        const axios = useHttp();
        let status = null;
        try {
            status = await axios.get(checkAuth)
        }catch(e){
            if(e.response?.status == 401){
                status = 'not valide'
                await removeToken()
            }else{
                alert('An error has occured')
                console.log(e)
            }   
        }

        return status
    }

    async function signOut(){
        const axios = useHttp();

        try {
            await axios.post(logout)
            await removeToken()
            route.push({ name: 'login' })
        }catch(e){
            console.log(e)
            if(e.response?.status == 401){
                await removeToken()
                route.push({ name: 'login' })
            }else{
                alert('An error has occured')
                console.log(e)
            }   
        }
    }

    return {
        checkAuthValidity,
        signOut
    }
}

export function useLoginService(){
    const axios = useHttp();
    const { setToken } = useStoreService();
    const route = useRouter()

    const formLogin = reactive({
        email: null,
        password: null,
    })

    const error = ref({
        email: null,
        password: null,
        credential: null,
        succes: null
    })

    const loading = ref(false);
    const submit = ref(false);

    function resetError(){
        error.value.email = null;
        error.value.password = null;
        error.value.credential = null
    }

    async function signIn(e){
        // e.preventDefault()

        try {
            submit.value = true;
            loading.value = true;


            let result = await axios.post(login, { ...formLogin });

            if(result.data.warning){
                error.value.email = result.data.warning.email ? result.data.warning.email : null;
                error.value.password = result.data.warning.password ? result.data.warning.password : null;
            }else if(result.data.error){
                error.value.credential = result.data.error
            }else{
                resetError()
                error.value.succes = 'Authenticated'
                
                await setToken(result.data.data)
                route.push({ name: 'home' })
            }
            loading.value = false;

        }catch(e){
            loading.value = false;
            alert('An error has occured')
            console.log(e)
        }
    }

    return {
        formLogin,
        error: error.value,
        loading: loading.value,
        submit: submit.value,
        signIn
    }


}
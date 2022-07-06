import { useRouter } from "vue-router";

export function useHandleErrorHttp(e){
    const route = useRouter()

    async function execute(){
        if(e?.response?.status == 401){
            await removeToken()
            route.push({ name: 'login' })
        }else{
            alert('An error has occured')
            console.log(e)
        }  
    } 

    return execute;
}
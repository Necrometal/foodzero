import { useHttp } from "@tools/http";
import { listSubscription } from '@services/path';
import { ref } from 'vue';
import { useHandleErrorHttp } from '@composables/handleError'

export function useSubscriptionService(){
    const handleError = useHandleErrorHttp()

    const subscriptions = ref([])
    const toShow = ref(null)

    const infinite = ref({
        current: 1,
        total: 1,
        count: 1
    })

    const axios = useHttp();

    const initData = async function(){
        try{
            let result = await axios.get(listSubscription)
            subscriptions.value = result.data.data
        }catch(e){
            handleError(e)
        }
    }

    const toggle = function(item = null){
        toShow.value = item
    }

    return {
        subscriptions,
        initData,
        infinite,
        toShow,
        toggle
    }
}
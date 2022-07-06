import { useHttp } from "@tools/http";
import { listMenu, createMenu, updateMenu, deleteMenu } from '@services/path';
import { ref, reactive } from 'vue';
import { useHandleErrorHttp } from '@composables/handleError'

export function useMenuService(){
    const handleError = useHandleErrorHttp()

    const menus = ref([])
    const toShow = ref(null)
    const toHandle = ref(null)

    const infinite = ref({
        current: 1,
        total: 1,
        count: 1
    })

    const loading = ref(false)

    const axios = useHttp();

    const initData = async function(){
        try{
            loading.value = true;
            let result = await axios.get(listMenu)
            menus.value = result.data.data
            loading.value = false;
        }catch(e){
            loading.value = false;
            handleError(e)
        }
    }

    const toggle = function(item = null){
        toShow.value = item
    }

    const toggleCreate = function(item = null){
        toHandle.value = item
    }

    const deleteMenuRequest = async function(item){
        if(confirm('Delete Menu ?')){
            try{
                loading.value = true;
                let result = await axios.delete(deleteMenu + item.id)
                await initData()
                loading.value = false;
            }catch(e){
                loading.value = false;
                handleError(e)
            }
        }
    }

    return {
        menus,
        initData,
        infinite,
        toShow,
        toggle,
        toHandle,
        toggleCreate,
        loading,
        deleteMenuRequest
    }
}

export function useFormMenuService(){
    const handleError = useHandleErrorHttp()
    const axios = useHttp();
    const formMenu = reactive({
        id: null,
        name: null,
        description: null,
        image: null,
        categorie: null,
        uploadedImage: null
    })

    const error = ref({
        name: null,
        description: null,
        price: null,
        categorie: null,
        // uploadedImage: null,
    })

    const loading = ref(false)

    const resetError = function (){
        error.value.name = null;
        error.value.description = null;
        error.value.price = null;
        error.value.categorie = null;
        // error.value.uploadedImage = null
    }

    const saveMenu = async function(callback = () => {}){
        try{
            loading.value = true;
            let result = null;

            result = !formMenu.id ? await createMenuRequest() : await updateMenuRequest(formMenu.id)
            

            if(result.data.warning){
                error.value.name = result.data.warning.name ? result.data.warning.name : null;
                error.value.description = result.data.warning.description ? result.data.warning.description : null;
                error.value.price = result.data.warning.price ? result.data.warning.price : null;
                error.value.categorie = result.data.warning.categorie ? result.data.warning.categorie : null;
            }else{
                resetError()
                callback()
            }

            loading.value = false;
            
        }catch(e){
            loading.value = false;
            console.log(e)
            handleError(e)
        }
    }

    const createMenuRequest = function(){
        return axios.post(createMenu, { ...formMenu })
    }

    const updateMenuRequest = function(id){
        return axios.put(updateMenu + id, { ...formMenu })
    }

    const fillForm = function(data){
        formMenu.id = data?.id ?? null;
        formMenu.name = data?.name ?? null;
        formMenu.description = data?.description ?? null;
        formMenu.image = data?.image ?? null;
        formMenu.price = data?.price ?? null;
        formMenu.categorie = data?.category?.id ?? null;
    }

    const handleUploadedImage = function(event) {
        var input = event.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = (e) => {
                formMenu.uploadedImage = e.target.result
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    return {
        formMenu,
        loading,
        saveMenu,
        fillForm,
        error,
        handleUploadedImage
    }
}
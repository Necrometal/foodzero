import { useHttp } from "@tools/http";
import { listCategorie, createCategorie, updateCategorie, deleteCategorie } from '@services/path';
import { ref, reactive } from 'vue';
import { useHandleErrorHttp } from '@composables/handleError'

export function useCategorieService(){
    const handleError = useHandleErrorHttp()

    const categories = ref([])
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
            let result = await axios.get(listCategorie)
            categories.value = result.data.data
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

    const deleteCategorieRequest = async function(item){
        if(confirm('Delete Categorie ?')){
            try{
                loading.value = true;
                let result = await axios.delete(deleteCategorie + item.id)
                await initData()
                loading.value = false;
            }catch(e){
                console.log(e)
                loading.value = false;
                handleError(e)
            }
        }
    }

    return {
        categories,
        initData,
        infinite,
        toShow,
        toggle,
        toHandle,
        toggleCreate,
        loading,
        deleteCategorieRequest
    }
}

export function useFormCategorieService(){
    const handleError = useHandleErrorHttp()
    const axios = useHttp();
    const formCategorie = reactive({
        id: null,
        name: null,
        description: null,
        image: null,
        uploadedImage: null
    })

    const error = ref({
        name: null,
        // description: null,
        // uploadedImage: null,
    })

    const loading = ref(false)

    const resetError = function (){
        error.value.name = null;
        // error.value.description = null;
        // error.value.uploadedImage = null
    }

    const saveCategorie = async function(callback = () => {}){
        try{
            loading.value = true;
            let result = null;

            result = !formCategorie.id ? await createCategorieRequest() : await updateCategorieRequest(formCategorie.id)


            if(result.data.warning){
                error.value.name = result.data.warning.name ? result.data.warning.name : null;
            }else{
                resetError()
                resetForm()
                callback()
            }

            loading.value = false;
            
        }catch(e){
            loading.value = false;
            console.log(e)
            handleError(e)
        }
    }

    const createCategorieRequest = function(){
        return axios.post(createCategorie, { ...formCategorie })
    }

    const updateCategorieRequest = function(id){
        return axios.put(updateCategorie + id, { ...formCategorie })
    }

    const fillForm = function(data){
        formCategorie.id = data?.id ?? null;
        formCategorie.name = data?.name ?? null;
        formCategorie.description = data?.description ?? null;
        formCategorie.image = data?.image ?? null;
    }

    const resetForm = function(){
        formCategorie.id = null;
        formCategorie.name =  null;
        formCategorie.description =  null;
        formCategorie.image = null;
    }

    const handleUploadedImage = function(event) {
        var input = event.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = (e) => {
                formCategorie.uploadedImage = e.target.result
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    return {
        formCategorie,
        loading,
        saveCategorie,
        fillForm,
        error,
        handleUploadedImage
    }
}

export async function useGetAllCategorie(){
    const handleError = useHandleErrorHttp()
    const axios = useHttp();   
    const categories = ref([]);
    try{
        let result = await axios.get(listCategorie, {
            params: { all: 1 }
        });

        categories.value = result.data.data
    }catch(e){
        handleError(e);
    }

    return categories
}
<template>
    <div class="modal fade" id="modalCreateCategorie" tabindex="-1" role="dialog" aria-labelledby="modalCreateCategorieTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modalCreateCategorieTitle">
                    <h5 class="modal-title">
                        New Categorie
                    </h5>
                    <button ref="closeButton" @click="close()" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" @submit.prevent="submitForm">
                        <div class="form-group">
                            <label for="name">Categorie name</label>
                            <input v-model="formCategorie.name" required type="text" class="form-control" id="name" placeholder="Categorie name">
                            <div v-if="error.name">
                                <span class="text-danger" v-for="(nameError, i) in error.name" :key="'name-error-'+i">
                                    {{ i == 0 ? '' : ', ' }} {{ nameError }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea v-model="formCategorie.description" class="form-control" id="description" placeholder="Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input @change="handleUploadedImage" type="file" accept="image/*" class="form-control" id="image" placeholder="Categorie name">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="close()">Close</button>
                            <button type="submit" class="btn btn-primary" v-if="!loading">Save</button>
                            <div class="btn btn-primary my-2" v-if="loading">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { inject, watch, ref } from 'vue';
    import { useFormCategorieService } from '@services/categorieservice'

    export default {
        name: 'modal-create-menu',
        props: {
            categorie: {
                type: Object,
                default: null
            }
        },

        setup(props){
            const initData = inject('initData')
            const toggleCreate = inject('toggleCreate')
            const closeButton = ref(null)
            
            const { formCategorie, fillForm, saveCategorie, error, loading, handleUploadedImage } = useFormCategorieService()

            const submitForm = function(){
                saveCategorie(() => {
                    closeButton.value.click()
                    if(initData) initData()
                })
            }

            const close = function(){
                if(toggleCreate) toggleCreate();
                fillForm(null);
            }

            watch(() => props.categorie, (categorie, prevCategorie) => {
                if(categorie) fillForm(categorie)
            })

            return {
                formCategorie,
                close,
                submitForm,
                error,
                loading,
                handleUploadedImage,
                closeButton
            }
        }
    }
</script>
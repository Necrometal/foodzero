<template>
    <div class="modal fade" id="modalCreateMenu" tabindex="-1" role="dialog" aria-labelledby="modalCreateMenuTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modalCreateMenuTitle">
                    <h5 class="modal-title">
                        New Menu
                    </h5>
                    <button ref="closeButton" @click="close()" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" @submit.prevent="submitForm">
                        <div class="form-group">
                            <label for="categorie">Menu categorie</label>
                            <select v-model="formMenu.categorie" required class="form-control" id="categorie">
                                <option :value="category.id" v-for="category in categories" :key="'menu-category-'+category.id">{{ category.name }}</option>
                            </select>
                            <div v-if="error.categorie">
                                <span class="text-danger" v-for="(categorieError, i) in error.categorie" :key="'categorie-error-'+i">
                                    {{ i == 0 ? '' : ', ' }} {{ categorieError }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Menu name</label>
                            <input v-model="formMenu.name" required type="text" class="form-control" id="name" placeholder="Menu name">
                            <div v-if="error.name">
                                <span class="text-danger" v-for="(nameError, i) in error.name" :key="'name-error-'+i">
                                    {{ i == 0 ? '' : ', ' }} {{ nameError }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Price</label>
                            <input v-model="formMenu.price" required type="text" class="form-control" id="name" placeholder="Price">
                            <div v-if="error.price">
                                <span class="text-danger" v-for="(priceError, i) in error.price" :key="'price-error-'+i">
                                    {{ i == 0 ? '' : ', ' }} {{ priceError }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea v-model="formMenu.description" class="form-control" id="price" placeholder="Price" required></textarea>
                            <div v-if="error.description">
                                <span class="text-danger" v-for="(descriptionError, i) in error.description" :key="'description-error-'+i">
                                    {{ i == 0 ? '' : ', ' }} {{ descriptionError }}
                                </span>
                            </div>
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
    import { useGetAllCategorie } from '@services/categorieservice'
    import { useFormMenuService } from '@services/menuservice'

    export default {
        name: 'modal-create-menu',
        props: {
            menu: {
                type: Object,
                default: null
            }
        },

        async setup(props){
            const initData = inject('initData')
            const toggleCreate = inject('toggleCreate')
            const closeButton = ref(null)

            const categories = await useGetAllCategorie();
            
            const { formMenu, fillForm, saveMenu, error, loading, handleUploadedImage } = useFormMenuService()

            const submitForm = function(){
                saveMenu(() => {
                    closeButton.value.click()
                    if(initData) initData()
                })
            }

            const close = function(){
                if(toggleCreate) toggleCreate();
                fillForm(null);
            }

            watch(() => props.menu, (menu, prevMenu) => {
                if(menu) fillForm(menu)
            })

            return {
                formMenu,
                close,
                submitForm,
                error,
                loading,
                handleUploadedImage,
                closeButton,
                categories
            }
        }
    }
</script>
<template>
    <div>
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">
                        <div class="me-md-3 me-xl-5">
                            <h2>List categorie</h2>
                            <div class="d-flex">
                                <i class="mdi mdi-home text-muted hover-cursor"></i>
                                <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                                <p class="text-primary mb-0 hover-cursor">Categorie</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <button @click="toggleCreate()" class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalCreateCategorie">
                            New Categorie
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- content start -->
        <div class="card">
            <div class="card-desc">
                <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status" v-if="loading">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="category in categories" :key="'category-item-'+category.id">
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.description }}</td>
                                    <td>{{ category.deleted_at ? 'Deleted' : 'Active' }}</td>
                                    <td class="d-flex">
                                        <button class="btn btn-dark btn-rounded btn-icon" data-bs-toggle="modal" data-bs-target="#modalShowCategory" title="show" @click="toggle(category)">
                                            <i class="mdi mdi-eye menu-icon"></i>
                                        </button>

                                        <button @click="toggleCreate(category)" class="btn btn-primary btn-rounded btn-icon" data-bs-toggle="modal" data-bs-target="#modalCreateCategorie" title="update">
                                            <i class="mdi mdi-pencil menu-icon"></i>
                                        </button>

                                        <button @click="deleteCategorieRequest(category)" class="btn btn-danger btn-rounded btn-icon" title="delete">
                                            <i class="mdi mdi-delete menu-icon"></i>
                                        </button>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- content end -->

        <!-- modal start -->
        <div class="modal fade" id="modalShowCategory" tabindex="-1" role="dialog" aria-labelledby="modalShowCategoryTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content" v-if="toShow">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalShowCategoryTitle">{{ toShow.name }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" @click="toggle()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column align-items-center">
                        <div>
                            {{ toShow.description }}
                        </div>

                        <img style="width: 500px" :src="asset + 'categories/' + toShow.image" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="toggle()">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->

        <!-- modal create start -->
            <ModalCreateCategorie :categorie="toHandle" />
        <!-- modal create end -->
    </div>
</template>

<script>
    import { useCategorieService } from '@services/categorieservice'
    import ModalCreateCategorie from '@components/categorie/modalCreate'
    import { provide } from 'vue';
    export default {
        name: 'categorie',
        components: {
            ModalCreateCategorie
        },

        async setup(){
            const asset = window.asset + '/images/'
            const { categories, initData, infinite, toggle, toShow, toHandle, toggleCreate, loading, deleteCategorieRequest } = useCategorieService()

            provide('initData', initData)
            provide('toggleCreate', toggleCreate)

            await initData();
            return {
                categories,
                infinite,
                toggle,
                toShow,
                asset,
                toHandle,
                toggleCreate,
                loading,
                deleteCategorieRequest
            }
        }
    }
</script>
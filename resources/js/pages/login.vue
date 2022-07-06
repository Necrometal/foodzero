<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-8">
                <div class="card-header text-center">
                    Sign In
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert" v-if="error.credential">
                            {{ error.credential }}
                        </div>
                        <div class="alert alert-success" role="alert" v-if="error.succes">
                            {{ error.succes }}
                        </div>
                        <form class="forms-sample" @submit.prevent="signIn">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input v-model="formLogin.email" required type="email" class="form-control" id="email" placeholder="Email">
                                <div v-if="error.email">
                                    <span class="text-danger" v-for="(emailError, i) in error.email" :key="'email-error-'+i">
                                        {{ i == 0 ? '' : ', ' }} {{ emailError }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input v-model="formLogin.password" required type="password" class="form-control" id="password" placeholder="Password">
                                <div v-if="error.password">
                                    <span class="text-danger" v-for="(emailError, i) in error.email" :key="'email-error-'+i">
                                        {{ i == 0 ? '' : ', ' }} {{ emailError }}
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2" v-if="!loading">Submit</button>

                            <div class="btn btn-primary me-2" v-if="loading">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { useLoginService } from '@services/userservice'
    export default {
        name: 'login',
        setup(){
            const { formLogin, error, loading, submit, signIn } = useLoginService() 

            return {
                formLogin,
                error,
                loading,
                submit,
                signIn,
            }
        }
    }
</script>

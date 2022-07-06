<template>
    <div>
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">
                        <div class="me-md-3 me-xl-5">
                            <h2>List subscription</h2>
                            <div class="d-flex">
                                <i class="mdi mdi-home text-muted hover-cursor"></i>
                                <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                                <p class="text-primary mb-0 hover-cursor">Subscription</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- content start -->
        <div class="card">
            <div class="card-bod">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Date</th>
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="subscription in subscriptions" :key="'reservation-item-'+subscription.id">
                                    <td>{{ subscription.email }}</td>
                                    <td>{{ subscription.created_at }}</td>
                                    <!-- <td class="d-flex">
                                        <button class="btn btn-dark btn-rounded btn-icon" data-bs-toggle="modal" data-bs-target="#modalShowReservation" title="show" @click="toggle(reservation)">
                                            <i class="mdi mdi-eye menu-icon"></i>
                                        </button>
                                    </td> -->
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- content end -->
    </div>
</template>

<script>
    import { useSubscriptionService } from '@services/subscriptionservice'
    export default {
        name: 'subscription',

        async setup(){
            const { subscriptions, initData, infinite } = useSubscriptionService()
            await initData();
            return {
                subscriptions,
                infinite,
            }
        }
    }
</script>
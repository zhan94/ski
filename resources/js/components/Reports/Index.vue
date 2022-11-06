<template>
    <div class="card">
        <form @submit.prevent="report">
            <div class="card-body">
                <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>{{ strSuccess }}</strong>
                </div>
                <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>{{ strError }}</strong>
                </div>

                <div class="d-flex justify-content-between pb-2 mb-2">
                    <h5 class="card-title">Справки за услуга</h5>
                </div>

                <h4 class="alert alert-info">Избери друга дата</h4>
                <div class="row mb-3">

                    <div class="col-sm-3">
                        <select class="form-control" v-model="service" id="service">
                            <option value="">Моля изберете Услуга</option>
                            <option v-for="service in services" :key="service.id" :value="service.id">
                                {{ service.name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-sm-3">
                        <v-date-picker v-model="range" is-range>
                            <template v-slot="{ inputValue, inputEvents }">
                                <div class="flex justify-center items-center">
                                    <input
                                        :value="inputValue.start + 'г. - ' + inputValue.end + 'г.'"
                                        v-on="inputEvents.start"
                                        class="border px-2 py-1 w-32 rounded focus:outline-none focus:border-indigo-300"
                                    />
                                </div>
                            </template>
                        </v-date-picker>
                    </div>

                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary">Справка</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import 'v-calendar/dist/style.css';
import {Calendar, DatePicker} from 'v-calendar';

export default {
    components: {
        Calendar,
        DatePicker
    },
    data() {
        return {
            services: [],
            service: '',
            inputValue: '',
            strSuccess: '',
            strError: '',
            date: new Date(),
            selected: {},

        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/services')
                .then(response => {
                    this.services = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

        });
    },
    methods: {
        report(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/report')
                    .then(response => {
                        this.equips = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                console.log(response.data);
            });
        }
    },
}
</script>

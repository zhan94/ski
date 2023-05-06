<template>
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between pb-2 mb-2">
                <h2 class="alert alert-info">Списък с дати за всички услуги</h2>
                <div>
                    <button style="margin-right: 15px" class="btn btn-lg btn-success" type="button" @click="add">
                        Добави дати за услуга
                    </button>
                    <router-link :to="{name:'titles'}" class="btn btn-lg btn-info">
                        Наименования услуги, редакция, изтриване на иаименованиеи
                    </router-link>
                </div>
            </div>

            <div class="container" v-for="service in services" :key="service.id">
                <h3>{{ service.name }}</h3>
                <table class="table table-hover table-bordered table-responsive">
                    <thead class="bg-dark text-light">
                    <tr>
                        <th>За дати</th>
                        <th style="width: 11%">Записани деца</th>
                        <th>Списък</th>
                        <th>Редакция</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="data in service.data" :key="data.id">
                        <td>
                            <span v-for="date in data.data_dates">
                                {{ date.service_data_date }},
                            </span>
                        </td>
                        <td class="text-center">
                            <h4 v-for="totals in data.kids_count" :key="data.id">
                                <span class="badge bg-secondary">
                                    {{ totals.count_total }} / {{ data.max }}
                                </span>
                            </h4>
                        </td>
                        <td class="text-center">
                            <router-link :to="{name:'data', params: {id:data.id}}" class="btn btn-primary">
                                <span class="bi-search"></span>
                            </router-link>
                        </td>
                        <td class="text-center">
                            <router-link @click="edit" :to="{name:'services', params: {id:data.id}}"
                                         class="btn btn-warning">
                                <span class="bi-pencil"></span>
                            </router-link>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import Add from "../Data/Add.vue";
import Edit from "../Data/Edit.vue";
import {ModalSize} from "vue-bs-modal";

export default {
    data() {
        return {
            services: [],
            data: [],
            data_dates: [],
            kids_count: [],
            count_total: '',
            service_data_date: '',
            strSuccess: '',
            strError: ''
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
        add() {
            this.$vbsModal.open({
                content: Add,
                size: ModalSize.LARGE,
                staticBackdrop: this.staticBackdrop,
                contentEmits: {
                    onUpdate: this.onUpdate,
                },
                backgroundScrolling: false,
            });
        },
        edit(id) {
            this.$vbsModal.open({
                content: Edit,
                contentProps: {
                    id: id
                },
                size: ModalSize.LARGE,
                staticBackdrop: this.staticBackdrop,
                contentEmits: {
                    onUpdate: this.onUpdate,
                },
                backgroundScrolling: false,
            });
        },
    },
}
</script>

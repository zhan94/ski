<template>
    <div class="card container">
        <form @submit.prevent="addLocation">
            <div class="card-body">
                <div class="d-flex justify-content-between pb-2 mb-2">
                    <h2 class="alert alert-info">Добавяне на дете към базата с данни</h2>
                    <div>
                        <button type="submit" class="btn btn-outline-primary">Добави</button>
                        <a class="btn btn-outline-danger" type="button">
                            <router-link :to="{name: 'kids'}">Отказ</router-link>
                        </a>
                    </div>
                </div>

                <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>{{ strSuccess }}</strong>
                </div>
                <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>{{ strError }}</strong>
                </div>

                <div class="row g-3">
                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Име</label>
                        <input type="text" class="form-control" v-model="firstname">
                    </div>

                    <div class="col-sm-3">
                        <label for="lastName" class="form-label">Презиме</label>
                        <input type="text" class="form-control" v-model="surname">
                    </div>

                    <div class="col-sm-3">
                        <label for="lastName" class="form-label">Фамилия</label>
                        <input type="text" class="form-control" id="lastName" v-model="lastname">
                    </div>

                    <div class="col-3">
                        <label for="username" class="form-label">Дата на раждане</label>
                        <div class="input-group has-validation">
                            <datepicker v-model="birth_date"/>

                        </div>
                    </div>

                    <div class="col-4">
                        <label for="email" class="form-label">Име на родител</label>
                        <input type="text" class="form-control" v-model="parent_name">
                    </div>

                    <div class="col-4">
                        <label for="address" class="form-label">Телефон на родител</label>
                        <input type="text" class="form-control" v-model="parent_phone_number">
                    </div>

                    <div class="col-4">
                        <label for="address" class="form-label">Е-mail</label>
                        <input type="text" class="form-control" v-model="parent_email">
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue'
const birth_date = ref(new Date())
export default {

    data() {
        return {
            firstname: '',
            surname: '',
            lastname: '',
            birth_date: '',
            active: '',
            parent_name: '',
            parent_email: '',
            parent_phone_number: '',
            strError: '',
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
        addPrice: function () {
            this.prices.push({value: ''});
            this.days.push({value: ''});
            this.removes.push({value: ''});
        },
        addLocation(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();
                formData.append('service_id', this.service);
                formData.append('name', this.name);
                formData.append('days', this.days);
                formData.append('price', this.prices);
                this.$axios.post('/api/equips', formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                    })
                    .catch(function (error) {
                        existingObj.strSuccess = "";
                        existingObj.strError = error.response.data.message;
                    });
            });
        }
    },
}
</script>

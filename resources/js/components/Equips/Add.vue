<template>
    <div class="card">
        <form @submit.prevent="add">
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
                    <h5 class="card-title">Добавяне на екипировка</h5>
                    <div style="margin-left: 75%">
                        <router-link :to="{name: 'equips'}" class="btn btn-success">Отказ</router-link>
                    </div>
                    <button type="submit" class="btn btn-primary">Добави</button>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-sm-6 col-form-label">
                        Наименование на екипировка
                    </label>
                    <div class="col-sm-6">
                        <input v-model="name" type="text" class="form-control" id="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="service" class="col-sm-6 col-form-label">Избор на услуга</label>
                    <div class="col-sm-6">
                        <select class="form-control" v-model="service" id="service">
                            <option value="">Моля изберете Услуга</option>
                            <option v-for="service in services" :key="service.id" :value="service.id">
                                {{ service.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-6 col-form-label">Добавяне на цена</label>
                    <div class="col-sm-2">
                        <span type="text" style="border-width: 0 !important;font-weight: bold;" class="form-control"
                              placeholder="Дни:">Дни</span>
                    </div>
                    <div class="col-sm-2" style="margin-bottom: 10px;">
                        <span type="text" style="border-width: 0 !important;font-weight: bold;" class="form-control"
                              placeholder="Цена:">Цена</span>
                    </div>
                    <div class="col-sm-1">
                        <a @click="addPrice" class="btn btn-primary remove_payment"><span class="bi-plus-circle"></span>
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div v-for="day in days" class="col-sm-2" style="margin-left: 50%">
                        <input type="text" class="form-control" placeholder="Дни:" v-model="day.value">
                    </div>
                    <div v-for="price in prices" class="col-sm-2">
                        <input type="text" class="form-control" placeholder="Цена:" v-model="price.value">
                    </div>
                    <div v-for="remove in removes" class="col-sm-1">
                        <a @click="removePrice" class="btn btn-danger remove"><span
                            class="bi-calendar-minus"></span> </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            services: [],
            service: '',
            name: '',
            days: [],
            prices: [],
            removes: [],
            strSuccess: '',
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
            this.days.push({value: ''});
            this.prices.push({value: ''});
            this.removes.push({value: ''});
        },
        add(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();
                formData.append('service_id', this.service);
                formData.append('name', this.name);
                formData.append('days', JSON.stringify(this.days));
                formData.append('price', JSON.stringify(this.prices));
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

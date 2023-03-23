<template>
    <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ strSuccess }}</strong>
    </div>
    <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ strError }}</strong>
    </div>
    <div class="modal-header">
        <h3 class="modal-title">Добавяне на екипировка</h3>
        <button
            type="button"
            class="btn-close"
            aria-label="Close"
            @click="close"
        ></button>
    </div>
    <div class="modal-body">
        <form>

            <div class="mb-3">
                <label class="form-label">Наименование на екипировка</label>
                <input v-model="name" type="text" class="form-control" id="name">
            </div>

            <div class="mb-3">
                <label class="form-label">За услуга</label>
                <select class="form-control" v-model="service">
                    <option value="">Моля изберете Услуга</option>
                    <option v-for="service in services" :key="service.id" :value="service.id">
                        {{ service.name }}
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <a @click="addPrice" type="button" class="btn btn-primary">Добавяне на цени <span class="bi-plus-circle"></span></a>
            </div>
            <div v-for="(item, k) in items">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Дни:" v-model="item.days">
                </div>
                <div  class="mb-3">
                    <input type="text" class="form-control" placeholder="Цена:" v-model="item.prices">
                </div>
                <div class="mb-3">
                    <a @click="remove(k, item)" class="btn btn-danger remove"><span class="bi-calendar-minus"></span> </a>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="close">
            Отмяна
        </button>

        <button type="button" class="btn btn-success" @click="create">
            Добавяне
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            services: [],
            service: '',
            name: '',
            items: [{
                days: '',
                prices: ''
            }],
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
        close() {
            this.$vbsModal.close();
        },
        addPrice: function () {
            this.items.push({
                days: '',
                prices: ''
            });
        },
        create(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();
                formData.append('service_id', this.service);
                formData.append('name', this.name);
                formData.append('items',JSON.stringify(this.items));
                this.$axios.post('/api/equips', formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                        setTimeout(function () {
                            this.$router.go(this.$router.currentRoute)
                        }.bind(this), 1500);
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

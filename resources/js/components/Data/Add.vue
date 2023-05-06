<style>
#vbs-modal > span > div.modal.bs-dialog-show > div > div > div.modal-body > form > div:nth-child(3) > div > div.dp__menu.dp__relative.dp__theme_light > div > div > div:nth-child(2) > div{
    display: none;
}
</style>
<template>

    <div class="modal-header">
        <h3 class="modal-title">Добавяне на дати за услуга</h3>
        <button
            type="button"
            class="btn-close"
            aria-label="Close"
            @click="close"
        ></button>
    </div>
    <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ strSuccess }}</strong>
    </div>
    <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ strError }}</strong>
    </div>
    <div class="modal-body">
        <form>
            <div class="mb-3">
                <label class="form-label">Избор на услуга</label>
                <select class="form-control" v-model="service">
                    <option value="">Моля изберете Услуга</option>
                    <option v-for="service in services" :key="service.id" :value="service.id">
                        {{ service.name }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Максимален брой на деца за услуга</label>
                <input type="text" class="form-control" v-model="max">
            </div>
            <div class="mb-3">
                <label class="form-label">Дати за услуга</label>
                <Datepicker v-model="dates" :hideNavigation="['hours']" multiDates inline autoApply/>
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
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
    data() {
        return {
            dates: [],
            services: [],
            service: '',
            max: '',
            strSuccess: '',
            strError: '',
        }
    },
    components: {
        Datepicker
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
        create() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();
                formData.append('service_id', this.service);
                formData.append('max', this.max);
                formData.append('dates', JSON.stringify(this.dates));
                this.$axios.post('/api/data', formData)
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
    }
}
</script>

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
                <Datepicker v-model="dates" modelAuto multiDates inline autoApply />
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
            inputValue: '',
            strSuccess: '',
            strError: '',
            selected: {},
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
        }
    }
}
</script>

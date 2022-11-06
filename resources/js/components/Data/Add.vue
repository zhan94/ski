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
                <m-date-picker v-model="dates" :multi="multi"></m-date-picker>
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
import mDatePicker from 'vue-multi-date-picker'

export default {
    data() {
        return {
            multi: true,
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
        mDatePicker
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

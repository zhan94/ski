<template>
    <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ strSuccess }}</strong>
    </div>
    <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ strError }}</strong>
    </div>
    <div class="modal-header">
        <h3 class="modal-title">Добавяне на местоположение</h3>
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
                    <option value="">Избор на услуга</option>
                    <option  v-for="service in services" :key="service.id" :value="service.id">
                        {{ service.name }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Местоположение взимане</label>
                <input type="text" class="form-control" v-model="pick_up_place">
            </div>

            <div class="mb-3">
                <label class="form-label">Местоположение оставяне</label>
                <input type="text" class="form-control" v-model="drop_down_place">
            </div>

            <div class="mb-3">
                <label class="form-label">Час на взимане</label>
                <input type="text" class="form-control" v-model="pick_up_time">
            </div>

            <div class="mb-3">
                <label class="form-label">Час на оставяне</label>
                <input type="text" class="form-control" v-model="drop_down_time">
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
export default{
    data() {
        return {
            services: [],
            service: '',
            pick_up_place: '',
            drop_down_place: '',
            pick_up_time: '',
            drop_down_time: '',
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
        create(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;

                const formData = new FormData();
                formData.append('service_id', this.service);
                formData.append('pick_up_place', this.pick_up_place);
                formData.append('drop_down_place', this.drop_down_place);
                formData.append('pick_up_time', this.pick_up_time);
                formData.append('drop_down_time', this.drop_down_time);
                this.$axios.post('/api/locations', formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                        setTimeout(function () { this.close() }.bind(this), 1500);
                    })
                    .catch(function(error) {
                        existingObj.strSuccess ="";
                        existingObj.strError = error.response.data.message;
                    });
            });
        }

    },
}

</script>

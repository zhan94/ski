<template>

    <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ strSuccess }}</strong>
    </div>

    <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ strError }}</strong>
    </div>
    <div class="modal-header">
        <h3 class="modal-title">Редакция на местоположение за услуга {{ service_name }}</h3>
        <button
            type="button"
            class="btn-close"
            aria-label="Close"
            @click="close"
        ></button>
    </div>
    <div class="modal-body">
        <form @submit.prevent="update">
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
        <button type="button" class="btn btn-danger" @click="deleteLocation(this.$route.params.id)">
            Изтриване
        </button>
        <button type="button" class="btn btn-success" @click="update">
            Редакция
        </button>
    </div>


</template>

<script>
export default {
    data() {
        return {
            id: '',
            service_id: '',
            service_name: '',
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
            this.$axios.get(`/api/locations/${this.$route.params.id}`)
                .then(response => {
                    this.service_id = response.data['service']['id']
                    this.service_name = response.data['service']['name'];
                    this.pick_up_place = response.data['pick_up_place'];
                    this.drop_down_place = response.data['drop_down_place'];
                    this.pick_up_time = response.data['pick_up_time'];
                    this.drop_down_time = response.data['drop_down_time'];
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
        update(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;

                const formData = new FormData();
                formData.append('service_id', this.service_id);
                formData.append('pick_up_place', this.pick_up_place);
                formData.append('drop_down_place', this.drop_down_place);
                formData.append('pick_up_time', this.pick_up_time);
                formData.append('drop_down_time', this.drop_down_time);

                this.$axios.put(`/api/locations/${this.$route.params.id}`, formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                        setTimeout(function () {
                            this.close()
                        }.bind(this), 1500)
                    })
                    .catch(function (error) {
                        existingObj.strSuccess = "";
                        existingObj.strError = error.response.data.message;
                    });

            });
        },
        deleteLocation(id) {
            this.$vbsModal
                .confirm({
                    message: "Потвърждение за изтриване?",
                    title: "Изтриване на местоположение",
                    leftBtnText: "Отмяна",
                    rightBtnText: "Изтриване",
                    staticBackdrop: this.staticBackdrop,
                    center: this.center,
                })
                .then((confirmed) => {
                    if (confirmed) {
                        this.$axios.get('/sanctum/csrf-cookie').then(response => {
                            let existingObj = this;
                            this.$axios.delete(`/api/locations/${id}`)
                                .then(response => {
                                    let i = this.locations.map(item => item.id).indexOf(id);
                                    this.locations.splice(i, 1);
                                    existingObj.strError = "";
                                    existingObj.strSuccess = response.data.success;
                                    setTimeout(function () {
                                        this.$vbsModal.close()
                                    }.bind(this), 1500)
                                })
                                .catch(function (error) {
                                    existingObj.strError = "";
                                    existingObj.strSuccess = error.response.data.message;
                                });
                        })
                    }
                });
        }
    },
}

</script>

<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Добавяне на местоположение</h5>
                <div>
                    <router-link :to="{name: 'locations'}" class="btn btn-success">Отказ</router-link>
                </div>
            </div>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strSuccess}}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strError}}</strong>
            </div>


            <form @submit.prevent="updateLocation" >
                <div class="form-group mb-2">
                    <label>За услуга услуга</label>
                    <span class="form-control"> {{ service_name }}</span>
                </div>

                <div class="form-group mb-2">
                    <label>Местоположение взимане</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="pick_up_place" placeholder="Местоположение взимане">
                </div>

                <div class="form-gorup mb-2">
                    <label>Местоположение оставяне</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="drop_down_place" placeholder="Местоположение оставяне">
                </div>

                <div class="form-group mb-2">
                    <label>Час на взимане</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="pick_up_time" placeholder="Час на взимане">
                </div>

                <div class="form-gorup mb-2">
                    <label>Час на оставяне</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="drop_down_time" placeholder="Час на оставяне">
                </div>

                <button type="submit" class="btn btn-primary mt-4 mb-4">Редакция</button>

            </form>

        </div>
    </div>
</template>

<script>
export default{
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
        updateLocation(e) {
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

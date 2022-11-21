<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h2 class="alert alert-info">Местоположения</h2>
                <div>
                    <button class="btn btn-lg btn-success" type="button" @click="this.$router.push('/locations/add')">
                        Добави Местоположение
                    </button>
                </div>
            </div>

            <div class="container" v-for="service in locations" :key="service.name">
                <h2 class="alert alert-info">{{ service.name }}</h2>
                <table class="table table-hover table-bordered table-responsive">
                    <thead class="bg-dark text-light">
                    <tr>
                        <th>Взимане</th>
                        <th>Оставяне</th>
                        <th>Час на взимане</th>
                        <th>Част на оставяне</th>
                        <th class="text-center" width="200">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="location in service.locations" :key="location.id">
                        <td>{{ location.pick_up_place }}</td>
                        <td>{{ location.drop_down_place }}</td>
                        <td>{{ location.pick_up_time }}</td>
                        <td>{{ location.drop_down_time }}</td>
                        <td class="text-center">
                            <router-link :to="{name:'editlocation', params: {id:location.id}}" class="btn btn-warning">
                                Edit
                            </router-link>
                            <button class="btn btn-danger" @click="deleteLocation(location.id)">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            locations: [],
            strSuccess: '',
            strError: ''
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/locations')
                .then(response => {
                    this.locations = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

        });
    },
    methods: {
        deleteLocation(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                if (confirm("Потвърждение за изтриване")) {
                    this.$axios.delete(`/api/locations/${id}`)
                        .then(response => {
                            let i = this.locations.map(item => item.id).indexOf(id); // find index of your object
                            this.locations.splice(i, 1);
                            existingObj.strError = "";
                            existingObj.strSuccess = response.data.success;
                        })
                        .catch(function (error) {
                            existingObj.strError = "";
                            existingObj.strSuccess = error.response.data.message;
                        });
                }
            });
        }
    },
}
</script>

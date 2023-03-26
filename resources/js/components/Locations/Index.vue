<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h2 class="alert alert-info">Местоположения</h2>
                <div>
                    <button class="btn btn-lg btn-success" type="button" @click="add">
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
                        <tr v-for="location in service.locations" :key="locations.id">
                            <td>{{ location.pick_up_place }}</td>
                            <td>{{ location.drop_down_place }}</td>
                            <td>{{ location.pick_up_time }}</td>
                            <td>{{ location.drop_down_time }}</td>
                            <td class="text-center">
                                <button @click="edit(location.id)" class="btn btn-primary">
                                    Редактиране
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import Add from "./Add.vue";
import Edit from "./Edit.vue";
import { ModalSize } from "vue-bs-modal";
export default {
    data() {
        return {
            locations: [],
            id: '',
            service_id: '',
            service_name: '',
            pick_up_place: '',
            drop_down_place: '',
            pick_up_time: '',
            drop_down_time: '',
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
        edit(id) {
            this.$vbsModal.open({
                content: Edit,
                contentProps: {
                    id: id
                },
                size: ModalSize.LARGE,
                staticBackdrop: this.staticBackdrop,
                contentEmits: {
                    onUpdate: this.onUpdate,
                },
                backgroundScrolling: true,
            });
        },
        update(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                const formData = new FormData();
                formData.append('service_id', this.service_id);
                formData.append('pick_up_place', this.pick_up_place);
                formData.append('drop_down_place', this.drop_down_place);
                formData.append('pick_up_time', this.pick_up_time);
                formData.append('drop_down_time', this.drop_down_time);
            });

        },
        add(){
            this.$vbsModal.open({
                content: Add,
                size: ModalSize.LARGE,
                staticBackdrop: this.staticBackdrop,
                contentEmits: {
                    onUpdate: this.onUpdate,
                },
                backgroundScrolling: false,
            });
        },

    },
}
</script>

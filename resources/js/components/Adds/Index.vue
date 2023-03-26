<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h2 class="alert alert-info">Допълнителни Занятия</h2>
                <div>
                    <button class="btn btn-lg btn-success" type="button" @click="add">
                        Добави допълнителни Занятия
                    </button>
                </div>
            </div>

            <div class="container">
                <table class="table table-hover table-bordered table-responsive">
                    <thead class="bg-dark text-light">
                    <tr>
                        <th>Услуга</th>
                        <th>Период</th>
                        <th>Спирка Взимане</th>
                        <th>Спирка Оставяне</th>
                        <th>Цени</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="service in services" :key="services.id">
                        <td>{{ service.name }}</td>
                        <td>{{ service.from_date }}г. - {{ service.to_date }}г.</td>
                        <td>{{ service.pick_up_place }}</td>
                        <td>{{ service.drop_down_place }}</td>
                        <td>
                            <div v-for="price in service.prices" :key="price.id">
                                Цена за {{ price.day }}
                                <span v-if="price.day === 1">ден:</span>
                                <span>дни:</span>
                                {{ price.price }} лв.
                            </div>
                        </td>
                        <td class="text-center">
                            <button  @click="edit(service.id)" class="btn btn-primary">
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
            services: [],
            strSuccess: '',
            strError: ''
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/additional_services')
                .then(response => {
                    this.services = response.data;
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
        }
    },
}
</script>

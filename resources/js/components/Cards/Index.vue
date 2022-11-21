<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h2 class="alert alert-info">Карти</h2>
                <div>
                    <button class="btn btn-lg btn-success" type="button" @click="add">
                        Добави Карта
                    </button>
                </div>
            </div>

            <div class="container">
                <table class="table table-hover table-bordered table-responsive">
                    <thead class="bg-dark text-light">
                    <tr>
                        <th>Наименование</th>
                        <th>За услуга</th>
                        <th>Цени</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="card in cards" :key="cards.id">
                        <td>{{ card.name }}</td>
                        <td>{{ card.service.name }}</td>
                        <td>
                            <div v-for="price in card.prices" :key="price.id">
                                Цена за {{ price.days }}
                                <span v-if="price.days === '1'">ден:</span>
                                <span v-else>дни:</span>
                                 {{ price.price }}лв.
                            </div>
                        </td>
                        <td class="text-center">
                            <router-link  @click="edit" :to="{name:'cards', params: {id:card.id}}" class="btn btn-primary">
                                Редактиране
                            </router-link>
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
            cards: [],
            strSuccess: '',
            strError: ''
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/cards')
                .then(response => {
                    this.cards = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

        });
    },
    methods: {
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
        edit() {
            this.$vbsModal.open({
                content: Edit,
                size: ModalSize.LARGE,
                staticBackdrop: this.staticBackdrop,
                contentEmits: {
                    onUpdate: this.onUpdate,
                },
                backgroundScrolling: false,
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

    },
}
</script>

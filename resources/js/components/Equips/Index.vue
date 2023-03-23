<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h2 class="alert alert-info">Екипировки</h2>
                <div>
                    <button class="btn btn-lg btn-success" type="button" @click="add">
                        Добави Екипировка
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
                        <th>Настройки</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="equip in equips" :key="equips.id">
                        <td>{{ equip.name }}</td>
                        <td>{{ equip.service.name }}</td>
                        <td>
                            <div v-for="price in equip.prices" :key="price.id">
                                Цена за {{ price.days }}
                                <span v-if="price.day === 1">ден:</span>
                                <span>дни:</span>
                                 {{ price.price }} лв.
                            </div>
                        </td>
                        <td class="text-center">
                            <router-link  @click="edit" :to="{name:'equips', params: {id:equip.id}}" class="btn btn-primary">
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
import Edit from "../Equips/Edit.vue";
import {ModalSize} from "vue-bs-modal";
import Add from "../Equips/Add.vue";

export default {
    data() {
        return {
            equips: [],
            strSuccess: '',
            strError: ''
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/equips')
                .then(response => {
                    this.equips = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

        });
    },
    methods: {
        edit() {
            this.$vbsModal.open({
                content: Edit,
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
        deleteEquip(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                if (confirm("Потвърждение за изтриване")) {
                    this.$axios.delete(`/api/equips/${id}`)
                        .then(response => {
                            let i = this.equips.map(item => item.id).indexOf(id); // find index of your object
                            this.equips.splice(i, 1);
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

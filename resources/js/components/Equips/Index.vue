<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h2 class="alert alert-info">Екипировки</h2>
                <div>
                    <button class="btn btn-lg btn-success" type="button" @click="this.$router.push('/equips/add')">
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
                            <router-link :to="{name:'editequip', params: {id:equip.id}}" class="btn btn-warning">
                                Edit
                            </router-link>
                            <button class="btn btn-danger" @click="deleteEquip(equip.id)">Delete</button>
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

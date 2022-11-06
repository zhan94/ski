<template>
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between pb-2 mb-2">
                <h2 class="alert alert-info">Списък с всички деца</h2>
                <div>
                    <button class="btn btn-success" type="button" @click="this.$router.push('/kids/add')">
                        Добави дете към базата с данни
                    </button>
                    <button class="btn btn-warning" type="button">
                        Деца с неплатени такси
                    </button>
                </div>
            </div>

                <table class="table table-hover table-bordered table-responsive">
                    <thead class="bg-dark text-light">
                    <tr>
                        <th>Име</th>
                        <th>Възраст</th>
                        <th>Телефон на родител</th>
                        <th>Собстено оборудване</th>
                        <th>Карт за лифт</th>
                        <th class="text-center" width="200">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="kid in kids" :key="kid.id">
                        <td>{{ kid.firstname }} {{ kid.lastname }}</td>
                        <td>{{ kid.birth_date }}</td>
                        <td>{{ kid.parent_phone_number }}</td>
                        <td>{{ kid.parent_name }}</td>
                        <td>{{ kid.parent_email }}</td>
                        <td class="text-center">
                            <router-link :to="{name:'editkid', params: {id:kid.id}}" class="btn btn-warning">
                                Edit
                            </router-link>
                            <button class="btn btn-danger" @click="deleteKid(kid.id)">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            kids: [],
            strSuccess: '',
            strError: ''
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/kids')
                .then(response => {
                    this.kids = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

        });
    },
    methods: {
        deleteKid(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                if (confirm("Потвърждение за изтриване")) {
                    this.$axios.delete(`/api/kids/${id}`)
                        .then(response => {
                            let i = this.locations.map(item => item.id).indexOf(id); // find index of your object
                            this.kids.splice(i, 1);
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

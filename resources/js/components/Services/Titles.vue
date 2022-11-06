<template>

    <div class="card">
        <div class="card-body container">
            <h2 class="alert alert-info">Наименования на услуга</h2>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strSuccess }}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strError }}</strong>
            </div>

            <form @submit.prevent="add">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">
                        Наименование на услуга
                        <i class="text-danger" style="font-size:90%">
                            <br>Броят може да се промени по късно при добавяне на дата за дадена услуга!
                        </i>
                    </label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" v-model="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Максимален брой на деца за услуга</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" v-model="max"
                               placeholder="Максимален брой на деца за услуга">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Добави</button>
            </form>


        </div>

        <div class="container">

            <h2 class="alert alert-info">Списък наименования</h2>

            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th class="col-lg-7">Услуга</th>
                    <th>Максимален брой на деца за услуга</th>
                    <th class="col-lg-1 text-center">Настройки</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="service in services" :key="service.id" :value="service.id">
                    <td><input type="text" class="form-control" v-model="service.name"></td>
                    <td><input type="text" class="form-control" v-model="service.max"></td>
                    <td>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-pen"></i>
                        </button>
                        <button @click="remove({id:service.id})" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
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
            services: [],
            name: '',
            max: '',
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
        update(id, event) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('max', this.max);

                this.$axios.put(`/api/services/${id.id}`, formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                    })
                    .catch(function (error) {
                        existingObj.strSuccess = "";
                        existingObj.strError = error.response.data.message;
                    });

            });
        },
        add() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;

                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('max', this.max);
                this.$axios.post('/api/services', formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                    })
                    .catch(function (error) {
                        existingObj.strSuccess = "";
                        existingObj.strError = error.response.data.message;
                    });
            });
        }

    }
}

</script>

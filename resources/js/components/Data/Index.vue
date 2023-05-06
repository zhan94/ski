<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h2 class="alert alert-info">Записани деца за следните дати за <b>
                    {{ this.data.service.service_name }}</b>
                </h2>
            </div>
            <div class="container">
                <table class="table table-hover table-bordered table-responsive">
                    <thead class="bg-dark text-light">
                    <tr>
                        <th class="col-lg-2">Име на дете</th>
                        <th>Дати</th>
                        <th class="col-lg-2">Местоположение</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="kid in data.kids" :key="kid.id">
                            <td>{{ kid.kid_name.firstname }}</td>
                            <td>
                                <span v-for="date in kid.service_dates">
                                    {{ date.kid_service_date }},
                                </span>
                            </td>
                            <td>
                                {{ kid.location.pick_up_place + ' - ' + kid.location.drop_down_place }} <br/>
                                {{ '(' + kid.location.pick_up_time + ' - ' + kid.location.drop_down_time + ')' }}
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
            data: [],
            service_dates: [],
            kid_name: [],
            service: [],
            service_name: '',
            kid_service_date: '',
            strSuccess: '',
            strError: ''
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/data/${this.$route.params.id}`)
                .then(response => {
                    this.data = response.data;
                })

                .catch(function (error) {
                    console.log(error);
                });
            console.log(response.data);

        });
    }
}
</script>

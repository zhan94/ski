<template>
    <div class="card">
        <form @submit.prevent="report">
            <div class="card-body">
                <div class="d-flex justify-content-between pb-2 mb-2">
                    <h2 class="alert alert-info">Справки</h2>
                </div>
                <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>{{ strError }}</strong>
                </div>
                <div style="margin-left: 25%" class="row mb-3">
                    <div class="col-sm-3">
                        <select class="form-control" v-model="service" id="service">
                            <option value="">Избор на услуга</option>
                            <option v-for="service in services" :key="service.id" :value="service.id">
                                {{ service.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <v-date-picker v-model="range" is-range>
                            <template v-slot="{ inputValue, inputEvents }">
                                <div class="flex justify-center items-center">
                                    <input
                                        :value="inputValue.start + 'г. - ' + inputValue.end + 'г.'"
                                        v-on="inputEvents.start"
                                        class="form-control"
                                    />
                                </div>
                            </template>
                        </v-date-picker>
                    </div>

                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary">Справка</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-body" v-if="display" id="add_form">
            <h3 class="alert alert-info text-center">
                Справки от <b>{{ this.report_data.date_from }}</b> до <b>{{ this.report_data.date_to }}</b>
                за услуга <b> {{ this.report_data.service_name }}</b>
            </h3>

            <table class="table table-hover table-bordered table-responsive col-lg-12 form-inline">
                <thead>
                <tr>
                    <th>Име</th>
                    <th>Дата на раждане</th>
                    <th>Ниво</th>
                    <th>Оборудване</th>
                    <th>Местоположение</th>
                    <!--<th>Допълнителна дейност</th>-->
                    <th>Остава да плати</th>
                    <th class="col-lg-2 col-xs-5">Плащане</th>
                    <th>Родител</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="report in this.report_data.data" :key="report.id">
                    <td>{{ report.kid.firstname + ' ' + report.kid.lastname }}</td>
                    <td>{{ report.kid.birth_date }}</td>
                    <td>{{ report.skill.name }}</td>
                    <td>{{ report.equip.name }}</td>
                    <td>
                        {{ report.location.pick_up_place + ' - ' + report.location.drop_down_place }} <br/>
                        {{ '(' + report.location.pick_up_time + ' - ' + report.location.drop_down_time + ')' }}
                    </td>
                    <td>{{ report.sum - report.paid }}</td>
                    <td>
                        <div class="row mb-3">
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Плащане">
                            </div>
                            <label class="col-sm-4">
                                <button class="btn btn-sm btn-success pay_btn" type="button" name="go">
                                    <i style="font-size: 14px" class="bi bi-box-arrow-in-right"></i>
                                </button>
                            </label>

                        </div>
                    </td>

                    <td>
                        <a href='tel:{{ report.kid.parent_phone_number }}'>{{ report.kid.parent_name }}</a>
                        <br>{{ report.kid.parent_phone_number }}
                    </td>
                </tr>
                </tbody>
            </table>
            <br>
            <button class="col-lg-offset-5 btn btn-lg btn-default">
                <span class="bi bi-print"></span> Принтирай
            </button>
        </div>
    </div>
</template>

<script>
import 'v-calendar/dist/style.css';
import {Calendar, DatePicker} from 'v-calendar';

export default {
    components: {
        Calendar,
        DatePicker
    },
    data() {
        return {
            services: [],
            data: [],
            report_data: [],
            kid: [],
            equip: [],
            location: [],
            skill: [],
            service: '',
            inputValue: '',
            strSuccess: '',
            strError: '',
            range: '',
            display: false,
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
        report() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                let url = '/api/kid_services/add/report/' + this.service + '/' + this.range.start + '/' + this.range.end;
                this.$axios.get(url)

                    .then(response => {
                        this.display = true;
                        this.report_data = response.data;

                    })
                    .catch(function (error) {
                        existingObj.strError = error.response.data.message;
                    });
            });
        }
    },
}
</script>

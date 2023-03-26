<style>
#app > div > div.card-body > div > div.col-xl-9.col-lg-9.col-md-12.col-sm-12.col-12 > div > div > div.col-xl-12.col-lg-6.col-md-6.col-sm-6.col-12 > div > div > div.dp__menu.dp__relative.dp__theme_light > div > div > div:nth-child(2) {
    display: none;
}
</style>
<template>
    <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ strSuccess }}</strong>
    </div>
    <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ strError }}</strong>
    </div>
    <div class="card container">
        <br/>
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h2 class="alert alert-info">Добавяне на дете за услуга</h2>
        </div>
        <form>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Име Фамилия</label>
                <div class="col-sm-10">
                    <vue3-simple-typeahead
                        id="typeahead_id"
                        placeholder="Автоматично генериране..."
                        class="form-control"
                        :items=this.kids
                        :minInputLength="1"
                        @selectItem="selectItemEventHandler"
                    >
                    </vue3-simple-typeahead>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Избор на услуга</label>
                <div class="col-sm-10">
                    <select class="form-control" v-model="service_type">
                        <option value="">Моля изберете Услуга</option>
                        <option v-for="service_type in service_types" :key="service_type.id" :value="service_type.id">
                            {{ service_type.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1">
                            Ново дете
                        </label>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button @click="search" type="button" class="btn btn-primary">Покажи формата</button>
            </div>
        </form>
        <br>
        <div class="card-body" v-if="display" id="add_form">

            <div class="row gutters">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">

                                    <h4 class="user-name">{{ firstname + ' ' + surname + ' ' + lastname }}</h4>
                                    <h5 class="user-email">
                                        <i class="bi bi-calendar-event"></i>
                                        {{ birth_date }}г.
                                    </h5>
                                </div>
                                <div class="about">
                                    <h4>{{ parent_name }}</h4>
                                    <h5>
                                        <i class="bi bi-telephone"></i>
                                        {{ parent_phone_number }}
                                    </h5>
                                    <h5>
                                        <i class="bi bi-envelope"></i>
                                        {{ parent_email }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h5 class="mb-2 text-primary">Услуга</h5>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">Избор на услуга:</label>
                                        <select class="form-control" v-model="service" @change="loadLocations($event)">
                                            <option v-for="service in services" :key="service.id" :value="service.id">
                                                {{ service.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="eMail">Местоположение:</label>
                                        <select class="form-control" v-model="location">
                                            <option v-for="location in locations" :key="location.id"
                                                    :value="location.id">
                                                {{ location.pick_up_place + ' - ' + location.drop_down_place }}
                                                {{
                                                    '(' + location.pick_up_time + ' - ' + location.drop_down_time + ')'
                                                }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row gutters" v-if="service_id==1">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">Ниво на дете</label>
                                        <select class="form-control" v-model="skill">
                                            <option v-for="skills in skills" :key="skills.id" :value="skills.id">
                                                {{ skills.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                    <div class="form-group">
                                        <br>
                                        <label for="card">Kарта &nbsp;</label>
                                        <input
                                            id="card"
                                            type="checkbox"
                                            v-model="card"
                                            true-value="1"
                                        />
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                    <br>
                                    <div class="form-group">
                                        <label for="equip">Oборудване &nbsp;</label>
                                        <input
                                            id="equip"
                                            type="checkbox"
                                            v-model="equip"
                                            true-value="1"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h5 class="mb-2 text-primary">
                                        Плащане</h5></div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Стойност на услугата:</label>
                                        <input class="form-control" v-model="sum">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Платено при записване:</label>
                                        <input class="form-control" v-model="paid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Дати за услуга</label>
                                    <Datepicker v-model="dates" multiDates inline autoApply/>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input v-model="approved" type="checkbox" value="1" name="approved">
                                                Сканирана форма за съгласие на родителя
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Забележка</label>
                                        <textarea class="form-control" v-model="note" rows="6" placeholder="Забележка" spellcheck="false"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button @click="create()" type="submit" class="btn btn-primary mt-4 mb-4">Добавяне</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import SimpleTypeahead from 'vue3-simple-typeahead';
import 'vue3-simple-typeahead/dist/vue3-simple-typeahead.css'
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
    name: 'my-vue-component',
    components: {
        SimpleTypeahead,
        Datepicker
    },
    data() {
        return {
            services: [],
            locations: [],
            kids: [],
            service_types: [],
            selected_kid: [],
            dates: [],
            skills: [],
            skill: 0,
            card: 0,
            equip: 0,
            sum: '',
            paid: '',
            approved: '',
            note: '',
            kid_id: '',
            service_type: '',
            service: '',
            firstname: '',
            surname: '',
            lastname: '',
            birth_date: '',
            parent_name: '',
            parent_phone_number: '',
            parent_email: '',
            service_id: '',
            service_name: '',
            pick_up_place: '',
            drop_down_place: '',
            pick_up_time: '',
            drop_down_time: '',
            display: false,
            strSuccess: '',
            strError: '',
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/kid_services/add')
                .then(response => {
                    this.kids = response.data.kids;
                    this.service_types = response.data.service_types;
                })
                .catch(function (error) {
                    console.log(error);
                });

        });
    },
    methods: {
        selectItemEventHandler(item) {
            this.selected_kid = item;
        },
        search() {
            if (this.selected_kid !== '') {
                this.kid_id = this.selected_kid.split(' ')[0];
            }
            let service_type = this.service_type;

            if (service_type) {
                this.display = true;
            }
            let url = '/api/kid_services/add/search/' + this.kid_id + '/' + service_type;

            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get(url)
                    .then(response => {
                        this.firstname = response.data['kid']['firstname'];
                        this.surname = response.data['kid']['surname'];
                        this.lastname = response.data['kid']['lastname'];
                        this.birth_date = response.data['kid']['birth_date'];
                        this.parent_name = response.data['kid']['parent_name'];
                        this.parent_phone_number = response.data['kid']['parent_phone_number'];
                        this.parent_email = response.data['kid']['parent_email'];
                        this.services = response.data['services'];
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            });
        },
        loadLocations(event) {
            this.service_id = event.target.value;
            this.$axios.get('/api/services/get_locations/' + this.service_id)
                .then(response => {
                    this.locations = response.data.locations;
                    this.skills = response.data.skills;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        create() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();

                formData.append('service_id', this.service);
                formData.append('location_id', this.location);
                formData.append('kid_id', this.kid_id);
                formData.append('location_id', this.location);
                formData.append('skill_id', this.skill);
                formData.append('equip_id', this.equip);
                formData.append('card_id', this.card);
                formData.append('service_type_id', this.service_type);
                formData.append('dates', JSON.stringify(this.dates));
                formData.append('sum', this.sum);
                formData.append('paid', this.paid);
                formData.append('approved', this.approved);
                formData.append('note', this.note);
                formData.append('lunch', this.lunch);
                this.$axios.post('/api/kid_services', formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                        setTimeout(function () {
                            this.close()
                        }.bind(this), 1500);
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

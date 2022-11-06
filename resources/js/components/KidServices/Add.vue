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
                <select class="form-control" v-model="service">
                    <option value="">Моля изберете Услуга</option>
                    <option v-for="service in services" :key="service.id" :value="service.id">
                        {{ service.name }}
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
            <button @click="showForm" type="button" class="btn btn-primary">Покажи формата</button>
        </div>
        <div class="card-body">

            <form v-if="this.show" @submit.prevent="addLocation" >
                <div class="row g-3">
                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Име</label>
                        <input type="text" class="form-control" v-model="this.firstname">
                    </div>

                    <div class="col-sm-3">
                        <label for="lastName" class="form-label">Презиме</label>
                        <input type="text" class="form-control" v-model="surname">
                    </div>

                    <div class="col-sm-3">
                        <label for="lastName" class="form-label">Фамилия</label>
                        <input type="text" class="form-control" id="lastName" v-model="lastname">
                    </div>

                    <div class="col-3">
                        <label for="username" class="form-label">Дата на раждане</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="birth_date" v-model="birth_date">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-4">
                        <label for="email" class="form-label">Име на родител</label>
                        <input type="text" class="form-control" v-model="parent_name">
                    </div>

                    <div class="col-4">
                        <label for="address" class="form-label">Телефон на родител</label>
                        <input type="text" class="form-control" v-model="parent_phone_number">
                    </div>

                    <div class="col-4">
                        <label for="address" class="form-label">Е-mail адрес</label>
                        <input type="text" class="form-control" v-model="parent_email">
                    </div>
                </div>
                <hr>


                <div class="row g-3">

                    <label class="col-sm-2 control-label">Плащане </label>
                    <label class="col-sm-2 control-label">Стойност на услугата: </label>
                    <div class="col-sm-2">
                        <input type="text" id="sum_paid" class="form-control col-sm-2" name="sum_paid" value=""
                               placeholder="Стойност на услугата">
                    </div>
                    <label class="col-sm-2 control-label" style="width: 18% !important;">Платено при записване: </label>
                    <div class="col-sm-3">

                        <input type="text" id="paid" class="form-control  col-sm-3" name="paid" value=""
                               placeholder="Платено при записване">
                    </div>

                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input id="approved" type="checkbox" value="1" name="approved"> Сканирана форма на
                                съгласие на родителя
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="note" class="col-sm-2 control-label">Забележка</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="note" rows="6" name="note" value=""
                                      placeholder="Забележка" spellcheck="false"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-4">Добавяне</button>

            </form>

        </div>
    </div>
</template>

<script>

import SimpleTypeahead from 'vue3-simple-typeahead';
import 'vue3-simple-typeahead/dist/vue3-simple-typeahead.css'

export default {
    name: 'my-vue-component',
    components: {
        SimpleTypeahead,
    },
    data() {
        return {
            services: [],
            kids: [],
            selected_kid: '',
            service: '',
            firstname: '',
            surname: '',
            lastname: '',
            birth_date: '',
            parent_name: '',
            parent_phone_number: '',
            parent_email: '',
            show: false,
            strSuccess: '',
            strError: '',
        }
    },
    created() {
        const servicesRequest = this.$axios.get('/api/services');
        const kidsRequest = this.$axios.get('/api/kids_autocomplete');
        this.$axios.all([servicesRequest, kidsRequest]).then(this.$axios.spread((...responses) => {
            this.services = responses[0].data;
            this.kids = responses[1].data;

        })).catch(errors => {
            // react on errors.
        });
    },
    methods: {
        addLocation(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;

                const formData = new FormData();
                formData.append('service_id', this.service);
                formData.append('pick_up_place', this.pick_up_place);
                formData.append('drop_down_place', this.drop_down_place);
                formData.append('pick_up_time', this.pick_up_time);
                formData.append('drop_down_time', this.drop_down_time);
                this.$axios.post('/api/locations', formData)
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
        selectItemEventHandler(item) {
            this.selected_kid = item;
        },
        showForm() {
            if (this.selected_kid !== '') {
                let kidId = this.selected_kid.charAt(0);

                this.$axios.get(`/api/kids/${kidId}`)
                    .then(response => {
                        this.firstname = response.data['firstname'];
                        this.surname = response.data['surname'];
                        this.lastname = response.data['lastname'];
                        this.birth_date = response.data['birth_date'];
                        this.parent_name = response.data['parent_name'];
                        this.parent_phone_number = response.data['parent_phone_number'];
                        this.parent_email = response.data['parent_email'];
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                this.show = true;
            }
        },
    }
}
</script>

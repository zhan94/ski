<style>
#vbs-modal > span > div.modal.bs-dialog-show > div > div > div.modal-body > form > div:nth-child(3) > div > div.dp__menu.dp__relative.dp__theme_light > div > div > div:nth-child(2) > div{
    display: none;
}
</style>
<template>

    <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ strSuccess }}</strong>
    </div>

    <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ strError }}</strong>
    </div>
    <div class="modal-header">
        <h3 class="modal-title">Добавяне на дете към базата с данни</h3>
        <button
            type="button"
            class="btn-close"
            aria-label="Close"
            @click="close"
        ></button>
    </div>
    <div class="modal-body">
        <form>
            <div class="mb-3">
                <label for="firstName" class="form-label">Име</label>
                <input type="text" class="form-control" v-model="firstname">
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Презиме</label>
                <input type="text" class="form-control" v-model="surname">
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Фамилия</label>
                <input type="text" class="form-control" id="lastName" v-model="lastname">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Дата на раждане</label>
                <Datepicker v-model="birth_date" inline autoApply/>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Име на родител</label>
                <input type="text" class="form-control" v-model="parent_name">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Телефон на родител</label>
                <input type="text" class="form-control" v-model="parent_phone_number">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Е-mail адрес</label>
                <input type="text" class="form-control" v-model="parent_email">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="close">
            Отмяна
        </button>

        <button type="button" class="btn btn-success" @click="create">
            Добавяне
        </button>
    </div>
</template>

<script>
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
export default {
    data() {
        return {
            firstname: '',
            surname: '',
            lastname: '',
            birth_date: '',
            parent_name: '',
            parent_email: '',
            parent_phone_number: '',
            strSuccess: '',
            strError: '',
        }
    },
    components: {
        Datepicker
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
        close() {
            this.$vbsModal.close();
        },
        add: function () {
            this.firstname.push({value: ''});
            this.surname.push({value: ''});
            this.lastname.push({value: ''});
            this.birth_date.push({value: ''});
            this.parent_name.push({value: ''});
            this.parent_email.push({value: ''});
            this.parent_phone_number.push({value: ''});
        },
        create() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();
                formData.append('firstname', this.firstname);
                formData.append('surname', this.surname);
                formData.append('lastname', this.lastname);
                formData.append('birth_date',  JSON.stringify(this.birth_date));
                formData.append('parent_name', this.parent_name);
                formData.append('parent_email', this.parent_email);
                formData.append('parent_phone_number', this.parent_phone_number);
                this.$axios.post('/api/kids', formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                        setTimeout(function () { this.close() }.bind(this), 1500);
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

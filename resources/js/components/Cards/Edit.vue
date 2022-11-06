<template>
    <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ strSuccess }}</strong>
    </div>
    <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ strError }}</strong>
    </div>
    <div class="modal-header">
        <h3 class="modal-title">Редакция на карта за услуга {{ service_name }}</h3>
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
                <label class="form-label">Наименование на карта</label>
                <input v-model="name" type="text" class="form-control" id="name">
            </div>

            <div class="mb-3">
                <label class="form-label">Текущи цени</label>
                <div v-for="price in prices" :key="price.id">
                    Цена за {{ price.days }}
                    <span v-if="price.days === '1'">ден:</span>
                    <span v-else>дни:</span>
                    {{ price.price }}лв.
                </div>
            </div>

            <div class="mb-3">
                <a @click="addPrice" type="button" class="btn btn-primary">Добавяне на цени <span
                    class="bi-plus-circle"></span></a>
            </div>
            <div v-for="(item, k) in items">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Дни:" v-model="item.days">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Цена:" v-model="item.prices">
                </div>
                <div class="mb-3">
                    <a @click="remove(k, item)" class="btn btn-danger remove"><span class="bi-calendar-minus"></span>
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="close">
            Отмяна
        </button>
        <button type="button" class="btn btn-danger" @click="deleteCard(this.$route.params.id)">
            Изтриване
        </button>
        <button type="button" class="btn btn-success" @click="update">
            Актуализация
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: '',
            service_id: '',
            service_name: '',
            services: [],
            service: '',
            name: '',
            items: [{
                days: '',
                prices: ''
            }],
            strSuccess: '',
            strError: '',
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/cards/${this.$route.params.id}`)
                .then(response => {
                    this.name = response.data['name'];
                    this.service_id = response.data['service']['id'];
                    this.service_name = response.data['service']['name'];
                    this.prices = response.data['prices'];
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
        addPrice: function () {
            this.items.push({
                days: '',
                prices: ''
            });
        },
        update(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();
                formData.append('service_id', this.service);
                formData.append('name', this.name);
                formData.append('items', JSON.stringify(this.items));
                this.$axios.post('/api/cards', formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                        setTimeout(function () {
                            this.close()
                        }.bind(this), 1500)
                    })
                    .catch(function (error) {
                        existingObj.strSuccess = "";
                        existingObj.strError = error.response.data.message;
                    });
            });
        },
        deleteCard(id) {
            this.$vbsModal
                .confirm({
                    message: "Потвърждение за изтриване?",
                    title: "Изтриване на местоположение",
                    leftBtnText: "Отмяна",
                    rightBtnText: "Изтриване",
                    staticBackdrop: this.staticBackdrop,
                    center: this.center,
                })
                .then((confirmed) => {
                    if (confirmed) {
                        this.$axios.get('/sanctum/csrf-cookie').then(response => {
                            let existingObj = this;
                            this.$axios.delete(`/api/cards/${id}`)
                                .then(response => {
                                    let i = this.cards.map(item => item.id).indexOf(id); // find index of your object
                                    this.cards.splice(i, 1);
                                    existingObj.strError = "";
                                    existingObj.strSuccess = response.data.success;
                                    setTimeout(function () {
                                        this.close()
                                    }.bind(this), 1500)
                                })
                                .catch(function (error) {
                                    existingObj.strError = "";
                                    existingObj.strSuccess = error.response.data.message;
                                });
                        })
                    }
                });
        }
    },
}
</script>

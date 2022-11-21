<template>
    <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ strSuccess }}</strong>
    </div>

    <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ strError }}</strong>
    </div>
    <div class="modal-header">
        <h3 class="modal-title">Редакция на занятие</h3>
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
                <label class="form-label">Услуга</label>
                <input type="text" class="form-control" v-model="name">
            </div>
            <div class="mb-3">
                <label class="form-label">Местоположение взимане</label>
                <input type="text" class="form-control" v-model="pick_up_place">
            </div>

            <div class="mb-3">
                <label class="form-label">Местоположение оставяне</label>
                <input type="text" class="form-control" v-model="drop_down_place">
            </div>

            <div class="mb-3">
                <label class="form-label">Час на взимане</label>
                <input type="text" class="form-control" v-model="from_date">
            </div>

            <div class="mb-3">
                <label class="form-label">Час на оставяне</label>
                <input type="text" class="form-control" v-model="to_date">
            </div>

            <div class="mb-3">
                <a @click="addPrice" type="button" class="btn btn-primary">Добавяне на цени <span class="bi-plus-circle"></span></a>
            </div>
            <div v-for="(item, k) in items">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Дни:" v-model="item.day">
                </div>
                <div  class="mb-3">
                    <input type="text" class="form-control" placeholder="Цена:" v-model="item.price">
                </div>
                <div class="mb-3">
                    <a @click="remove(k, item)" class="btn btn-danger remove"><span class="bi-calendar-minus"></span> </a>
                </div>
            </div>

            <div class="form-group">
                <label for="eMail">Описание</label>
                <textarea class="form-control" id="note" rows="6" v-model="description"
                          placeholder="Забележка" spellcheck="false"></textarea>
            </div>
        </form>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="close">
            Отмяна
        </button>
        <button type="button" class="btn btn-danger" @click="deleteAdd()">
            Изтриване
        </button>
        <button type="button" class="btn btn-success" @click="update()">
            Актуализация
        </button>
    </div>
</template>

<script>
export default{
    data() {
        return {
            services: [],
            service: '',
            name: '',
            pick_up_place: '',
            drop_down_place: '',
            from_date: '',
            to_date: '',
            description: '',
            items: [{
                day: '',
                price: ''
            }],
            strSuccess: '',
            strError: '',
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/additional_services/${this.$route.params.id}`)
                .then(response => {
                    this.name = response.data['name'];
                    this.pick_up_place = response.data['pick_up_place'];
                    this.drop_down_place = response.data['drop_down_place'];
                    this.from_date = response.data['from_date'];
                    this.to_date = response.data['to_date'];
                    this.description = response.data['description'];
                    this.items = response.data['prices'];
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
                day: '',
                price: ''
            });
        },
        update(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('pick_up_place', this.pick_up_place);
                formData.append('drop_down_place', this.drop_down_place);
                formData.append('from_date', this.from_date);
                formData.append('to_date', this.to_date);
                formData.append('description', this.description);
                formData.append('items',JSON.stringify(this.items));
                console.log(response);
                this.$axios.put(`/api/additional_services/${this.$route.params.id}`, formData)
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
        deleteAdd() {
            this.$vbsModal
                .confirm({
                    message: "Потвърждение за изтриване?",
                    title: "Изтриване на занятие",
                    leftBtnText: "Отмяна",
                    rightBtnText: "Изтриване",
                    staticBackdrop: this.staticBackdrop,
                    center: this.center,
                })
                .then((confirmed) => {
                    if (confirmed) {
                        this.$axios.get('/sanctum/csrf-cookie').then(response => {
                            let existingObj = this;
                            this.$axios.delete(`/api/additional_services/${this.$route.params.id}`)
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

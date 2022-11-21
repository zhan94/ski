<template>
    <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ strSuccess }}</strong>
    </div>

    <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ strError }}</strong>
    </div>
    <div class="modal-header">
        <h3 class="modal-title">Добавяне на занятие</h3>
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
                    <input type="text" class="form-control" placeholder="Дни:" v-model="item.days">
                </div>
                <div  class="mb-3">
                    <input type="text" class="form-control" placeholder="Цена:" v-model="item.prices">
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

        <button type="button" class="btn btn-success" @click="create">
            Добавяне
        </button>
    </div>
</template>

<script>
export default{
    data() {
        return {
            services: [],
            service: '',
            pick_up_place: '',
            drop_down_place: '',
            from_date: '',
            to_date: '',
            description: '',
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
        addPrice: function () {
            this.items.push({
                days: '',
                prices: ''
            });
        },
        create() {
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
                this.$axios.post('/api/additional_services', formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                        setTimeout(function () { this.close() }.bind(this), 1500);
                    })
                    .catch(function(error) {
                        existingObj.strSuccess ="";
                        existingObj.strError = error.response.data.message;
                    });
            });
        }

    },
}

</script>

<style>
html, body {
    height: 100%;
}

.form-login {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
}
</style>
<template>

    <div v-if="error !== null" class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ error }}</strong>
    </div>

    <form class="form-login">
        <h1 class="h3 mb-3 font-weight-normal">Вход</h1>
        <label for="inputEmail" class="sr-only">Потребителско име</label>
        <input
            type="email"
            v-model="email"
            id="inputEmail"
            class="form-control mb-2"
            placeholder="Потребителско име"
            required
            autofocus
        >
        <label for="inputPassword" class="sr-only">Парола</label>
        <input
            type="password"
            v-model="password"
            id="inputPassword"
            class="form-control mb-2"
            placeholder="Парола"
            required
        >

        <button class="btn btn-lg btn-primary btn-block" @click="handleSubmit" type="submit">
            Вход
        </button>
    </form>

</template>

<script>

export default {
    data() {
        return {
            email: "",
            password: "",
            error: null
        }
    },

    methods: {
        handleSubmit(e) {
            e.preventDefault()
            if (this.password.length > 0) {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post('api/login', {
                        email: this.email,
                        password: this.password
                    })
                        .then(response => {
                            if (response.data.success) {
                                this.$router.go('/locations')
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                })
            }
        }
    },

    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedin) {
            return next('/');
        }
        next();
    }
}
</script>

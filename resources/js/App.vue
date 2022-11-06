<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Tenth navbar example">
        <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                    <li class="nav-item" v-for="item in navbars" v-bind:key="item.id">
                        <router-link class="nav-item nav-link" :to="{path:item.route}">{{ item.name }}</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <router-view></router-view>
</template>
<script>

export default {

    name: "App",
    data() {
        return {
            navbars: [],
            strSuccess: '',
            strError: '',
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/navbars')
                .then(response => {
                    this.navbars = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },

    methods: {
        logout(e) {
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/login"
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}

</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Tenth navbar example">
        <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                    <li class="nav-item" v-for="item in navbars" v-bind:key="item.id">
                        <router-link class="nav-item nav-link" :to="{path:item.route}">{{ item.name }}</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Изход</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <router-view></router-view>
</template>
<script>
import { mapActions } from 'vuex'
export default {

    name: "App",
    data() {
        return {
            navbars: [],
            strSuccess: '',
            strError: '',
            user:this.$store.state.auth.user
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
    },
    methods: {
        ...mapActions({
            signOut:"auth/logout"
        }),
        async logout(){
            await this.$axios.post('api/logout').then(({data})=>{
                this.signOut()
                this.$router.push({name:"login"})
            })
        }
    },
}

</script>

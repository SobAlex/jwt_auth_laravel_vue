<template>
    <div>
        <router-link class="p-2" v-if="token" :to="{ name: 'fruit.index' }">list</router-link>
        <router-link class="p-2" v-if="token" :to="{ name: 'user.personal'}">Personal</router-link>
        <router-link class="p-2" v-if="!token" :to="{ name: 'user.login' }">Login</router-link>
        <router-link class="p-2" v-if="!token" :to="{ name: 'user.registration' }">Registration</router-link>
        <a class="p-2" v-if="token" @click.prevent="logout" href="#">Logout</a>
        <router-view></router-view>
    </div>
</template>

<script>

import api from "../api";

export default {

    name: "Index",

    data() {
        return {
            token: null
        }
    },

    mounted() {
        this.getToken()
    },

    watch: {
        $route(to, from) {
            this.getToken()
        }
    },

    // updated() {
    //     this.getToken()
    // },

    methods: {
        getToken() {
            this.token = localStorage.getItem('access_token')
        },

        logout() {
            api.post('/api/auth/logout')
                .then(res => {
                    localStorage.removeItem('access_token')
                    this.$router.push({name: 'user.login'})
                })
        }
    }
}
</script>

<style scoped></style>

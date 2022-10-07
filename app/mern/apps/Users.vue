<template>
    <router-view name="Users" v-bind:users="users"></router-view>
    <router-view></router-view>
</template>
<script>
import Grid from '../components/users/Grid';
import api from '../api';
import Edit from '../components/users/Edit';
export default {
    components: {
        Grid, Edit
    },
    data() {
        return {
            users: []
        }
    },
    methods: {
        async getUsers() {
            this.users = [];
            this.users = await api.helpGet('users');
        }
    },
    mounted() {
        this.getUsers();
    }
}
</script>
<style>
.fa-refresh {
    cursor: pointer;
    color: #0069aa;
    font-size: 1.5rem;
}
</style>
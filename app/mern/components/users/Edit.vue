<template>
    <div class="edit-user-form">
        <Loader v-bind:spin="spin" />
        <form v-if="user.id != undefined">
            <select class="form-select" v-model="user.status">
                <option selected>Select Status:</option>
                <option value="10">Active</option>
                <option value="9">Disabled</option>
                <option value="0">Deleted</option>
            </select>
            <div class="form-group">
                <input type="email" class="form-control" id="user-email" placeholder="name@example.com"
                    v-model="user.email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="user-username" placeholder="Taher Samman"
                    v-model="user.username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="user-password" placeholder="New Password"
                    v-model="password" :disabled="!newPassword">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="newpassword" @change="checkNewpassword"
                        v-model="newPassword">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" @click="updateUser($event)">Submit</button>
        </form>
    </div>
</template>
<script>
import api from '../../api';
import Loader from '../tools/Loader.vue';
export default {
    data() {
        return {
            user: {
                id: undefined,
                username: '',
                email: '',
                password: '',
                status: '',
                status_label: ''
            },
            password: '',
            newPassword: false,
            spin: true,
        }
    },
    components: { Loader },
    methods: {
        async getUser() {
            this.spin = false;
            this.user = await api.helpGet(`users/${this.$route.params.id}`);
            if (this.user.id != undefined && this.user.id > 0) {
                this.spin = false;
            } else {
                this.spin = true;
            }
        },
        async updateUser(e) {
            e.preventDefault()
            await api.helpPatch(`users/${this.user.id}`, this.user).then(res => console.log(res));
        },
        checkNewpassword() {
            this.password = !this.newPassword ? '' : this.password;
        }
    },
    mounted() {
        this.getUser();
    },
}
</script>
<style>
.edit-user-form {
    position: relative;
}
</style>
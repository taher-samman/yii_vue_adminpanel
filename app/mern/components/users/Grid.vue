<template>
    <teleport to="#refresh-div">
        <i class="fa fa-refresh" :class="{ 'fa-spin': spin }" @click="runRefresh" aria-hidden="true"></i>
    </teleport>
    <div class="users-table">
        <Loader v-bind:spin="spin" />
        <table v-if="users.length > 0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <th scope="row">{{user.id}}</th>
                    <td>{{user.username}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.status_label}}</td>
                    <td>{{user.created_at}}</td>
                    <td>{{user.updated_at}}</td>
                    <td>
                        <router-link :to="this.$route.fullPath+'/'+user.id" class="btn edit btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </router-link>
                        <!--   <router-link to="/" class="btn delete btn-danger">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </router-link> -->
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import Loader from '../tools/Loader.vue';
export default {
    props: ['users'],
    data() {
        return {
            spin: true,
        };
    },
    components: { Loader },
    methods: {
        runRefresh() {
            this.$root.getUsers();
        }
    },
    updated() {
        if (this.users.length > 0) {
            this.spin = false;
        } else {
            this.spin = true;
        }
    }
}
</script>
<style>
.users-table {
    position: relative;
}

table,
.users-table {
    width: 100%;
}

th,
td {
    padding: .5rem;
    border: 1px solid #0069aa;
}

.delete {
    margin-left: 1rem;
}
</style>
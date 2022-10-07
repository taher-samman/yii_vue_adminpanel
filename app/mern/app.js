import {
    createApp
} from 'vue';
import {
    createRouter,
    createWebHistory
} from 'vue-router';
import Users from './apps/Users';
import Grid from './components/users/Grid';
import Edit from './components/users/Edit';
var usersUrl = '/adminpanel/admin/site/users';

const router = createRouter({
    history: createWebHistory(),
    routes: [{
            name: 'Users',
            path: usersUrl,
            components: {
                Users: Grid
            }
        },
        {
            name: 'EditUsers',
            path: usersUrl + '/:id',
            component: Edit,
        },
    ],
});

createApp(Users).use(router).mount('#users-grid');
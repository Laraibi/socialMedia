import {createWebHistory, createRouter} from "vue-router";
import listBooks from '../components/Book/listBooks.vue';
import listPersonnes from '../components/Personne/listPersonnes.vue';
import home from '../components/auth/home.vue';
import login from '../components/auth/login.vue';
import register from '../components/auth/register.vue';
export const routes = [
    {
        name: 'Books',
        path: '/Books',
        component: listBooks
    },
    {
        name: 'Personnes',
        path: '/Personnes',
        component: listPersonnes
    },
    {
        name: 'home',
        path: '/home',
        component: home
    },
    {
        name: 'login',
        path: '/login',
        component: login
    },
    {
        name: 'register',
        path: '/register',
        component: register
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
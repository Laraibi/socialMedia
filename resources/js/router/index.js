import {createWebHistory, createRouter} from "vue-router";
import listBooks from '../components/Book/listBooks.vue';
import listPersonnes from '../components/Personne/listPersonnes.vue';
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
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
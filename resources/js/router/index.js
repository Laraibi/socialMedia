import { createWebHistory, createRouter } from "vue-router";
import listBooks from "../components/Book/listBooks.vue";
import listPersonnes from "../components/Personne/listPersonnes.vue";
import discussion from "../components/Messages/discussion.vue";
import noDiscussion  from "../components/Messages/noDiscussion.vue";
import Messagerie from "../components/Messages/Messagerie.vue";
import home from "../components/auth/home.vue";
import login from "../components/auth/login.vue";
import register from "../components/auth/register.vue";
const routes = [
    {
        name: "Books",
        path: "/Books",
        component: listBooks,
    },
    {
        name: "Personnes",
        path: "/Personnes",
        component: listPersonnes,
    },
    {
        name: "Messagerie",
        path: "/Messagerie",
        component: Messagerie,
        children: [
            {
                path:'',
                component:noDiscussion
            },
            {
                name: "discussion",
                path: ":id",
                component: discussion,
                props: true,
            }
        ],
    },
    {
        name: "home",
        path: "/home",
        component: home,
    },
    {
        name: "login",
        path: "/",
        component: login,
    },
    {
        name: "register",
        path: "/register",
        component: register,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;

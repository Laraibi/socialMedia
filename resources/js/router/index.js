import { createWebHistory, createRouter } from "vue-router";
import discussion from "../components/Messages/discussion.vue";
import noDiscussion from "../components/Messages/noDiscussion.vue";
import Messagerie from "../components/Messages/Messagerie.vue";
import home from "../components/auth/home.vue";
import login from "../components/auth/login.vue";
import register from "../components/auth/register.vue";
import profile from "../components/auth/profile.vue";
import Mur from "../components/Posts/Mur.vue";
const routes = [
    {
        name: "Messagerie",
        path: "/Messagerie",
        component: Messagerie,
        children: [
            {
                path: "",
                component: noDiscussion,
            },
            {
                name: "discussion",
                path: ":id",
                component: discussion,
                props: true,
            },
        ],
        beforeEnter(to, from, next) {
            if (!window.Laravel.isLoggedin) {
                window.location.href = "/";
            }
            next();
        },
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
        name: "profile",
        path: "/profile",
        component: profile,
        beforeEnter(to, from, next) {
            if (!window.Laravel.isLoggedin) {
                window.location.href = "/";
            }
            next();
        },
    },
    {
        name: "Mur",
        path: "/Mur",
        component: Mur,
        beforeEnter(to, from, next) {
            console.log(window.Laravel.isLoggedin);
            if (!window.Laravel.isLoggedin) {
                window.location.href = "/";
            }
            next();
        },
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

import Vue from "vue";
import VueRouter from "vue-router";

import Home from "./pages/Home.vue";
import Stores from "./pages/Stores.vue";
import Item from "./pages/Item.vue";
import Login from "./pages/Login.vue";
import Register from "./pages/Register.vue";
import AddItem from "./pages/AddItem";
import MyItems from "./pages/MyItems";
import EditItem from "./pages/EditItem";
import StoreItems from "./pages/StoreItems";
import AddStore from "./pages/AddStore";
import EditStore from "./pages/EditStore";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/stores",
            name: "stores",
            component: Stores,
        },
        {
            path: "/item",
            name: "item",
            component: MyItems,
        },
        {
            path: "/login",
            name: "login",
            component: Login,
        },
        {
            path: "/register",
            name: "register",
            component: Register,
        },
        {
            path: "/addItem",
            name: "addItem",
            component: AddItem,
        },
        {
            path: "/addStore",
            name: "addStore",
            component: AddStore,
        },
        {
            path: "/editItem/:id",
            name: "editItem",
            component: EditItem,
        },
        {
            path: "/editStore/:id",
            name: "editStore",
            component: EditStore,
        },
        {
            path: "/stores/:store_id",
            name: "storeItems",
            component: StoreItems,
        },
    ],
});

export default router;

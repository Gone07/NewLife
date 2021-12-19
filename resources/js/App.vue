<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link class="navbar-brand" to="/">NewLife</router-link>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav me-auto">
                        <router-link class="nav-link" aria-current="page" to="/"
                            >Home</router-link
                        >
                        <router-link class="nav-link" to="/Stores"
                            >Stores</router-link
                        >
                        <router-link
                            class="nav-link"
                            to="/Item"
                            v-if="$store.state.auth.isLoggedIn"
                            >Items</router-link
                        >
                        <router-link
                            class="nav-link"
                            to="/Comment"
                            v-if="$store.state.auth.isLoggedIn"
                            >Comments</router-link
                        >
                    </div>
                    <div class="navbar-nav">
                        <router-link
                            v-if="!$store.state.auth.isLoggedIn"
                            class="nav-link"
                            to="/Login"
                            >Login</router-link
                        >
                        <router-link
                            v-if="!$store.state.auth.isLoggedIn"
                            class="nav-link"
                            to="/Register"
                            >Register</router-link
                        >
                        <a
                            v-else
                            class="nav-link"
                            href="#"
                            @click="$store.dispatch('auth/logOut')"
                            >Logout</a
                        >
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <transition name="slide-fade"
                ><router-view></router-view
            ></transition>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.$store.dispatch("auth/initialize");
    },
};
</script>

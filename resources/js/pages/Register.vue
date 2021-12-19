<template>
    <div>
        <div class="mb-3">
            <label for="inputeName" class="form-label">Name</label>
            <input
                type="text"
                class="form-control"
                id="inputeName"
                v-model="name"
            />
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"
                >Email address</label
            >
            <input
                type="email"
                class="form-control"
                id="exampleInputEmail1"
                v-model="email"
            />
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"
                >Password</label
            >
            <input
                type="password"
                class="form-control"
                id="exampleInputPassword1"
                v-model="password1"
            />
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label"
                >Password</label
            >
            <input
                type="password"
                class="form-control"
                id="exampleInputPassword2"
                v-model="password2"
            />
        </div>
        <button @click="register" type="submit" class="btn btn-primary">
            Register
        </button>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            name: "",
            email: "",
            password1: "",
            password2: "",
        };
    },
    methods: {
        register() {
            if (this.password1 !== this.password2) {
                this.password1 = "";
                this.password2 = "";
                return;
            }
            axios.post("/api/register", {
                name: this.name,
                email: this.email,
                password: this.password1,
            });
        },
    },
};
</script>

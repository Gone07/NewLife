<template>
    <div>
        <div v-if="ok" class="alert alert-success">
            {{ ok }}
        </div>
        <div v-if="error" class="alert alert-danger">
            {{ error }}
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
                v-model="password"
            />
        </div>
        <button @click="login" type="submit" class="btn btn-primary">
            Login
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            ok: null,
            error: null,
            email: "",
            password: "",
        };
    },
    methods: {
        async login() {
            this.ok = null;
            this.error = null;
            try {
                await this.$store.dispatch("auth/login", {
                    email: this.email,
                    password: this.password,
                });
                this.ok = "Successful login!";
                this.$router.push("/");
            } catch (error) {
                this.error = "Wrong email password or user does not exist";
            }
        },
    },
};
</script>

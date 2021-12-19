<template>
    <div>
        <div v-if="ok" class="alert alert-success">
            {{ ok }}
        </div>
        <div v-if="error" class="alert alert-danger">
            {{ error }}
        </div>
        <div class="mb-3">
            <label for="NameInput" class="form-label">Name</label>
            <input
                type="text"
                class="form-control"
                id="NameInput"
                v-model="name"
            />
        </div>
        <div class="mb-3">
            <label for="AddressInput" class="form-label">Address</label>
            <input
                type="text"
                class="form-control"
                id="AddressInput"
                v-model="address"
            />
        </div>
        <div class="mb-3">
            <label for="CityInput" class="form-label">City</label>
            <input
                type="text"
                class="form-control"
                id="CityInput"
                v-model="city"
            />
        </div>
        <div class="mb-3">
            <label for="NumberInput" class="form-label"
                >Max number of items</label
            >
            <input
                type="number"
                class="form-control"
                id="NumberInput"
                v-model="noi"
            />
        </div>
        <button @click="create" type="submit" class="btn btn-primary">
            Submit
        </button>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            ok: null,
            error: null,
            name: "",
            address: "",
            city: "",
            noi: 0,
        };
    },
    async created() {
        const response2 = await axios.get(
            `/api/stores/${this.$route.params.id}`,
            {
                headers: {
                    Authorization: `Bearer ${this.$store.state.auth.accessToken}`,
                },
            }
        );
        this.name = response2.data.data.name;
        this.address = response2.data.data.address;
        this.city = response2.data.data.city;
        this.noi = response2.data.data.numberOfItems;
    },
    methods: {
        async create() {
            this.ok = null;
            this.error = null;
            try {
                await axios.put(
                    `/api/stores/${this.$route.params.id}`,
                    {
                        name: this.name,
                        address: this.address,
                        city: this.city,
                        numberOfItems: this.noi,
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${this.$store.state.auth.accessToken}`,
                        },
                    }
                );
                this.$router.push("/stores");
            } catch (error) {
                this.error = "" + error;
            }
        },
    },
};
</script>

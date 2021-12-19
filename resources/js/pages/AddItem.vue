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
            <label for="WeightInput" class="form-label">Weight</label>
            <input
                type="number"
                class="form-control"
                id="WeightInput"
                v-model="weight"
            />
        </div>
        <div class="mb-3">
            <label for="ConditionInpute" class="form-label">Condition</label>
            <select class="form-select" v-model="condition">
                <option selected>Chose condition</option>
                <option value="New">New</option>
                <option value="Very good">Very good</option>
                <option value="Good">Good</option>
                <option value="Used">Used</option>
                <option value="Broken">Broken</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="StoreInpute" class="form-label">Store</label>
            <select class="form-select" v-model="store_id">
                <option selected>Chose store to post your item</option>
                <option v-for="s in stores" :key="s.id" :value="s.id">
                    {{ s.name }}
                </option>
            </select>
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
            weight: 0,
            condition: "",
            store_id: null,
            stores: null,
        };
    },
    async created() {
        const response = await axios.get("/api/allStores");
        this.stores = response.data.data;
    },
    methods: {
        async create() {
            this.ok = null;
            this.error = null;
            try {
                await axios.post(
                    "/api/item",
                    {
                        name: this.name,
                        condition: this.condition,
                        weight: this.weight,
                        store_id: this.store_id,
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${this.$store.state.auth.accessToken}`,
                        },
                    }
                );
                this.$router.push("/item");
            } catch (error) {
                this.error = "" + error;
            }
        },
    },
};
</script>

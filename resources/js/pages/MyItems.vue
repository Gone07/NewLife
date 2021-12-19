<template>
    <div>
        <router-link to="/addItem" class="btn btn-primary my-2">
            Create new item
        </router-link>
        <div class="row">
            <div class="col-md-6 px-2" v-for="item in items" :key="item.id">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img
                                src="https://via.placeholder.com/150"
                                class="img-fluid rounded-start"
                            />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ item.name }}
                                </h5>
                                <p class="card-text">
                                    Condition: {{ item.condition }} <br />
                                    Weight:
                                    {{ item.weight }} <br />
                                    Store:
                                    {{ item.store_id }}
                                </p>
                                <router-link
                                    class="btn btn-primary btn-sm"
                                    :to="{
                                        name: 'editItem',
                                        params: { id: item.id },
                                    }"
                                    >Edit</router-link
                                >
                                <a
                                    class="btn btn-danger btn-sm"
                                    href="#"
                                    @click="deleteItem(item.id)"
                                    ><i class="bi bi-trash"></i>Delete</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            items: null,
        };
    },
    async created() {
        await this.fetchContent();
    },
    methods: {
        async fetchContent() {
            const response = await axios.get("/api/myItems", {
                headers: {
                    Authorization: `Bearer ${this.$store.state.auth.accessToken}`,
                },
            });
            this.items = response.data.data;
        },
        async deleteItem(id) {
            await axios.delete(`/api/items/${id}`, {
                headers: {
                    Authorization: `Bearer ${this.$store.state.auth.accessToken}`,
                },
            });
            await this.fetchContent();
        },
    },
};
</script>

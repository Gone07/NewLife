<template>
    <div>
        <router-link
            to="/addStore"
            class="btn btn-primary my-2"
            v-if="$store.state.auth.isAdmin"
        >
            Create new store
        </router-link>
        <div class="row my-2">
            <div class="col-md-6 px-2" v-for="store in stores" :key="store.id">
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
                                    {{ store.name }}
                                </h5>
                                <p class="card-text">
                                    City: {{ store.city }} <br />
                                    Address:
                                    {{ store.address }} <br />
                                    Max number of items:
                                    {{ store.numberOfItems }}
                                </p>
                                <router-link
                                    class="btn btn-primary btn-sm"
                                    :to="{
                                        name: 'storeItems',
                                        params: { store_id: store.id },
                                    }"
                                    >Store items</router-link
                                >
                                <router-link
                                    class="btn btn-primary btn-sm"
                                    v-if="$store.state.auth.isAdmin"
                                    :to="{
                                        name: 'editStore',
                                        params: { id: store.id },
                                    }"
                                    ><i class="bi bi-pencil-square"></i
                                    >Edit</router-link
                                >
                                <a
                                    class="btn btn-danger btn-sm"
                                    v-if="$store.state.auth.isAdmin"
                                    href="#"
                                    @click="deleteItem(store.id)"
                                    ><i class="bi bi-trash"></i>Delete</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li
                    v-for="(l, k) in pageLinks"
                    :key="k"
                    class="page-item"
                    :class="{ active: l.active }"
                >
                    <a class="page-link" href="#" @click="loaddata(l.url)">{{
                        l.label
                    }}</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            lastUrl: null,
            meta: null,
            stores: null,
        };
    },
    async created() {
        await this.loaddata("/api/stores");
    },
    methods: {
        async loaddata(url) {
            this.lastUrl = url;
            const response = await axios.get(url);
            if (response.data) {
                this.meta = response.data.meta;
                this.stores = response.data.data;
            }
        },
        async deleteItem(id) {
            await axios.delete(`/api/stores/${id}`, {
                headers: {
                    Authorization: `Bearer ${this.$store.state.auth.accessToken}`,
                },
            });
            await this.loaddata(this.lastUrl);
        },
    },
    computed: {
        pageLinks() {
            return this.meta.links.slice(1, this.meta.links.length - 1);
        },
    },
};
</script>

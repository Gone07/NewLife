<template>
    <div>
        <h1>Items</h1>
        <router-link to="/addItem" class="btn btn-primary mb-2">
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
            meta: null,
            items: null,
        };
    },
    async created() {
        await this.loaddata("/api/items");
    },
    methods: {
        async loaddata(url) {
            const response = await axios.get(url);
            if (response.data) {
                this.meta = response.data.meta;
                this.items = response.data.data;
            }
        },
    },
    computed: {
        pageLinks() {
            return this.meta.links.slice(1, this.meta.links.length - 1);
        },
    },
};
</script>

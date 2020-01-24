<template>
    <v-toolbar
            color="primary"
    >
        <v-toolbar-title>Добавить продукт</v-toolbar-title>
        <v-autocomplete
                :items="items"
                :loading="loading"
                :search-input.sync="search"
                auto-select-first

                class="mx-4 color--white"
                flat
                hide-details
                item-disabled
                label="Поиск по товарам"
                no-filter
                return-object
                solo
                v-model="select"
        >

            <template v-slot:item="{ item }">

                <v-list-item-avatar
                        class="headline font-weight-light white--text"
                        color="indigo"
                >
                    {{ item.name.charAt(0) }}
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title v-text="item.name"></v-list-item-title>
                    <v-list-item-subtitle v-text="item.article"></v-list-item-subtitle>
                </v-list-item-content>
                <v-list-item-action>
                    <v-icon>mdi-coin</v-icon>
                </v-list-item-action>
            </template>
        </v-autocomplete>
        <v-btn icon>
            <v-icon>mdi-dots-vertical</v-icon>
        </v-btn>
    </v-toolbar>
</template>

<script>
    export default {
        name: "AddProducts",
        data() {
            return {
                loading: false,
                items: [],
                search: null,
                select: {},
            }
        },
        watch: {
            select(val) {
                if (!val) return;
                this.search = '';
                this.select = '';
                this.items = [];
                this.$emit('add', val);
            },
            search(val) {

                if (val && val.length < 3) return;
                val && val !== this.select && this.querySelections(val)
            },
        },
        methods: {
            querySelections(v) {
                this.loading = true;
                // Simulated ajax query
                window.axios.get('/search?q=' + v).then((data) => {
                        this.items = data.data;
                        this.loading = false;
                    }
                )

            },
        },
    }

</script>

<style scoped>

</style>
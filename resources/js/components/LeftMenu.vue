<template>
    <v-card
            class="mx-auto"
            max-width="500"
    >
        <v-sheet class="pa-4 primary lighten-2">
            <v-text-field
                    clear-icon="mdi-close-circle-outline"
                    clearable
                    dark
                    flat
                    hide-details
                    label="Ищите по названиям категории"
                    solo-inverted
                    v-model="search"
            ></v-text-field>

        </v-sheet>
        <v-card-text>
            <v-treeview
                    :filter="filter"
                    :items="items"
                    :search="search"
                    :open="open"
            >
                <template v-slot:prepend="{ item }">
                    <v-icon
                            v-if="item.children"
                            v-text="`mdi-${item.id === 1 ? 'home-variant' : 'folder-network'}`"
                    ></v-icon>
                </template>
                <template v-slot:label="{ item, open }">
                    <a :href="'/catalog/section/'+item.id">{{item.name}}</a>
                </template>
            </v-treeview>
        </v-card-text>

    </v-card>


</template>

<script>
    export default {
        name: "LeftMenu",
        props: ["section"],
        data: () => ({
            items: [],
            open: [1],
            search: null, zeta
        }),
        created() {
            window.axios.get('/category/getTree').then((result) => {
                console.log(result)
                result.data.forEach((item,index)=> {
                    this.items.splice(index, 1, result.data[index]);
                    this.open = this.section.parens.map(item => item.id)
                    this.open.push(this.section.id)
                  //  this.items = Vue.set(this.items, index, );
                });
            })
        },
        computed: {
            filter() {
                return this.caseSensitive
                    ? (item, search, textKey) => item[textKey].indexOf(search) > -1
                    : undefined
            },
        },

    }
</script>

<style scoped>

</style>
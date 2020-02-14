<template>
    <div>
        <AddProducts @add="addProduct"></AddProducts>
        <v-data-table
                :headers="headers"
                :items="project.products"
                :items-per-page="500"
                class="elevation-1"
                dense
                hide-default-footer

        >
            <template v-slot:item.action="{ item }">
                <v-icon
                        @click="editItem(item)"
                        class="mr-2"
                        small
                >
                    edit
                </v-icon>
                <v-icon
                        @click="deleteItem(item)"
                        small
                >
                    delete
                </v-icon>
            </template>
        </v-data-table>
        <v-dialog @focus="focus()" max-width="500px" v-model="dialog">
            <v-card>
                <v-card-title>
                    <span class="headline">Изменить данные</span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="4" sm="6">
                                <v-text-field label="Артикул" readonly v-model="editedItem.article"></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4" sm="6">
                                <v-text-field label="Наименование" readonly v-model="editedItem.name"></v-text-field>
                            </v-col>

                            <v-col cols="12" md="4" sm="6">
                                <v-text-field @change="save" autofocus id="countInput" label="Количество"
                                              v-model="editedItem.pivot.count"></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="close" color="blue darken-1" text>Отмена</v-btn>
                    <v-btn @click="save" color="blue darken-1" text>Сохранить</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        name: "ProjectProducts",
        props: ['project', {
            type: Boolean,
            default: false
        }],
        data: () => ({
            dialog: false,
            headers: [
                {
                    text: 'Артикул',
                    align: 'left',
                    sortable: false,
                    value: 'article',
                },
                {text: 'Наименование', value: 'name'},
                {text: 'Количество', value: 'pivot.count'},
                {text: 'за включение', value: 'cost_include'},
                {text: 'за реализацию', value: 'cost_realise'},
                {text: 'Действия', value: 'action', sortable: false},
            ],
            editedIndex: -1,
            editedItem: {
                article: '',
                name: '',
                pivot: {
                    count: 0,
                }

            },
        }),

        watch: {
            dialog(val) {
                if (!val) {
                    this.close();
                    return;
                }  // you removed `return` here
                requestAnimationFrame(() => {
                    console.log(this, this.$refs);
                    window.countInput.focus();
                });
            },
        },
        computed: {},
        methods: {

            addProduct(product) {

                if (product.pivot == undefined) {
                    product.pivot = {}
                }
                console.log(product, product.pivot);
                product.pivot.count = 1;
                let id = this.project.products.length;
                id = this.project.products.findIndex(item => item.id == product.id) >= 0 || this.project.products.length;
                console.log(id);
                this.$set(this.project.products, this.project.products.length, Object.assign({}, product));
                this.editedIndex = this.project.products.length - 1;
                this.editedItem = Object.assign({}, product);
                this.dialog = true;
            },
            editItem(item) {
                this.editedIndex = this.project.products.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem(item) {
                const index = this.project.products.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
            },

            close() {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },

            save() {
                if (this.editedIndex > -1) {
                    Object.assign(this.project.products[this.editedIndex], this.editedItem)

                } else {
                    //  this.project.products.push(this.editedItem)
                }
                this.close()
            },

        }
    }
</script>

<style scoped>

</style>
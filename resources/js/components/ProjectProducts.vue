<template>
    <div>
        <AddProducts @add="addProduct"></AddProducts>
        <v-data-table
                :headers="headers"
                :items="products"
                :items-per-page="50"
                class="elevation-1"
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
                                              v-model="editedItem.count"></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="close" color="blue darken-1" text>Cancel</v-btn>
                    <v-btn @click="save" color="blue darken-1" text>Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-btn @click="saveAll">Сохранить</v-btn>
    </div>
</template>

<script>
    export default {
        name: "ProjectProducts",
        props: ['project'],
        data: () => ({
            dialog: false,
            products: [],
            headers: [
                {
                    text: 'Артикул',
                    align: 'left',
                    sortable: false,
                    value: 'article',
                },
                {text: 'Наименование', value: 'name'},
                {text: 'Количество', value: 'count'},
                {text: 'Действия', value: 'action', sortable: false},
            ],
            editedIndex: -1,
            editedItem: {
                article: '',
                name: '',
                count: 0,
            },
        }),

        created() {
            this.products = this.project.products
        },
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
        methods: {

            addProduct(product) {
                product.count = 1;
                this.$set(this.products, this.products.length, Object.assign({}, product));
                this.editedIndex = this.products.length - 1;
                this.editedItem = Object.assign({}, product);
                this.dialog = true;
            },
            editItem(item) {
                this.editedIndex = this.products.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem(item) {
                const index = this.products.indexOf(item)
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
                    Object.assign(this.products[this.editedIndex], this.editedItem)

                } else {
                    //  this.products.push(this.editedItem)
                }
                this.close()
            },
            saveAll() {


                  let products = this.products.reduce((result,product) =>{
                      result[product.id] = {
                          count:product.count
                      };
                      return result;
                  },{});
                  console.log(products,this.project);
                window.axios.post('/projects/' + this.project.id + '/saveProducts', products)
            }
        }
    }
</script>

<style scoped>

</style>
<template>

    <v-card>
        <v-form
                ref="form"
                v-model="valid">
            <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Проект #{{project_id}} {{project.project.name}}</v-toolbar-title>
            </v-toolbar>
            <v-tabs v-model="currentTab" vertical>
                <v-tab>
                    <v-icon left>mdi-book</v-icon>

                        Описание проекта


                </v-tab>

                <v-tab v-show="showCostumer">
                    <v-icon left>mdi-account</v-icon>
                    Заказчик проекта
                </v-tab>
                <v-tab v-if="showProducts">
                    <v-icon left>mdi-lock</v-icon>
                    Товары
                </v-tab>
                <v-tab v-if="showDocuments">
                    <v-icon left>mdi-access-point</v-icon>
                    Документы
                </v-tab>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <project-main :project="project"></project-main>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <project-customer :project="project"></project-customer>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item v-if="showProducts">
                    <v-card flat>
                        <v-card-text>
                            <project-products :project="project"></project-products>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item v-if="showDocuments">
                    <v-card flat>
                        <v-card-text>
                            <project-docs :project="project"></project-docs>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs>
            <v-card-actions>

                <v-spacer></v-spacer>
                <v-btn @click="saveAll" class="mb-4 " v-if="showSave">Сохранить проект</v-btn>
                <v-btn @click="nextTab" class="mb-4 " v-if="showNext">Далее</v-btn>
            </v-card-actions>
        </v-form>
    </v-card>


</template>

<script>
    export default {
        name: "ProjectDetail",
        props: {
            'project_id': {
                required: false
            },
            create: {
                type: Boolean,
                default: false,
                required: false
            }
        },
        data() {
            return {
                currentTab: 0,
                project: {
                    id: '',
                    project: {'date_release': (new Date()).toISOString().substr(0, 10)},
                    customer: {},
                    products: [],
                    files: []
                },
                test: null,
                valid: false,
            }
        },
        watch: {},
        computed: {
            showNext() {
                return this.valid
            },
            showSave() {
                return this.valid && this.project.customer.inn
            },
            showCostumer() {
                return this.project.project.name
            },
            showProducts() {
                return this.valid;
            },
            showDocuments() {
                return this.project_id;
            },
            countErrorMain() {
                return 2;
            }
        },
        methods: {
            nextTab() {
                this.currentTab++;
            },
            saveAll() {
                this.validate();
                if (!this.valid) return;
                if (this.create) {

                    window.axios.post('/projects', this.project).then(response => {
                        console.log(response),
                            window.location = '/projects'
                    })
                } else {
                    window.axios.put('/projects/' + this.project_id, this.project).then(response => {
                        console.log(response)
                        //  window.location.reload()
                    })
                }


            },

            validate() {
                this.$refs.form.validate()
            },
        },
        created() {
            if (!this.create) {
                window.axios.get('/projects/' + this.project_id).then((response) => {
                    this.project.id = this.project_id;
                    this.project.files =  response.data.files;
                    this.$set(this.project.project, 'name', response.data.name);
                    this.$set(this.project.project, 'description', response.data.description);
                    this.$set(this.project.project, 'sumInclude', response.data.sumInclude);
                    this.$set(this.project.project, 'sumRealize', response.data.sumRealize);
                    this.project.customer = Object.assign({}, response.data.customer);
                    this.$set(this.project, 'products', response.data.products);
                });
            } else {

            }


        }
    }

</script>

<style scoped>

</style>
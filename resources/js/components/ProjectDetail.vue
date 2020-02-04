<template>

    <v-card>
        <v-form
                ref="form"
                v-model="valid">
            <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Проект #{{project_id}} {{project.project.name}}</v-toolbar-title>
            </v-toolbar>
            <v-tabs vertical>
                <v-tab>
                    <v-icon left>mdi-book</v-icon>
                    <v-badge
                            color="green"
                            content="6"
                    >

                        Описание проекта
                    </v-badge>

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
                <v-tab-item v-show="showCostumer">
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
                {{project}}
                <v-spacer></v-spacer>
                <v-btn @click="saveAll" class="mb-4 " v-if="valid">Сохранить проект</v-btn>
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
                project: {
                    project: {'date_release': (new Date()).toISOString().substr(0, 10)},
                    customer: {},
                    products: []
                },
                valid: false,
            }
        },
        watch: {},
        computed: {
            showCostumer() {
                return this.project.project.name
            },
            showProducts() {
                return this.valid;
            },
            showDocuments() {
                return this.valid;
            },
            countErrorMain() {
                return 2;
            }
        },
        methods: {
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
                        console.log(response),
                            window.location.reload()
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
                    console.log(response.data.products);

                    this.$set(this.project.project, 'name', response.data.name);
                    this.$set(this.project.project, 'description', response.data.description);
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
<template>

    <v-card>
        <v-toolbar color="primary" dark flat>
            <v-toolbar-title>Проект #{{project_id}} {{project.name}}</v-toolbar-title>
        </v-toolbar>
        <v-tabs vertical>
            <v-tab>
                <v-icon left>mdi-account</v-icon>
                Описание проекта
            </v-tab>
            <v-tab>
                <v-icon left>mdi-lock</v-icon>
                Товары
            </v-tab>
            <v-tab>
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
                        <project-products :project="project"></project-products>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card flat>
                    <v-card-text>
                        <project-docs :project="project"></project-docs>
                    </v-card-text>
                </v-card>
            </v-tab-item>
        </v-tabs>
    </v-card>


</template>

<script>
    export default {
        name: "ProjectDetail",
        props: ['project_id'],
        data() {
            return {
                name: '',
                project: {}
            }
        },
        watch: {},
        methods: {},
        created() {
            window.axios.get('/projects/' + this.project_id).then((response) => {
                this.project = Object.assign({}, response.data);
            });

        }
    }

</script>

<style scoped>

</style>
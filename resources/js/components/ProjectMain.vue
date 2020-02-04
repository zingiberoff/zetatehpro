<template>

    <v-row>
        <v-col cols="12" md="7">
            <v-text-field
                    :rules="[v => (v && v.length >= 3) ||'Имя не должно быть пустым']"
                    label="Имя проекта"
                    v-model="project.project.name"></v-text-field>
            <v-textarea :rules="[v => (v && v.length >= 3) ||'Описание не должно быть пустым']"
                        label="Описание проекта"
                        v-model="project.project.description"></v-textarea>
        </v-col>
        <v-col cols="12" md="5">
            <v-input label="Дата реализации"></v-input>
            <v-date-picker locale="ru-ru" reactive v-model="project.project.date_release"></v-date-picker>
        </v-col>

    </v-row>

</template>

<script>
    export default {
        name: "ProjectMain",
        props: ['project'],
        data() {
            return {}
        },
        created() {

        },
        methods: {
            save() {

            }
        }
    }
</script>

<style scoped>

</style>
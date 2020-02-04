<template>


    <v-row>

        <v-col cols="12">
            <v-text-field
                    :rules="rules"
                    label="ИНН"
                    v-model="project.customer.inn"
            ></v-text-field>
            <v-text-field :rules="rules"
                          label="Наименование"
                          v-model="project.customer.name"></v-text-field>
            <v-text-field :rules="rules"
                          label="ФИО Контактного лица"
                          v-model="project.customer.contact_person"></v-text-field>
            <v-text-field :rules="rules"
                          label="Город"
                          v-model="project.customer.city"></v-text-field>
            <v-textarea label="Подрядчик"
                        placeholder="Если вы знаете компанию которая будет заниматься реализацией проекта, оставьте информацию о ней в этом поле (название, контакты)"
                        v-model="project.project.contractor"></v-textarea>
        </v-col>


    </v-row>

</template>

<script>
    export default {
        name: "ProjectCustomer",
        props: ['project'],
        data() {
            return {
                rules: [
                    v => (v || '').length > 0 || 'Поле обязательно для заполнения'
                ]
            }
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
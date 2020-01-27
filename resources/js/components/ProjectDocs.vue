<template>
    <div class="">
        <v-file-input label="File input" multiple></v-file-input>
        <v-list flat v-if="project.length">
            <v-list-item-group color="indigo" mandatory v-model="model">
                <v-list-item :key="i" v-for="(item, i) in opponents">
                    <v-list-item-title v-text="item"></v-list-item-title>
                    <v-icon @click="remove(item)">mdi-minus-circle-outline</v-icon>
                </v-list-item>
            </v-list-item-group>
        </v-list>
    </div>
</template>

<script>
    export default {
        name: "",
        data: () => ({}),
        props: ['project'],
        created() {

        }

    }
</script>

<style scoped>

</style>
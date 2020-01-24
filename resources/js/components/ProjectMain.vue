<template>
    <v-form>
        {{project}}

        <br>
        {{projectData}}
    </v-form>
</template>

<script>
    export default {
        name: "ProjectMain",
        props: ['project'],
        data() {
            return {
                projectData: {}
            }
        },
        mounted() {
            console.log(this.project);
            this.projectData = Object.assign({}, this.project)
        },
    }
</script>

<style scoped>

</style>
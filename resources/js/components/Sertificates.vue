<template>
    <v-row class="mt-6" dense justify="center">
        <v-col cols="12" key="index" lg="3" md="4" v-for="(item,index) in items">
            <v-card
                    class="item"

            >
                <v-img
                        :src="item.image"
                        @click="toggle(index)"
                        class="white--text align-end"
                        height="200px"
                >
                </v-img>
                <v-card-text @click="toggle(index)">
                    {{item.name}}
                </v-card-text>
                <v-card-actions>
                    <a :href="item.link" target="_blank">скачать pdf</a>
                </v-card-actions>
            </v-card>
            <v-dialog
                    v-model="item.open">
                <v-card
                        class="item"

                >
                    <v-img :src="item.image"
                           @click="toggle(index)"

                           class="white--text align-end"
                    >
                    </v-img>
                    <v-card-text @click="toggle(index)">
                        {{item.name}}
                    </v-card-text>
                    <v-card-actions>
                        <a :href="item.link" target="_blank">скачать pdf</a>
                    </v-card-actions>

                </v-card>
            </v-dialog>
        </v-col>
    </v-row>
</template>

<script>
    export default {
        name: "Sertificates",
        data() {
            return {
                items: [
                    {
                        name: 'Сертификат соответствия Ex оборудования с видом взрывозащиты "d e"',
                        link: '/storage/sert/1.pdf',
                        image: '/storage/sert/1.jpg',
                        open: false,
                    },
                    {
                        name: 'Сертификат соответствия Ex оборудования с видом взрывозащиты "e"',
                        link: '/storage/sert/2.pdf',
                        image: '/storage/sert/2.jpg',
                        open: false,
                    },
                ]
            }
        },
        methods: {
            toggle(index) {

                this.items[index].open = !this.items[index].open;

            }
        }
    }
</script>

<style lang="scss" scoped>
    .items {
        display: flex;

    }
</style>
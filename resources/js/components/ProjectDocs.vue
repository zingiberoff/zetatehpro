<template>
    <div>
        <v-file-input
                :show-size="1000"
                @click:append-outer="upload"
                :append-outer-icon="files.length>0?'mdi-content-save':undefined"
                color="deep-purple accent-4"
                counter
                :rules="rules"
                label="File input"
                multiple
                accept="image/*,application/pdf,application/x-pdf,"
                outlined
                placeholder="Select your files"
                prepend-icon="mdi-paperclip"
                v-model="files"

        >
            <template v-slot:selection="{ index, text }">
                <v-chip
                        color="blue accent-4"
                        dark
                        label
                        small
                        v-if="index < 2"
                >
                    {{ text }}
                </v-chip>

                <span
                        class="overline grey--text text--darken-3 mx-2"
                        v-else-if="index === 2"
                >
        +{{ files.length - 2 }} File(s)
      </span>
            </template>
        </v-file-input>
        <v-list subheader two-line>
            <v-subheader inset>Files</v-subheader>

            <v-list-item
                    :key="item.title"
                    v-for="item in project.files"

            >
                <v-list-item-avatar>
                    <img :alt="item.name" :src="item.src" v-if="item.icon==='image'">
                    <v-icon class="grey lighten-1 white--text"
                            v-else
                            v-text="item.icon"
                    ></v-icon>

                </v-list-item-avatar>


                <v-list-item-content>
                    <v-list-item-title v-text="item.name">123s</v-list-item-title>
                    <div class="">
                        <a :download="item.name" :href="item.src">


                        </a>
                    </div>
                    <v-list-item-subtitle v-text="item.size"></v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-action>
                    <v-flex>
                        <a :download="item.name" :href="item.src">
                            <v-btn
                                    icon
                            >
                                <v-icon color="green lighten-1"> mdi-download</v-icon>
                            </v-btn>
                        </a>
                        <v-btn @click="deleteFile(item.id)"
                               icon
                        >
                            <v-icon color="red lighten-1 ">mdi-file-remove-outline</v-icon>
                        </v-btn>
                    </v-flex>
                </v-list-item-action>
            </v-list-item>


        </v-list>
    </div>
</template>

<script>
    import {humanReadableFileSize} from 'vuetify/lib/util/helpers'

    export default {
        name: "",
        data: () => ({
            files: [],
            rules: [value => {

                let maxsize = 10000000;
                console.log(value.reduce((size, file) => size + file.size, 0))
                return !value
                    || value.reduce((size, file) => size + file.size, 0) < maxsize
                    || 'Файл не должен превышать ' + humanReadableFileSize(maxsize) + '!'
            }]

        }),
        props: ['project'],
        mounted() {
            console.log(this.project);
            this.loadFiles(this.project.files)
        },

        methods: {
            downloadURL(url) {
                var hiddenIFrameID = 'hiddenDownloader',
                    iframe = document.getElementById(hiddenIFrameID);
                if (iframe === null) {
                    iframe = document.createElement('iframe');
                    iframe.id = hiddenIFrameID;
                    iframe.style.display = 'none';
                    document.body.appendChild(iframe);
                }
                iframe.src = url;

            },
            deleteFile(id) {
                window.axios.delete('/projects/' + this.project.id
                    + '/files/' + id)
                    .then(response => {
                            this.loadFiles(response.data)
                        }
                    )
            },
            loadFiles(data) {

                this.project.files = data.map((file) => {
                    let icon = 'mdi-file-image-outline';
                    if (file.path.indexOf('.pdf') + 1) {
                        icon = 'mdi-file-pdf-outline'
                    }
                    if (file.path.indexOf('.doc') + 1) {
                        icon = 'mdi-file-word-outline '
                    }
                    console.log(file.path, file.path.indexOf('.jpg'));
                    if (file.path.indexOf('.jpg') + 1 || file.path.indexOf('.jpeg') + 1 || file.path.indexOf('.png') + 1) {
                        icon = 'image';
                    }


                    return Object.assign(file, {
                        icon: icon,
                        size: humanReadableFileSize(file.size)
                    });
                })
            },
            upload() {
                let formdata = new FormData;
                this.files.forEach(file => {
                    formdata.append('files[]', file)
                });
                window.axios.post('/projects/' + this.project.id
                    + '/files', formdata, {header: {}}).then(response => {
                    this.loadFiles(response.data)

                })
            }
        }


    }
</script>

<style scoped>

</style>
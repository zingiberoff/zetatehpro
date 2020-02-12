<template>
    <div>
        <v-file-input
                :show-size="1000"
                @click:append-outer="upload"
                append-outer-icon="mdi-content-save"
                color="deep-purple accent-4"
                counter
                label="File input"
                multiple
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
                    <img :alt="item.name" :src="item.src" v-if="item.icon!=='image'">
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
                        <v-btn @click="downloadURL(item.src)"
                               icon
                        >
                            <v-icon color="grey lighten-1"> mdi-download</v-icon>
                        </v-btn>
                        <v-btn @click="deleteFile(item.id)"
                               icon
                        >
                            <v-icon color="grey lighten-1">mdi-information</v-icon>
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

        }),
        props: ['project'],
        created() {
            console.log(this.project)
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
                window.axios.delete('/projects/9/files/' + id)
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
                    if (file.path.indexOf('.jpg') + 1 || file.path.indexOf('.png') + 1) {
                        let icon = 'image';
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
                window.axios.post('/projects/9/files', formdata, {header: {}}).then(response => {
                    this.loadFiles(response.data)

                })
            }
        }


    }
</script>

<style scoped>

</style>
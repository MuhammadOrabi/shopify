<template>
    <section>
        <b-field>
            <b-upload v-model="images" multiple drag-drop accept="image/*">
                <section class="section">
                    <div class="content has-text-centered">
                        <p>
                            <b-icon icon="upload" size="is-large"></b-icon>
                        </p>
                        <p>Drop your files here or click to upload</p>
                    </div>
                </section>
            </b-upload>
        </b-field>
        <button class="button" @click="upload">upload</button>
        <div class="tags">
            <span v-for="(file, index) in images"
                :key="index"
                class="tag is-primary" >
                {{file.name}}
                <button class="delete is-small"
                    type="button"
                    @click="deleteDropFile(index)">
                </button>
            </span>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['prefex', 'urls'],
        model: {
            prop: 'urls',
            event: 'change'
        },
        data() {
            return {
                images: [],
                uploading: false,
                progress: 0,
                links: []
            };
        },
        methods: {
            deleteDropFile(index) {
                this.images.splice(index, 1);
            },
            upload() {
                this.uploading = true;
                this.images.forEach(image => {
                    let date = new Date();
                    let prefex = this.prefex ? this.prefex + '/' : '';
                    let fileName = process.env.NODE_ENV + '/' + prefex + date.toDateString() + '/' + image.name;
                    let upload = window.firebase.storage().ref(fileName).put(image);
                    upload.on('state_changed', (snapshot) => {
                        this.progress = Math.trunc((snapshot.bytesTransferred / snapshot.totalBytes) * 100);
                    },
                    (err) => console.log(err),
                    () => {
                        upload.snapshot.ref.getDownloadURL().then((downloadURL) => {
                            this.urls.push(downloadURL);
                        });
                    });
                });
            }
        }
    }
</script>

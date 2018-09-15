<template>
    <section>
        <b-loading :active.sync="isLoading"></b-loading>
        <b-field>
            <b-upload v-model="files" drag-drop @input="onPickFile">
                <section class="section">
                    <div class="content has-text-centered p-t-80">
                        <p>
                            <b-icon icon="upload" size="is-large"></b-icon>
                        </p>
                        <p>Drop your files here or click to upload</p>
                    </div>
                </section>
            </b-upload>
        </b-field>
    </section>
</template>

<script>
    export default {
        name: 'Upload',
        props: ['accessToken', 'siteUrl'],
        data() {
            return {
                files: [],
                progress: 100
            }
        },
        computed: {
            isLoading() {
                if (this.progress < 100) {
                    return true;
                }
                return false;
            }
        },
        methods: {
            onPickFile() {
                this.upload();
            },
            upload() {
                this.files.forEach(file => {
                    let type = file.name.match(/.(jpg|jpeg|png|gif)$/i) ? 'image' : 'other';
                    let date = new Date();
                    let fileName = process.env.NODE_ENV + '/' + date.toDateString() + '/' + file.name;
                    let upload = window.firebase.storage().ref(fileName).put(file);
                    upload.on('state_changed', (snapshot) => {
                        this.progress = Math.trunc((snapshot.bytesTransferred / snapshot.totalBytes) * 100);
                        console.log(this.progress);
                    },
                    err => {
                        console.log(err);
                        this.$toast.open({
                            message: 'Something went wrong! Please try again later.',
                            type: 'is-danger'
                        });
                        this.progress = 100;
                    },
                    () => {
                        upload.snapshot.ref.getDownloadURL().then((downloadURL) => {
                            this.save(downloadURL, type);
                        });
                    });
                });
            },
            save(url, type) {
                let data = { url: url, type: type };
                window.axios.post(`${this.siteUrl}/api/admin/media`, data, {
                    'headers': {'Authorization': `Bearer ${this.accessToken}`}
                }).then(res => {
                    this.$toast.open({
                        message: 'The File saved sucessfully!',
                        type: 'is-success'
                    });
                    this.$emit('uploaded')
                }).catch(err => console.log(err));
            }
        }
    }
</script>

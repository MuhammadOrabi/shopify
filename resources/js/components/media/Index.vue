<template>
    <b-tabs v-model="activeTab">
        <b-tab-item label="Upload Files" icon="upload">
            <admin-media-upload ref="upload" :access-token="accessToken" :site-url="siteUrl" v-on:uploaded="uploaded"></admin-media-upload>
        </b-tab-item>
        <b-tab-item label="Pictures" icon="google-photos">
            <admin-media-images ref="images" :images="images" :form="form" v-model="selectedImage"
                :access-token="accessToken" :site-url="siteUrl"
                ></admin-media-images>
        </b-tab-item>
        <b-tab-item label="Videos" icon="video"></b-tab-item>
    </b-tabs>
</template>

<script>
    export default {
        name: 'Index',
        props: ['accessToken', 'siteUrl', 'form'],
        data() {
            return {
                activeTab: 0,
                files: [],
                selectedImage: null
            };
        },
        computed: {
            images() {
                return window._.where(this.files, {type: 'image'});
            },
            videos() {
                return window._.where(this.files, {type: 'video'});
            },
            docs() {
                return window._.where(this.files, {type: 'docs'});
            }
        },
        created() {
            this.getData();
        },
        watch: {
            selectedImage() {
                this.$emit('input', this.selectedImage);
            }
        },
        methods: {
            getData() {
                window.axios.get(`${this.siteUrl}/api/admin/media`, {
                    'headers': {'Authorization': `Bearer ${this.accessToken}`}
                }).then(res => {
                    this.files = res.data;
                }).catch(err => console.log(err));
            },
            uploaded() {
                this.getData();
                this.activeTab = 1;
            }
        }
    }
</script>

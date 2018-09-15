<template>
    <section>
        <b-field grouped group-multiline>
            <b-field label="Title*" expanded
                    :type="errors.title ? 'is-danger': ''"
                    :message="errors.title ? errors.title[0] : ''">
                <b-input placeholder="Title" type="text" v-model="form.title" :loading="loading"></b-input>
            </b-field>

            <b-field label="slug*" expanded :type="errors.slug ? 'is-danger': ''"
                    :message="errors.slug ? errors.slug[0] : ''">
                <b-input placeholder="slug" type="text" v-model="form.slug" :loading="loading"></b-input>
            </b-field>
        </b-field>
        <b-field label="Description*" expanded
                :type="errors.description ? 'is-danger': ''"
                :message="errors.description ? errors.description[0] : ''">
            <b-input placeholder="Description" type="textarea" v-model="form.description" :loading="loading"></b-input>
        </b-field>
        <b-field label="Enter some tags">
            <b-taginput
                v-model="form.tags"
                :data="data"
                autocomplete
                :allow-new="true"
                field="title"
                icon="label"
                placeholder="Add a tag"
                @typing="getFilteredTags">
            </b-taginput>
        </b-field>
        <b-field>
            <button class="button is-link" @click="openMedia">Add image</button>
        </b-field>
        <section class="p-t-20 columns" v-if="form.image">
            <div class="column is-one-quarter">
                <figure class="image is-square">
                    <img :src="form.image">
                </figure>
            </div>
        </section>
        <b-modal :active.sync="isCardModalActive" :width="960" scroll="keep">
            <div class="card">
                <div class="card-content">
                    <admin-media :access-token="accessToken" :site-url="siteUrl"
                        :form="true" v-model="selectedImage"
                        ></admin-media>
                </div>
            </div>
        </b-modal>
        <button class="button is-success is-centered" @click="save" >
            <span class="icon" ><font-awesome-icon icon="check" size="xs" fixed-width/></span>
            <span>Save</span>
        </button>
    </section>
</template>

<script>
    export default {
        name: 'Form',
        props: ['tags', 'category', 'siteUrl', 'accessToken'],
        data () {
            return {
                data: [],
                form: {
                    tags: []
                },
                selectedImage: null,
                errors: {},
                loading: false,
                isSelectOnly: false,
                isCardModalActive: false
            }
        },
        created() {
            this.data = JSON.parse(this.tags);
        },
        watch: {
            selectedImage() {
                this.form.image = this.selectedImage;
                this.isCardModalActive = false;
            }
        },
        methods: {
            getFilteredTags() {
                this.filteredTags = this.data.filter(option => {
                    return option.title
                        .toString()
                        .toLowerCase()
                        .indexOf(text.toLowerCase()) >= 0;
                });
            },
            openMedia() {
                this.isCardModalActive = true;
            },
            save() {
                this.loading = true;
                // this.form.image = this.$refs.media.links;
                this.errors = {};
                if (this.category) {
                    this.update();
                } else {
                    this.create();
                }
            },
            create() {
                window.axios.post(`${this.siteUrl}/api/admin/categories`, this.form, {
                    'headers': {'Authorization': `Bearer ${this.accessToken}`}
                }).then(res => {
                    this.loading = false;
                    this.form = {};
                    this.$toast.open({
                        message: res.data.message,
                        type: 'is-success'
                    });
                }).catch(err => {
                    this.errors = err.response.data.errors ? err.response.data.errors : {};
                    this.loading = false;
                    this.$toast.open({
                        message: err.response.data.message,
                        type: 'is-danger'
                    });
                });
            },
            update() {
                let category = JSON.parse(this.category);
                window.axios.put(`${this.siteUrl}/api/admin/categories/${admin.id}`, this.form, {
                    'headers': {'Authorization': `Bearer ${this.accessToken}`}
                }).then(res => {
                    this.loading = false;
                    this.$toast.open({
                        message: res.data.message,
                        type: 'is-success'
                    });
                }).catch(err => {
                    this.errors = err.response.data.errors ? err.response.data.errors : {};
                    this.loading = false;
                    this.$toast.open({
                        message: err.response.data.message,
                        type: 'is-danger'
                    });
                });
            }
        }
    }
</script>

<style lang="css" scoped>
</style>

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
                :data="tags"
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
        <section class="p-t-20 columns" v-if="images.length">
            <div class="column is-one-quarter" v-for="(image, i) in images" :key="i">
                <a class="delete" @click="removeImage(i)"></a>
                <figure class="image is-square">
                    <img :src="image.links.normal">
                </figure>
            </div>
        </section>
        <b-modal :active.sync="isCardModalActive" scroll="keep" :width="'100%'" id="full">
            <div class="card">
                <div class="card-content">
                    <admin-media :site-url="siteUrl"
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
        props: ['tags', 'category', 'siteUrl'],
        data () {
            return {
                form: {
                    tags: [],
                    images: [],
                    title: ''
                },
                images: [],
                selectedImage: [],
                errors: {},
                loading: false,
                isSelectOnly: false,
                isCardModalActive: false
            }
        },
        created() {
            if (this.category) {
                this.form.title = this.category.title;
                this.form.slug = this.category.slug;
                this.form.description = this.category.description;
                this.form.tags = this.category.tags;
                let images = window._.where(this.category.files, {type: 'image'});

                this.images = images.length ? images : null;
            }
        },
        watch: {
            selectedImage() {
                this.isCardModalActive = false;
                this.images = this.images.concat(this.selectedImage);
            },
            title() {
                this.form.slug = this.title.replace(/\s+/g, '-').toLowerCase();;
            }
        },
        computed: {
            title() {
                return this.form.title;
            }
        },
        methods: {
            getFilteredTags() {
                this.filteredTags = this.tags.filter(option => {
                    return option.title
                        .toString()
                        .toLowerCase()
                        .indexOf(option.title.toLowerCase()) >= 0;
                });
            },
            openMedia() {
                this.isCardModalActive = true;
            },
            removeImage(i) {
                this.images.splice(i, 1);
            },
            save() {
                this.form.images = window._.pluck(this.images, 'id');
                this.loading = true;
                this.errors = {};
                if (this.category) {
                    this.update();
                } else {
                    this.create();
                }
            },
            create() {
                window.axios.post(`${this.siteUrl}/api/admin/categories`, this.form)
                .then(res => {
                    this.loading = false;
                    this.form = {
                        tags: [],
                        images: []
                    };
                    this.images = [];
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
                window.axios.put(`${this.siteUrl}/api/admin/categories/${this.category.id}`, this.form)
                .then(res => {
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

<style lang="css" scoped></style>

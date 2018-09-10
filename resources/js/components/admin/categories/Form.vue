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
            <b-upload v-model="form.images" multiple drag-drop accept="image/*">
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

        <div class="tags">
            <span v-for="(file, index) in form.images"
                :key="index"
                class="tag is-primary" >
                {{file.name}}
                <button class="delete is-small"
                    type="button"
                    @click="deleteDropFile(index)">
                </button>
            </span>
        </div>
        <button class="button is-success is-centered" @click="save" >
            <span class="icon" ><font-awesome-icon icon="check" size="xs" fixed-width/></span>
            <span>Save</span>
        </button>
    </section>
</template>

<script>
    export default {
        name: 'Form',
        props: ['tags', 'admin', 'siteUrl', 'accessToken'],
        data () {
            return {
                data: [],
                form: {
                    images: []
                },
                errors: {},
                loading: false,
                isSelectOnly: false,
            }
        },
        mounted() {
            this.data = JSON.parse(this.tags);
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
            deleteDropFile(index) {
                this.form.images.splice(index, 1);
            },
            save() {
                this.loading = true;
                this.errors = {};
                if (this.admin) {
                    this.update();
                } else {
                    this.create();
                }
            },
            create() {
                let form = new FormData();

                for ( const key in this.form ) {
                    if (key == 'images') {
                        for (const image in this.form[key]) {
                            form.append('images[]', this.form[key][image]);
                        }
                    } else {
                        form.append(key, this.form[key]);
                    }
                }
                window.axios.post(`${this.siteUrl}/api/admin/categories`, form, {
                    'headers': {
                        'Authorization': `Bearer ${this.accessToken}`,
                        'content-type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    this.loading = false;
                    this.form = {};
                    this.$toast.open({
                        message: res.data.message,
                        type: 'is-success'
                    });
                })
                .catch(err => {
                    this.errors = err.response.data.errors ? err.response.data.errors : {};
                    this.loading = false;
                    this.$toast.open({
                        message: err.response.data.message,
                        type: 'is-danger'
                    });
                });
            },
            update() {
                let admin = JSON.parse(this.admin);
                window.axios.put(`${this.siteUrl}/api/admin/categories/${admin.id}`, this.form, {'headers': {'Authorization': `Bearer ${this.accessToken}`}})
                .then(res => {
                    this.loading = false;
                    this.$toast.open({
                        message: res.data.message,
                        type: 'is-success'
                    });
                })
                .catch(err => {
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

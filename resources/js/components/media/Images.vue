<template>
    <section class="columns">
        <b-modal :active.sync="viewImage" v-if="selectedImage" canCancel>
            <p class="image is-4by3">
                <img :src="selectedImage">
            </p>
        </b-modal>
        <section class="column p-t-20 columns is-multiline">
            <div class="column is-one-quarter" v-for="(img, i) in images" :key="i">
                <b-checkbox size="is-small" v-model="checked" :native-value="img.id"></b-checkbox>
                <figure class="image is-5by3">
                    <img :src="img.links.normal" @click="selectImg(img)">
                </figure>
            </div>
        </section>
        <div class="column is-one-fifth has-background-white-ter">
            <aside class="menu m-t-30 m-l-10">
                <p class="menu-label">Administration</p>
                <ul class="menu-list">
                    <li>
                        <a class="is-active">Manage Your Images</a>
                        <ul>
                            <li><a :class="checked.length <= 0 ? 'is-disabled' : ''" @click="deleteAll">Delete</a></li>
                            <li><a :class="checked.length <= 0 ? 'is-disabled' : ''">Generate Sizes</a></li>
                        </ul>
                    </li>
                </ul>
            </aside>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'Images',
        props: ['images', 'siteUrl', 'form'],
        data() {
            return {
                selectedImage: null,
                viewImage: false,
                checked: [],
            };
        },
        methods: {
            selectImg(image) {
                if (this.form) {
                    this.$emit('input', image);
                    return;
                }
                this.viewImage = true;
                this.selectedImage = image.links.normal;
            },
            deleteAll() {
                this.checked.forEach(image => {
                    this.deleteImage(image);
                });
            },
            deleteImage(id) {
                window.axios.delete(`${this.siteUrl}/api/admin/admins/${id}`)
                .then(res => {
                    console.log(res.data);
                }).catch(err => console.log(err));
            }
        }
    }
</script>

<style>

</style>

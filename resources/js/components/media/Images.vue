<template>
    <section class="columns">
        <b-modal :active.sync="viewImage" v-if="selectedImage">
            <p class="image is-4by3">
                <img :src="selectedImage">
            </p>
        </b-modal>
        <section class="column p-t-20 columns is-multiline">
            <div class="column is-one-quarter" v-for="(img, i) in images" :key="i">
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
                        <a class="is-active">Manage Your Team</a>
                        <ul>
                            <li><a>Members</a></li>
                            <li><a>Plugins</a></li>
                            <li><a>Add a member</a></li>
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
        props: ['images', 'accessToken', 'siteUrl', 'form'],
        data() {
            return {
                selectedImage: null,
                viewImage: false
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
            }
        }
    }
</script>

<style>

</style>

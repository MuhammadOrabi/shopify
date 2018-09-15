<template>
    <section>
        <b-modal :active.sync="viewImage" v-if="selectedImage">
            <p class="image is-4by3">
                <img :src="selectedImage">
            </p>
        </b-modal>
        <section class="p-t-20 columns is-multiline">
            <div class="column is-one-quarter" v-for="(img, i) in images" :key="i">
                <figure class="image is-square">
                    <img :src="img.links.normal" @click="selectImg(img.links.normal)">
                </figure>
            </div>
        </section>
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
            selectImg(url) {
                if (this.form) {
                    this.$emit('input', url);
                    return;
                }
                this.viewImage = true;
                this.selectedImage = url;
            }
        }
    }
</script>

<style>

</style>

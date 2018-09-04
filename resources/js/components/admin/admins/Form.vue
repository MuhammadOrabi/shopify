<template>
    <section>
        <b-field grouped group-multiline>
            <b-field label="Name" expanded>
                <b-input placeholder="Name" type="text"></b-input>
            </b-field>

            <b-field label="Email" expanded>
                <b-input placeholder="Email" type="email"></b-input>
            </b-field>
        </b-field>
        <b-field grouped group-multiline>
            <b-field label="Password" expanded>
                <b-input placeholder="Password" type="password" minlength="6"></b-input>
            </b-field>

            <b-field label="Password Confirmation" expanded>
                <b-input placeholder="Password" type="password" minlength="6"></b-input>
            </b-field>
        </b-field>

        <b-field label="Role" >
            <b-select placeholder="Select a role">
                <option v-for="role in data" :value="role.id" :key="role.id">
                    {{ role.title }}
                </option>
            </b-select>
        </b-field>
        <button class="button is-success is-centered">
            <span class="icon is-small">
                <i class="fa fa-check"></i>
            </span>
            <span>Save</span>
        </button>
    </section>
</template>

<script>
    export default {
        name: 'Form',
        props: ['roles', 'siteUrl', 'accessToken'],
        data () {
            return {
                data: []
            }
        },
        mounted() {
            this.data = JSON.parse(this.roles);
            console.log(this.data[0]);
        }
    }
</script>

<style lang="css" scoped>
</style>

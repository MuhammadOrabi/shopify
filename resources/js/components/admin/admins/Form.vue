<template>
    <section>
        <b-field grouped group-multiline>
            <b-field label="Name" expanded
                    :type="errors.name ? 'is-danger': ''"
                    :message="errors.name ? errors.name[0] : ''">
                <b-input placeholder="Name" type="text" v-model="form.name" :loading="loading"></b-input>
            </b-field>

            <b-field label="Email" expanded :type="errors.email ? 'is-danger': ''"
                    :message="errors.email ? errors.email[0] : ''">
                <b-input placeholder="Email" type="email" v-model="form.email" :loading="loading"></b-input>
            </b-field>
        </b-field>
        <b-field grouped group-multiline>
            <b-field label="Password" expanded
                    :type="errors.password ? 'is-danger': ''"
                    :message="errors.password ? errors.password[0] : ''">
                <b-input placeholder="Password" type="password" v-model="form.password" :loading="loading"></b-input>
            </b-field>

            <b-field label="Password Confirmation" expanded
                    :type="errors.password ? 'is-danger': ''">
                <b-input placeholder="Password" type="password" v-model="form.password_confirmation" :loading="loading"></b-input>
            </b-field>
        </b-field>

        <b-field label="Role"
                    :type="errors.role ? 'is-danger': ''"
                    :message="errors.role ? errors.role[0] : ''">
            <b-select placeholder="Select a role" v-model="form.role">
                <option v-for="role in data" :value="role.id" :key="role.id">
                    {{ role.title }}
                </option>
            </b-select>
        </b-field>
        <button class="button is-success is-centered" @click="save" >
            <span class="icon" ><font-awesome-icon icon="check" size="xs" fixed-width/></span>
            <span>Save</span>
        </button>
    </section>
</template>

<script>
    export default {
        name: 'Form',
        props: ['roles', 'admin', 'siteUrl', 'accessToken'],
        data () {
            return {
                data: [],
                form: {},
                errors: {},
                loading: false
            }
        },
        mounted() {
            this.data = JSON.parse(this.roles);
            if (this.admin) {
                let admin = JSON.parse(this.admin);
                this.form = {
                    name: admin.name,
                    email: admin.email,
                    role: admin.roles[0].id
                };
            }
        },
        methods: {
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
                window.axios.post(`${this.siteUrl}/api/admin/admins`, this.form, {'headers': {'Authorization': `Bearer ${this.accessToken}`}})
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
                window.axios.put(`${this.siteUrl}/api/admin/admins/${admin.id}`, this.form, {'headers': {'Authorization': `Bearer ${this.accessToken}`}})
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

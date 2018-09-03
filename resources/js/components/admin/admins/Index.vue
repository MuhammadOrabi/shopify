<template>
    <section>
        <b-table :data="data" :checked-rows.sync="checkedRows" checkable>
            <template slot-scope="props">
                <b-table-column field="id" label="ID" width="40" sortable numeric>
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column field="name" label="Name" sortable>
                    {{ props.row.name }}
                </b-table-column>

                <b-table-column field="email" label="Email" sortable>
                    {{ props.row.email }}
                </b-table-column>

                <b-table-column field="created_at" label="Created Date" sortable centered>
                    <span class="tag is-success">
                        {{ new Date(props.row.created_at).toLocaleDateString() }}
                    </span>
                </b-table-column>

                <b-table-column label="Options">
                    <a :href="`${siteUrl}/admin/admins/${props.row.id}/edit`" class="button is-info">Update</a>
                    <button class="button is-danger" @click="confirmCustomDelete(props.row.id)">
                        Delete Admin
                    </button>
                </b-table-column>
            </template>

            <template slot="bottom-left">
                <b>Total checked</b>: {{ checkedRows.length }}
            </template>
        </b-table>
    </section>
</template>

<script>
    export default {
        props: ['admins', 'siteUrl', 'accessToken'],
        computed: {
            data() {
                return JSON.parse(this.admins);
            }
        },
        data() {
            return {
                checkedRows: [],
            }
        },
        methods: {
            confirmCustomDelete(id) {
                this.$dialog.confirm({
                    title: 'Deleting admin',
                    message: 'Are you sure you want to <b>delete</b> this admin? This action cannot be undone.',
                    confirmText: 'Delete Account',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => this.deleteUser(id)
                });
            },
            deleteUser(id) {
                window.axios.delete(`${this.siteUrl}/api/admin/admins/${id}`, {'headers': {'Authorization': `Bearer ${this.accessToken}`}})
                    .then(res => {
                        console.log(res);
                    }).catch(err => console.log(err));
                this.$toast.open('Account deleted! ' . id);
            }
        }
    }
</script>

<template>
    <section>
        <b-table :data="data" :checked-rows.sync="checkedRows" checkable>
            <template slot-scope="props">
                <b-table-column field="id" label="ID" width="40" sortable numeric>
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column field="title" label="Title" sortable>
                    {{ props.row.title }}
                </b-table-column>

                <b-table-column field="slug" label="Slug" sortable>
                    {{ props.row.slug }}
                </b-table-column>

                <b-table-column field="created_at" label="Created Date" sortable centered>
                    <span class="tag is-info">
                        {{ new Date(props.row.created_at).toLocaleDateString() }}
                    </span>
                </b-table-column>

                <b-table-column label="Options">
                    <a :href="`${siteUrl}/admin/categories/${props.row.id}`" class="button is-info is-inverted is-rounded">
                        <font-awesome-icon icon="eye" fixed-width size="lg"/>
                    </a>
                    <a :href="`${siteUrl}/admin/categories/${props.row.id}/edit`" class="button is-primary is-inverted is-rounded">
                        <font-awesome-icon icon="edit" fixed-width size="lg"/>
                    </a>
                    <button class="button is-danger is-inverted is-rounded" @click="confirmCustomDelete(props.row.id)">
                        <font-awesome-icon icon="trash" fixed-width size="lg"/>
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
        props: ['categories', 'siteUrl', 'accessToken'],
        data() {
            return {
                checkedRows: [],
                data: []
            }
        },
        mounted() {
            this.data = JSON.parse(this.categories);
        },
        methods: {
            confirmCustomDelete(id) {
                this.$dialog.confirm({
                    title: 'Deleting Category',
                    message: 'Are you sure you want to <b>delete</b> this Cateory? This action cannot be undone.',
                    confirmText: 'Delete Category',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => this.deleteCategory(id)
                });
            },
            deleteCategory(id) {
                window.axios.delete(`${this.siteUrl}/api/admin/categories/${id}`, {'headers': {'Authorization': `Bearer ${this.accessToken}`}})
                .then(res => {
                    this.data = window._.reject(this.data, category => {
                        return category.id == id;
                    });
                    this.checkedRows = [];
                    this.$toast.open('Category deleted!');
                }).catch(err => console.log(err));
            }
        }
    }
</script>

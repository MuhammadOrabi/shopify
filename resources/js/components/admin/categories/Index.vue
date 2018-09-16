<template>
    <section>
        <b-field label="Filter data">
            <b-select placeholder="Select a filter" v-model="filter">
                <option value="1">Without Trashed</option>
                <option value="2">With Trashed</option>
                <option value="3">Trashed Only</option>
            </b-select>
        </b-field>

        <b-table :data="filtered ? filtered : []" :checked-rows.sync="checkedRows" checkable>
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
                    <a :href="`${siteUrl}/admin/categories/${props.row.id}`"
                        title="View" class="button is-info is-inverted is-rounded">
                        <font-awesome-icon icon="eye" fixed-width size="lg"/>
                    </a>
                    <a :href="`${siteUrl}/admin/categories/${props.row.id}/edit`"
                        title="Edit" class="button is-primary is-inverted is-rounded">
                        <font-awesome-icon icon="edit" fixed-width size="lg"/>
                    </a>
                    <button v-if="!props.row.deleted_at" title="Delete"
                        class="button is-danger is-inverted is-rounded"
                        @click="confirmDelete(props.row.id)">
                        <font-awesome-icon icon="trash" fixed-width size="lg"/>
                    </button>
                    <button v-else title="Restore" class="button is-info is-inverted is-rounded"
                        @click="confirmRestore(props.row.id)">
                        <font-awesome-icon icon="sync" fixed-width size="lg"/>
                    </button>
                </b-table-column>
            </template>

            <template slot="bottom-left">
                <b>Total checked</b>: {{ checkedRows.length }}
            </template>
            <template slot="empty">
                <section class="section">
                    <div class="content has-text-grey has-text-centered">
                        <p>
                            <b-icon icon="emoticon-sad" size="is-large"></b-icon>
                        </p>
                        <p>Nothing here.</p>
                    </div>
                </section>
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
                data: [],
                filter: '1'
            }
        },
        computed: {
            filtered() {
                switch (this.filter) {
                    case '1':
                        return window._.reject(this.data, item => {
                            return item.deleted_at !== null ? true : false;
                        });
                        break;

                    case '3':
                        return window._.reject(this.data, item => {
                            return item.deleted_at === null ? true : false;
                        });
                        break;

                    default:
                        return this.data;
                        break;
                }
            }
        },
        created() {
            this.data = JSON.parse(this.categories);
        },
        methods: {
            confirmDelete(id) {
                this.$dialog.confirm({
                    title: 'Deleting Category',
                    message: 'Are you sure you want to <b>delete</b> this Category?',
                    confirmText: 'Delete Category',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => this.deleteCategory(id)
                });
            },
            deleteCategory(id) {
                window.axios.delete(`${this.siteUrl}/api/admin/categories/${id}`,
                    {'headers': {'Authorization': `Bearer ${this.accessToken}`}}
                ).then(res => {
                    let category = window._.findWhere(this.data, {id: id});
                    this.data = window._.reject(this.data, category => {
                        return category.id == id;
                    });
                    category.deleted_at = new Date();
                    this.data.push(category);

                    this.checkedRows = [];
                    this.$toast.open('Category deleted!');
                }).catch(err => console.log(err));
            },
            confirmRestore(id) {
                this.$dialog.confirm({
                    title: 'Restoring Category',
                    message: 'Are you sure you want to <b>restore</b> this Category?',
                    confirmText: 'Restore Category',
                    type: 'is-warning',
                    hasIcon: true,
                    onConfirm: () => this.restoreCategory(id)
                });
            },
            restoreCategory(id) {
                window.axios.post(`${this.siteUrl}/api/admin/categories/restore/${id}`, {},
                    {'headers': {'Authorization': `Bearer ${this.accessToken}`}}
                ).then(res => {
                    let category = window._.findWhere(this.data, {id: id});
                    this.data = window._.reject(this.data, category => {
                        return category.id == id;
                    });
                    category.deleted_at = null;
                    this.data.push(category);

                    this.checkedRows = [];
                    this.$toast.open('Category restored!');
                }).catch(err => console.log(err));
            }
        }
    }
</script>

<template>
    <section>
        <b-field grouped>
            <b-field label="Select">
                <b-select placeholder="Select a filter" v-model="filter">
                    <option value="1">Without Trashed</option>
                    <option value="2">With Trashed</option>
                    <option value="3">Trashed Only</option>
                </b-select>
            </b-field>
            <b-field label="Search" expanded>
                <b-input placeholder="Search ...." type="search" icon="magnify" v-model="key"></b-input>
            </b-field>
        </b-field>
        <b-table :data="filtered ? filtered : []" :checked-rows.sync="checkedRows" checkable>
            <template slot-scope="props">
                <b-table-column field="id" label="ID" width="40" sortable numeric>
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column field="title" label="Title" sortable>
                    {{ props.row.title }}
                </b-table-column>

                <b-table-column field="category" label="Category" sortable>
                    {{ props.row.category.title }}
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
                    <a :href="`${siteUrl}/admin/items/${props.row.id}`"
                        title="View" class="button is-info is-inverted is-rounded">
                        <font-awesome-icon icon="eye" fixed-width size="lg"/>
                    </a>
                    <a :href="`${siteUrl}/admin/items/${props.row.id}/edit`"
                        title="Edit" class="button is-primary is-inverted is-rounded">
                        <font-awesome-icon icon="edit" fixed-width size="lg"/>
                    </a>
                    <button v-if="!props.row.deleted_at" title="Delete"
                        class="button is-danger is-inverted is-rounded"
                        @click="confirmDelete(props.row.id)">
                        <font-awesome-icon icon="trash" fixed-width size="lg"/>
                    </button>
                    <button v-if="props.row.deleted_at" title="Restore" class="button is-info is-inverted is-rounded"
                        @click="confirmRestore(props.row.id)">
                        <font-awesome-icon icon="sync" fixed-width size="lg"/>
                    </button>
                    <button v-if="props.row.deleted_at" title="Force Delete" class="button is-danger is-inverted is-rounded"
                        @click="confirmForceDelete(props.row.id)">
                        <font-awesome-icon icon="minus-square" fixed-width size="lg"/>
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
    import * as JsSearch from 'js-search';
    export default {
        props: ['items', 'siteUrl'],
        data() {
            return {
                checkedRows: [],
                data: [],
                filter: '1',
                key: ''
            }
        },
        computed: {
            filtered() {
                let data = this.data;
                switch (this.filter) {
                    case '1':
                        data = window._.reject(data, item => {
                            return item.deleted_at !== null ? true : false;
                        });
                        break;

                    case '3':
                        return window._.reject(data, item => {
                            return item.deleted_at === null ? true : false;
                        });
                        break;

                    default:
                        return data;
                        break;
                }
                if (this.key) {
                    let search = new JsSearch.Search('id');
                    search.addIndex('title');
                    search.addIndex('tags');
                    search.addIndex('slug');
                    search.addIndex('created_at');
                    search.addDocuments(data);
                    data = search.search(this.key);
                }
                return data;
            }
        },
        created() {
            this.data = this.items;
        },
        methods: {
            confirmDelete(id) {
                this.$dialog.confirm({
                    title: 'Deleting Item',
                    message: 'Are you sure you want to <b>delete</b> this Item?',
                    confirmText: 'Delete Item',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => this.deleteItem(id)
                });
            },
            deleteItem(id) {
                window.axios.delete(`${this.siteUrl}/api/admin/items/${id}`)
                .then(res => {
                    let item = window._.findWhere(this.data, {id: id});
                    this.data = window._.reject(this.data, item => {
                        return item.id == id;
                    });
                    item.deleted_at = new Date();
                    this.data.push(item);

                    this.checkedRows = [];
                    this.$toast.open('item deleted!');
                }).catch(err => console.log(err));
            },
            confirmRestore(id) {
                this.$dialog.confirm({
                    title: 'Restoring item',
                    message: 'Are you sure you want to <b>restore</b> this item?',
                    confirmText: 'Restore item',
                    type: 'is-warning',
                    hasIcon: true,
                    onConfirm: () => this.restoreItem(id)
                });
            },
            restoreItem(id) {
                window.axios.post(`${this.siteUrl}/api/admin/items/restore/${id}`, {})
                .then(res => {
                    let item = window._.findWhere(this.data, {id: id});
                    this.data = window._.reject(this.data, item => {
                        return item.id == id;
                    });
                    item.deleted_at = null;
                    this.data.push(item);

                    this.checkedRows = [];
                    this.$toast.open('item restored!');
                }).catch(err => console.log(err));
            },
            confirmForceDelete(id) {
                this.$dialog.confirm({
                    title: 'Force Deleting item',
                    message: 'Are you sure you want to <b>force delete</b> this item? this action can not be done.',
                    confirmText: 'Force Delete item',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => this.forceDeleteItem(id)
                });
            },
            forceDeleteItem(id) {
                window.axios.post(`${this.siteUrl}/api/admin/items/force-delete/${id}`)
                .then(res => {
                    let item = window._.findWhere(this.data, {id: id});
                    this.data = window._.reject(this.data, item => {
                        return item.id == id;
                    });

                    this.checkedRows = [];
                    this.$toast.open('item deleted!');
                }).catch(err => console.log(err));
            }
        }
    }
</script>

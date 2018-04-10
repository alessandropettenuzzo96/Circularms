<template>
    <b-table :data="$props.routes">

        <template slot-scope="props">
            <b-table-column field="id" label="ID" width="50" numeric centered sortable><strong>{{props.row.id}}</strong></b-table-column>

            <b-table-column field="priority" label="Priority" width="80" numeric centered>{{props.row.priority}}</b-table-column>

            <b-table-column field="usage" label="Usage" width="80" sortable centered>{{ props.row.usage }}</b-table-column>

            <b-table-column field="method" label="Method" width="80" sortable centered><strong>{{ props.row.method }}</strong></b-table-column>

            <b-table-column field="route" label="Endpoint" sortable><strong>{{ props.row.route }}</strong></b-table-column>

            <b-table-column field="template" label="Template or Controller"><code>{{ props.row.template ? props.row.template : props.row.controller }}</code></b-table-column>

            <b-table-column field="privileges" label="Privileges" width="120">
                <b-taglist>
                    <b-tag type="is-warning" v-for="privilege in props.row.privileges" :key="privilege">{{privilege}}</b-tag>
                </b-taglist>
            </b-table-column>

            <b-table-column field="middleware" label="Middleware" width="120">
                <b-taglist>
                    <b-tag v-for="middleware in props.row.middleware" type="is-info" :key="middleware">{{middleware}}</b-tag>
                </b-taglist>
            </b-table-column>

            <b-table-column field="active" label="Actived" width="80" centered>
                <b-switch :value="!!props.row.active" @input="(value) => { toggleActive(value, props.row.id) }"></b-switch>
            </b-table-column>

            <b-table-column field="id" label="Actions" centered>
                <button class="button is-text is-small margin-thin" @click="settings(props.row)">
                    <b-icon pack="mdi" icon="settings"></b-icon>
                </button>
                <button class="button is-text is-small margin-thin has-text-info" @click="editItem(props.row)">
                    <b-icon pack="mdi" icon="pencil"></b-icon>
                </button>
                <button class="button is-text is-small margin-thin has-text-danger" @click="deleteItem(props.row.id)">
                    <b-icon pack="mdi" icon="delete"></b-icon>
                </button>
            </b-table-column>
        </template>
    </b-table>
</template>

<script>
    import BTaglist from "buefy/src/components/tag/Taglist";
    import BTag from "buefy/src/components/tag/Tag";
    import DynamicRoutesEditor from "./DynamicRoutesEditor";
    import DynamicRoutesSettingsEditor from "./DynamicRoutesSettingsEditor";
    import * as qs from 'qs';

    export default {
        components: {
            BTag,
            BTaglist},
        props: ['routes'],
        data() {
            return {
                routes: [],
            }
        },

        mounted() {

        },
        
        methods: {
            toggleActive(switchval, row) {
                axios.patch('/admin/settings/routes/'+row, qs.stringify({scoped_to: 'active', active: (switchval ? 1 : 0) })).then(data => {
                    console.log("ROUTE "+ row + "NOW IS "+ (switchval ? "ACTIVED" : "INACTIVE"));
                }).catch(e => {
                    this.$dialog.alert({
                        title: 'Whoops, An error has occurred!',
                        message: e.message,
                        type: 'is-danger',
                        hasIcon: true,
                        icon: 'times-circle',
                        iconPack: 'fa'
                    })
                });
            },
            settings: function (row) {
                this.$modal.open({
                    parent: this,
                    component: DynamicRoutesSettingsEditor,
                    props: { route: row },
                    hasModalCard: true
                });
            },
            editItem: function (row) {
                this.$modal.open({
                    parent: this,
                    component: DynamicRoutesEditor,
                    props: { route: row },
                    hasModalCard: true
                });
            },
            deleteItem:function(row) {
                this.$dialog.confirm({
                    title: 'Sicuro?',
                    message: 'Sei sicuro di voler cancellare questa rotta? <b>Questa operazione non è reversivbile</b>',
                    confirmText: 'Elimina',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        axios.delete('/admin/settings/routes/'+row).then(data => {
                            window.location.reload(true);
                        }).catch(e => {
                            this.$dialog.alert({
                                title: 'Whoops, An error has occurred!',
                                message: e.message,
                                type: 'is-danger',
                                hasIcon: true,
                                icon: 'times-circle',
                                iconPack: 'fa'
                            })
                        });
                    }
                });
            }
        }
    }
</script>

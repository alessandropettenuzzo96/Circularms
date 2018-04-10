<template>
    <form method="post" v-on:submit.prevent="sendForm">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">{{$props.route ? 'Modifica Rotta' : 'Crea Rotta'}}</p>
            </header>
            <section class="modal-card-body">
                <b-field grouped>
                    <b-field label="Usage">
                        <b-select v-model="usage" placeholder="WEB">
                            <option value="WEB" selected="selected">WEB</option>
                            <option value="API">API</option>
                        </b-select>
                    </b-field>
                    <b-field label="Priority">
                        <b-input type="number" v-model="priority"></b-input>
                    </b-field>
                    <b-field label="Method">
                        <b-select v-model="method" placeholder="GET">
                            <option value="GET" selected="selected">GET</option>
                            <option value="POST">POST</option>
                            <option value="PATCH">PATCH</option>
                            <option value="PUT">PUT</option>
                            <option value="DELETE">DELETE</option>
                        </b-select>
                    </b-field>
                    <b-field label="Endpoint">
                        <b-input
                                type="text"
                                v-model="endpoint"
                                placeholder="/posts/{post}"
                                required>
                        </b-input>
                    </b-field>
                </b-field>
                <b-field label="Use Controller">
                    <b-switch v-model="useController">
                        {{ useController ? "Controller" : "Template" }}
                    </b-switch>
                </b-field>

                <b-field :label="useController ? 'Controller' : 'Template'">
                    <b-input type="text" v-model="controller" name="controller" placeholder="Controller@Method" v-if="useController"></b-input>
                    <b-input v-else v-model="template" name="template" type="textarea"></b-input>
                </b-field>
                <b-field label="Privileges">
                    <b-taginput
                            v-model="privileges"
                            type="is-warning"
                            placeholder="Scrivi">
                    </b-taginput>
                </b-field>

                <b-field label="Middleware">
                    <b-taginput
                            v-model="middleware"
                            type="is-info"
                            placeholder="Scrivi">
                    </b-taginput>
                </b-field>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Chiudi</button>
                <button class="button is-primary" type="submit">{{$props.route ? 'Applica' : 'Crea'}}</button>
            </footer>
        </div>
    </form>
</template>

<script>
    import BInput from "buefy/src/components/input/Input";
    import BField from "buefy/src/components/field/Field";
    import * as qs from 'qs';

    export default {
        components: {
            BField,
            BInput},
        name: "dynamic-routes-editor",
        props: ['route'],
        data() {
            return {
                usage: 'WEB',
                method: 'GET',
                priority: 0,
                useController: false,
                endpoint: '',
                template: null,
                controller: null,
                privileges: [],
                middleware: [],
            }
        },

        mounted() {
            if(this.$props.route) {
                this.endpoint = this.$props.route.route;
                this.usage = this.$props.route.usage;
                this.method = this.$props.route.method;
                this.priority = this.$props.route.priority;
                this.template = this.$props.route.template;
                this.controller = this.$props.route.controller;
                this.privileges = this.$props.route.privileges ? this.$props.route.privileges : [];
                this.middleware = this.$props.route.middleware ? this.$props.route.middleware : [];
                this.useController = !this.template;
            }
        },

        methods: {
            sendForm: function () {
                let form = {
                    usage: this.usage,
                    method: this.method,
                    priority: this.priority,
                    route: this.endpoint,
                    controller: this.useController ? this.controller : null,
                    template: this.useController ? null : this.template,
                    middleware: this.middleware ? this.middleware.join(' ') : null,
                    privileges: this.privileges ? this.privileges.join(' ') : null
                };
                if(!this.$props.route) {
                    axios.post('/admin/settings/routes', qs.stringify(form)).then((data) => {
                        this.$parent.close();
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
                } else {
                    axios.patch('/admin/settings/routes/'+this.$props.route.id, qs.stringify(form)).then((data) => {
                        this.$parent.close();
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
            }
        }
    }
</script>

<style scoped>

</style>
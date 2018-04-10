<template>
    <form method="post" v-on:submit.prevent="sendForm">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head is-paddingless">
                <div class="columns is-half-width is-marginless">
                    <div class="column is-10 is-flex">
                        <p class="modal-card-title align-self-center">Settings</p>
                    </div>
                    <div class="column is-2 has-text-right">
                        <button class="button" type="button" @click="add()">
                            <b-icon pack="mdi" icon="plus"></b-icon>
                        </button>
                    </div>
                </div>
            </header>
            <section class="modal-card-body">
                <div v-if="settingsdata && settingsdata.length > 0">
                    <b-field v-for="(setting, index) in settingsdata" :key="index" grouped>
                        <b-field  expanded>
                            <b-input type="text" v-model="settingsdata[index].name" placeholder="name"></b-input>
                        </b-field>
                        <b-field  expanded>
                            <b-input type="text" v-model="settingsdata[index].value" placeholder="value"></b-input>
                        </b-field>
                    </b-field>
                </div>
                <p v-else>Nessuna impostazione per questa rotta.</p>

            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Chiudi</button>
                <button class="button is-primary" type="submit">Salva</button>
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
        name: "dynamic-routes-settings-editor",
        props: {
            route: {
                required: true,
            }
        },
        data() {
            return {
                settingsdata: [],
            }
        },

        mounted() {
            if(this.$props.route && this.$props.route.settings) {
                this.settingsdata = this.$props.route.settings;
            }
        },

        methods: {
            add: function () {
                if(!this.settingsdata) this.settingsdata = [];
                this.settingsdata.push({name: null, value: null})
            },
            sendForm: function () {
                let s = this.settingsdata.filter(el => {
                    return el.name !== null && el.name !== '' && el.value !== null && el.value !== '';
                });
                let form = {
                    scoped_to: 'settings',
                    settings: JSON.stringify(s)
                };
                axios.patch('/admin/settings/routes/'+this.$props.route.id, qs.stringify(form)).then((data) => {
                    this.$parent.close();
                    window.location.reload(true);
                }).catch(e => {
                    return console.log(e.response.data);
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
</script>

<style scoped>

</style>
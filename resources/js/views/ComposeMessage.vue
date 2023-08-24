<template>
    <div class="view-compose flex">
        <UserList :users="users" @selected="writeMessageTo" />
        <Editor :recipient="recipient"  @send="sendMessage"/>
    </div>
</template>

<script>
    import UserList from '../components/UserList.vue';
    import Editor from '../components/Editor.vue';
    import { inject } from 'vue';

    export default {
        data() {
            return {
                recipient: null,
                users: [],
            };
        },

        mounted() {
            this.toast = inject('toast');
            axios.get("/api/users").then((response) => {
                this.users = response.data;
            }).catch(error => {
                this.toast.error({
                    title: 'Error!',
                    message: error.response.data.message,
                    delay: 5000
                });
            });
        },
        methods: {
            sendMessage(subject, content) {

                if (!this.recipient) {
                    this.toast .error({
                        title: 'Error!',
                        message: 'Destinatario no válido!',
                        delay: 5000
                    });
                    return;
                }
                axios.post('/api/messages', {
                    'to': this.recipient.id,
                    'subject': subject,
                    'content': content,
                }).then((response) => {
                    this.toast .success({
                        title: 'Éxito!',
                        message: 'Mensaje enviado con éxito',
                        delay: 5000
                    });
                }).catch(error => {
                    this.toast .error({
                        title: 'Error!',
                        message: error.response.data.message,
                        delay: 5000
                    });
                });
            },
            writeMessageTo(user) {
                this.recipient = user;
            }
        },
        components: { UserList, Editor }
    };
</script>

<template>
    <div>
        <FlashToast :position="'bottom-right'" v-zIndex:3000 v-class:any-class />
        <router-view></router-view>
    </div>
</template>

<script>
    import { inject } from 'vue'

    export default {
        data() {
            return {
                user: {},
            }
        },
        mounted() {

            const toast = inject('toast');

            axios.get("/api/user").then((response) => {
                this.user = response.data;
            }).catch(error => {
                toast.error({
                    title: 'Error!',
                    message: error.response.data.message,
                    delay: 5000
                });
            });
        },
    }
</script>
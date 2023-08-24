<template>
    <div class="view-messages">
        <MessageList :mailbox="'archived'"/>
    </div>
</template>

<script>
    import MessageList from '../components/MessageList.vue';

    export default {
        components: {
            MessageList,
        },
    };
</script>

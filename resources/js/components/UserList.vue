<template>
    <div class="user-list bg-gray-200 min-h-screen border-r h-screen overflow-y-scroll min-w-64">
        <ul>
            <li v-for="(user, index) in users" :key="user.id"
                @click="selectUser(index, user)"
                class="p-4 border-b font-bold text-sm cursor-pointer"
                :class="[
                    selected ===  index  && 'bg-blue-400 hover:bg-blue-400 text-white',
                    selected !==  index  && 'hover:bg-gray-300'
                ]"
            >
                <p>{{ user.name }}</p>
                <p>{{ user.email + user.id + selected }}</p>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            users: {
                type: Array,
                default: [],
            },
        },
        data() {
            return {
                selected: 0
            };
        },
        methods: {
            selectUser(index, user) {
                this.selected = index;
                this.$emit('selected', user);
            }
        }
    }
</script>
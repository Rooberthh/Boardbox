<template>
    <div class="relative mr-3" v-if="notifications.length">
        <div role="button" @click="open = !open">
            <i class="fas fa-exclamation-circle text-xl"></i>
        </div>
        <div class="absolute pin-l mt-px" v-show="open">
            <div class="bg-white shadow rounded border overflow-hidden" v-for="notification in notifications">
                <a class="no-underline block px-4 py-3 border-b text-grey-darkest bg-white hover:text-white hover:bg-blue whitespace-no-wrap"
                   :href="notification.data.link"
                   v-text="notification.data.message"
                   @click="markAsRead(notification)"
                >
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                open: false,
                notifications: {}
            }
        },
        created() {
            axios.get('/me/notifications')
                .then(response =>{
                    this.notifications = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        methods: {
            markAsRead(notification) {
                axios.delete('/me/notifications/' + notification.id)
            }
        }
    }
</script>

<style scoped>

</style>

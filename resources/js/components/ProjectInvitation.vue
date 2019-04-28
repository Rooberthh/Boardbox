<template>
    <div class="card mt-8">
        <h3 class="text-grey-darker text-xl font-normal mb-3">Invite a User</h3>
            <input type="email"
                   placeholder="user@email.com"
                   name="email"
                   id="email"
                   class="input focus:outline-none focus:shadow-outline"
                   v-model="email"
            >
            <span class="text-red text-xs italic" role="alert" v-if="errors.message">
                <strong v-text="errors.message"></strong>
            </span>

            <button @click="invite()" class="btn btn-blue my-2 flex ml-auto">Invite</button>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {

        data() {
            return {
                email: '',
                errors: {}
            }
        },
        methods: {
            invite() {
                axios.post(location.pathname + '/invite', {email: this.email})
                    .then(response => {
                        this.errors = {};

                        location.reload();
                    })
                    .catch(errors => {
                        this.errors = errors.response.data;
                    })
            }
        }
    }
</script>

<style scoped>

</style>

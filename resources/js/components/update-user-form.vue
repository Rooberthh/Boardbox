<template>
    <div class="lg:w-3/4 my-4">
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input class="input focus:outline-none focus:shadow-outline" id="email" type="email" name="email" v-model="form.email">
            <span class="text-red text-xs italic" role="alert" v-if="errors.email">
                <strong v-text="errors.email[0]"></strong>
            </span>
        </div>

        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                Username
            </label>
            <input class="input focus:outline-none focus:shadow-outline" id="username" type="text" name="name" v-model="form.name">
            <span class="text-red text-xs italic" role="alert" v-if="errors.name">
                <strong v-text="errors.name[0]"></strong>
            </span>
        </div>

        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input class="input focus:outline-none focus:shadow-outline" id="password" type="password" name="password" v-model="form.password">
            <span class="text-red text-xs italic" role="alert" v-if="errors.password">
                <strong v-text="errors.password[0]"></strong>
            </span>
        </div>

        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="password_confirmation">
                Password Confirmation
            </label>
            <input class="input focus:outline-none focus:shadow-outline" id="password_confirmation" type="password" name="password_confirmation" v-model="form.password_confirmation">
        </div>

        <button type="button" class="btn btn-blue" @click="update()">Update Profile</button>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['user'],
        data() {
            return {
                form: {
                    email: this.user.email,
                    name: this.user.name,
                    password: '',
                    password_confirmation: ''
                },
                errors: {}
            }
        },
        methods: {
            update() {
                axios.patch('/me', this.form)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    })
            }
        }
    }
</script>

<style scoped>

</style>

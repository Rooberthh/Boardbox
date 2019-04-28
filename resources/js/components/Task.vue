<template>
    <div class="card mb-3">

            <div class="flex items-center">
                <input type="text" class="text-default w-full" name="body" v-model="form.body">


                <input type="checkbox" name="completed" v-model="form.completed" @change="update()">

                <i v-if="canUpdate" class="fas fa-trash" @click="remove()"></i>
            </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['task'],
        data() {
            return {
                id: this.task.id,
                form: {
                    body: this.task.body,
                    completed: this.task.completed,
                },
                creator: this.task.creator,
                endpoint: location.pathname + '/tasks/' + this.task.id,
            }
        },
        methods: {
            update() {
                axios.patch(this.endpoint, this.form)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            remove() {
                axios.delete(this.endpoint, this.id)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });

                this.$emit('deleted');
            }
        },
        computed: {
            canUpdate(){
                return this.authorize(user => this.creator === user.id);
            }
        }
    }
</script>

<style scoped>
    .fa-trash {
        @apply .ml-3;
        cursor: pointer;
        color: #444;
    }
</style>

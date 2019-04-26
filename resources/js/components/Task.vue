<template>
    <div class="bg-white rounded shadow p-4 mb-3">

            <div class="flex items-center">
                <input type="text" class="text-default w-full" name="body" v-model="form.body">

                <input type="checkbox" name="completed" v-model="form.completed" @change="update()">
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
                endpoint: location.pathname + '/tasks/' + this.task.id
            }
        },
        methods: {
            update() {
                axios.patch(this.endpoint, this.form)
                    .catch(error => {
                        console.log(error);
                    })
                    .then(response => {
                        console.log(response.data);
                    });
            }
        }
    }
</script>

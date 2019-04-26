<template>
    <div>
        <div v-for="(task, index) in items">
            <task :task="task" @deleted="remove(index)" :key="task.id"></task>
        </div>

        <div>
            <new-task :endpoint="endpoint" @created="add"></new-task>
        </div>
    </div>
</template>

<script>
    import collection from '../mixins/Collection';
    import task from './Task.vue';
    import axios from 'axios';
    import NewTask from "./NewTask";

    export default {
        components: {
            task,
            NewTask
        },
        mixins: [collection],
        data() {
            return {
                dataSet: false,
                endpoint: location.pathname + '/tasks'
            }
        },
        created(){
          this.fetch();
        },
        methods: {
            fetch(){
                axios.get('/api' + location.pathname + '/tasks')
                    .then(this.refresh)
            },
            refresh({data}){
                this.dataSet = data;
                this.items = data;

                window.scrollTo(0,0);
            }
        }
    }
</script>

<style scoped>

</style>

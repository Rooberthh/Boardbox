<script>
    import tasks from '../components/Tasks';
    import axios from 'axios';

    export default {
        props: ['project'],
        components: { tasks },
        data() {
            return {
                editing: false,
                form: {
                    description: this.project.description,
                    title: this.project.title
                },
                completed: this.project.completed
            }
        },
        methods: {
            edit() {
                this.editing = !this.editing;
            },

            update() {
                axios.patch(location.pathname, this.form)
                    .then(response => {
                        this.editing = false;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            destroy() {
                axios.delete(location.pathname)
                    .catch(error => {
                        console.log(error)
                    });
            },
            togglePin() {
                axios[this.completed ? "delete" : "post"](this.pinnedEndpoint);

                this.completed = !this.completed;
            }
        },
        computed: {
            pinnedEndpoint() {
                return location.pathname + '/complete'
            }
        }
    }
</script>

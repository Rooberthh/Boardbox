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
                }
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
            }
        }
    }
</script>

<template>
    <div class="card p-2  mb-3">
        <form @submit.prevent="addTask">
            <input type="text" placeholder="Add a new Task..." class="text-default w-full leading-loose" name="body" v-model="body">
        </form>
    </div>
</template>

<script>
    export default {
      props: ['endpoint'],
        data() {
          return {
              body: '',
              completed: false
          }
        },
        methods: {
          addTask() {
              axios.post(this.endpoint, {body: this.body})
                  .catch(error => {
                      console.log(error.response.data);
                  })
                  .then(({data}) => {
                      this.body = '';
                      this.completed = true;

                      this.$emit('created', data)
                  });
          }
        }
    }
</script>


<template>
  <form v-on:submit.prevent="handleSubmit">
    <div v-if="error" class="alert alert-danger">
      {{ error }}
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" v-model="email" class="form-control" id="exampleInputEmail1"
             aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" v-model="password" class="form-control"
             id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">I like cheese</label>
    </div>
    <button type="submit" class="btn btn-primary" v-bind:class="{ disabled: isLoading }">Log in</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      password: '',
      error: '',
      isLoading: false
    }
  },
  props: ['user'],
  methods: {
    handleSubmit() {
      this.isLoading = true;
      this.error = '';

      console.log(JSON.stringify({
        email: this.email,
        password: this.password
      }));

      fetch('/api/login', {
        method: 'POST',
        body: JSON.stringify({
          "email": this.email,
          "password": this.password
        }),
        headers: {'Content-Type': 'application/json'}
      })
          .then(res => res.json())
          .then(res => {
             console.log(res);
            if(res.error) this.error = res.error;
          })
          .catch(error => {
            this.error = "Unknown error";
            console.log(error);
          })
          .finally(()=>{
            this.isLoading = false;
          });


/*      axios
          .post('/login', {
            email: this.email,
            password: this.password
          })
          .then(response => {
            console.log(response.data);
            //this.$emit('user-authenticated', userUri);
            //this.email = '';
            //this.password = '';
          }).catch(error => {
        console.log(error.response.data);
      }).finally(() => {
        this.isLoading = false;
      })*/
    },
  },
}
</script>
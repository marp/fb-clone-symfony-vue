<template>
  <h2>{{profile.firstName + ' ' + profile.lastName }}</h2>
  <ul>
    <li v-for="post in profile.posts">{{post.content}}</li>
  </ul>
  <p>$route.params.id: {{$route.params.id}}</p>
</template>

<script>
export default {
  name: 'ProfilePage',
  data() {
    return{
      profile: {
        'firstName' : '',
        'lastName' : '',
        'posts' : []
      }
    }
  },
  mounted() {
    fetch('/api/users/' + this.$route.params.id + '.json')
        .then(res => res.json())
        .then((res) => {
          this.profile = res;
          console.log(res);
        })

  }
}
</script>
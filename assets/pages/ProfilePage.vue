<template>
  <h2>{{profile.Name + ' ' + profile.SurName }}</h2>
  <ul>
    <li v-for="post in profile.posts">{{post.Content}}</li>
  </ul>
  <p>$route.params.id: {{$route.params.id}}</p>
</template>

<script>
export default {
  name: 'ProfilePage',
  data() {
    return{
      profile: {
        'Name' : '',
        'SurName' : '',
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
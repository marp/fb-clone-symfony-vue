<template>
  <h2>{{profile.name + ' ' + profile.surname }}</h2>
  $route.params.id: {{$route.params.id}}
</template>

<script>
export default {
  name: 'ProfilePage',
  data() {
    return{
      profile: {
        'name' : 'Jan',
        'surname' : 'Kowalski',
      }
    }
  }
}
</script>
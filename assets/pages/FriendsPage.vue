<template>
<ul>
<li v-for="friend in friends">
  {{ friend }}
</li>
</ul>
</template>

<script>
export default {
  name: 'FriendsPage',
  data(){
    return{
      friends: ['ABC2', 'ABC3']
    }
  }
}
</script>
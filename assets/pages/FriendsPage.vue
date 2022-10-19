<template>
  Lista wszystkich możliwych:
      <profile-preview v-for="friend in friends" :user="friend" :user_id="friend.user_id"/>
      <br>
</template>

<script>
import ProfilePreview from "../components/ProfilePreview";
export default {
  name: 'FriendsPage',
  components:{
    'ProfilePreview': ProfilePreview
  },
  data(){
    return{
      friends: [
          {name: 'Arnold', surname: 'Boczek', id: 1, user_id: 3},
          {name: 'Jan', surname: 'Kowalski', id: 3, user_id: 1}
      ]
    }
  }
}
</script>
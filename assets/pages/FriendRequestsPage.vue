<template>
  List of friend requests:
    <ul>
      <li v-for="fr in friendRequests">
        {{ fr.dateTime }} - {{ fr.sender }} sent you an invitation
      </li>
    </ul>
</template>

<script>
export default {
  name: 'FriendRequestsPage',
  components: {
  },
  data(){
    return {
      friendRequests: ['Somebody', 'Kowalski'],
    }
  },
  mounted() {
      fetch('/api/friend_requests.json')
        .then(result => result.json())
        .then((result) => {
          console.log(result)
          this.friendRequests = result;
        })

  }
}
</script>
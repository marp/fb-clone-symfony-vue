<template>
  <div>
    <div style="font-weight: bold;">
      <router-link :to="{ name: 'profile', params: { id: user.id }}">{{user.firstName}} {{user.lastName}}</router-link>
    </div>
    <div>
      <button @click="sendFriendRequest">Send friend request</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProfilePreview',
  props: [
      'user',
      'user_id',
  ],
  methods:{
    'sendFriendRequest': function (){
      fetch('/api/friend_requests', {
        method: 'POST',
        body: JSON.stringify({
          // "sender": this.user_id,
          "receiver": "/api/users/"+this.user.id
        }),
        headers: { 'Content-Type': 'application/json' }
      })
          // .then(res => res.json())
          // .then(res => {
          //   // console.log(res)
          //   this.getAllPosts();
          // });
    }
  }
}
</script>

<style>
div{
  background-color: darkgray;
  border: 1px solid black;
}
</style>
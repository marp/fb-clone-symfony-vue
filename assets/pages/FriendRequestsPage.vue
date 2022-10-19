<template>
  List of friend requests:
    <ul>
      <li v-for="fr in friendRequests">
        {{ fr.dateTime }} - {{ fr.sender }} sent you an invitation <button @click="acceptInvitation(fr)">ACCEPT</button><button @click="cancelInvitation(fr)">DENY</button>
      </li>
    </ul>
</template>

<script>
import axios from 'axios';

export default {
  name: 'FriendRequestsPage',
  components: {
  },
  data(){
    return {
      friendRequests: [],
    }
  },
  mounted() {
    this.fetchFriendRequests();
  },
  methods: {
    fetchFriendRequests(){
      fetch('/api/friend_requests.json')
          .then(result => result.json())
          .then((result) => {
            console.log(result)
            this.friendRequests = result;
          })
    },
    cancelInvitation(friendRequestObject){
      axios.delete('/api/friend_requests/' + friendRequestObject.id)
          .then(()=>{
            this.fetchFriendRequests();
          }).catch((error)=>{
            if(typeof error.response.data["hydra:title"] !== 'undefined'){
              alert(error.response.data["hydra:title"] + '\n' + error.response.data["hydra:description"]);
            }else{
              alert("An error occurred.");
              console.log(error.response);
            }
          })
    },
    acceptInvitation(){
      // axios.post('/api/')
      axios.delete('/api/friend_requests/' + friendRequestObject.id)
          .then(()=>{
            this.fetchFriendRequests();
          }).catch((error)=>{
        if(typeof error.response.data["hydra:title"] !== 'undefined'){
          alert(error.response.data["hydra:title"] + '\n' + error.response.data["hydra:description"]);
        }else{
          alert("An error occurred.");
          console.log(error.response);
        }
      })
    }
  }
}
</script>
<template>
  You have {{ friends.length }} friends { <span v-for="friend in friends">{{ friend.surName + ' ' + friend.name }}</span> }.
  <hr>
  Dodaj nowy post:
  <input type="text" v-model="newPostInputText"/>
  <button @click="sendNewPost">Send</button>
  <hr>
<!--  <ul>-->
<!--    <li v-for="post in posts">{{ post.Content }} by {{ post.author }} {{ post.date }}</li>-->
<!--  </ul>-->
</template>

<script>
import post from "../components/post";
export default {
  components: {
    'post': post
  },
  name: 'HomePage',
  data(){
    return{
      posts: [],
      friends: [],
      newPostInputText: ''
    }
  },
  mounted() {
    this.getAllPosts();
  },
  methods:{
    sendNewPost( event ){
      fetch('/api/posts', {
        method: 'POST',
        body: JSON.stringify({
          'Content':this.newPostInputText,
          // 'content':this.newPostInputText,
        }),
        headers: { 'Content-Type': 'application/json' }
      })
          .then(res => res.json())
          .then(res => {
            // console.log(res)
            this.getAllPosts();
            this.newPostInputText = "";
          });
    },
    getAllPosts(){
      fetch('/api/posts.json')
          .then(res => res.json())
          .then(res => {this.posts = res});
    }
  }
}
</script>
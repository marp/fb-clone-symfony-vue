<template>
  You have {{ friends.length }} friends.

  <input type="text" v-model="newPostInputText"/>
  <button @click="sendNewPost">Send</button>

  <hr>
  <ul>
    <li v-for="post in posts">{{ post.content }} by {{ post.author }} {{ post.date }}</li>
  </ul>
</template>

<script>
export default {
  name: 'HomePage',
  data(){
    return{
      posts: [],
      friends: ['ABC', 'XYZ'],
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
          'content':this.newPostInputText,
          'date' : "2022-10-02T17:22:42.711Z",
          'Author' : "api/users/1",
          'author' : "api/users/1",
        }),
        headers: { 'Content-Type': 'application/json' }
      })
          .then(res => res.json())
          .then(res => {
            // console.log(res)
            this.getAllPosts();
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
<template>
  <input id="search" v-model="searchInputText">
  <button @click="search">Search</button>

  <post v-for="post in posts" :id="post.id" :author="post.author" :content="post.content" :date="post.date"/>
  <p v-if="!posts.length">No results.</p>
</template>

<script>
import post from "../components/post";

export default {
  name: 'ProfilePage',
  components: {
    'post': post
  },
  data() {
    return{
      profile: {
        'searchInputText' : '',
      },
      posts: [],
    }
  },
  methods: {
    search() {
      fetch('/api/posts.json?content=' + this.searchInputText)
          .then(res => res.json())
          .then(res => {
            this.posts = res
            console.log(res);
          });
    },
  }
}
</script>
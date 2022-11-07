<template>
<!--  <sidebar-component />-->
<!--  <Sidebar/>-->
  <div>
    FB
    <router-link to="/">Go to Home</router-link> |
    <router-link to="/friends">your friends</router-link> |
    <router-link to="/friend_requests">friend requests</router-link> |
    <router-link to="/search">search</router-link> |
    <a href="/api" target="_blank">API</a> |
<!--    <router-link to="/test">test</router-link> |-->

    <span v-if="id === 'null'">
      <router-link to="/login">Login</router-link> |
      <a href="/register">Register</a> |
    </span>

    <span v-if="id !== 'null'">Logged in as: <i><router-link :to="{ name: 'profile', params: { id: id }}">{{ firstName + ' ' + lastName }}</router-link></i> <a href="/logout">[Log out]</a></span>
  </div>

  <hr>
  <div>
    <router-view></router-view>
  </div>
<!--  <HelloWorld msg="Welcome to Your Vue.js App"/>-->
<!--  <SidebarComponent/>-->
  <hr>
  FB-CLONE-SYMFONY-VUE &copy; 2022
</template>

<script>
// import SidebarComponent from './../components/sidebar.vue';
// import Sidebar from "../components/sidebar.vue";
// import HelloWorld from './../components/HelloWorld.vue'

export default {
  name: 'Products',
  // components: {
  //   HelloWorld,
  //   SidebarComponent
  // },
  data(){
    return {
      id : sessionStorage.getItem('userId'),
      firstName : sessionStorage.getItem('userFirstName'),
      lastName : sessionStorage.getItem('userLastName'),
      searchInputText: ''
    }
  },
  methods: {
    search(){
      fetch('/api/posts/?content='+this.searchInputText)
          .then(res => res.json())
          .then(res => {this.posts = res});
    },
  }
}
</script>

<style>
body{
  color: green;
}
</style>
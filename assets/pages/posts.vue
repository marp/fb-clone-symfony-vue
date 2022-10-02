<template>
<!--  <sidebar-component />-->
<!--  <Sidebar/>-->
  <div>
    <router-link to="/">Go to Home</router-link> |
    <router-link to="/friends">your friends</router-link> |
    <router-link to="/friend_requests">friend requests</router-link> |
<!--    <router-link to="/test">test</router-link> |-->
    <a href="/login">Logowanie</a> |
    <a href="/register">Rejestracja</a> |
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
import SidebarComponent from './../components/sidebar.vue';
// import Sidebar from "../components/sidebar.vue";
import HelloWorld from './../components/HelloWorld.vue'

export default {
  name: 'Products',
  components: {
    HelloWorld,
    SidebarComponent
  },
  data(){
    return {
      firstName: 'Ryan',
    }
  }
}
</script>
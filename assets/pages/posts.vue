<template>
<!--  <sidebar-component />-->
<!--  <Sidebar/>-->
  <HelloWorld msg="Welcome to Your Vue.js App"/>
  <h1>Hello {{ firstName }}!</h1>
  <SidebarComponent/>
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
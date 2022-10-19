import { createApp } from 'vue'
import { createRouter, createWebHistory } from "vue-router";
import App from './pages/Main.vue'

//PAGES
import HomePage from './pages/HomePage'
import FriendsPage from './pages/FriendsPage'
import FriendRequestsPage from './pages/FriendRequestsPage'
import ProfilePage from './pages/ProfilePage'
import SearchPage from './pages/SearchPage'
//COMPONENTS
import LoginForm from './components/LoginForm'

const routes = [
    { path: '/', component: HomePage },
    { path: '/friends', component: FriendsPage },
    { path: '/friend_requests', component: FriendRequestsPage },
    { path: '/@:id', name:'profile', component: ProfilePage },
    { path: '/search', name:'search', component: SearchPage },
    { path: '/login', component: LoginForm },
    // { path: '/test', component: About },
];

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

createApp(App).use(router).mount('#app');

window.app = app;
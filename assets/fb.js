import { createApp } from 'vue'
import { createRouter, createWebHashHistory } from "vue-router";
import App from './pages/posts.vue'

//PAGES
import HomePage from './pages/HomePage'
import FriendsPage from './pages/FriendsPage'
import FriendRequestsPage from './pages/FriendRequestsPage'
import ProfilePage from './pages/ProfilePage'

const routes = [
    { path: '/', component: HomePage },
    { path: '/friends', component: FriendsPage },
    { path: '/friend_requests', component: FriendRequestsPage },
    { path: '/@:id', component: ProfilePage },
    // { path: '/test', component: About },
];

const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHashHistory(),
    routes, // short for `routes: routes`
})

createApp(App).use(router).mount('#app');

window.app = app;
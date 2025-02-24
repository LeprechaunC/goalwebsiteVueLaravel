 import LoginView from '../views/LoginView.vue';
import RegisterView from '../views/RegisterView.vue';
import ForgotPassword from '@/components/ForgotPassword.vue';
import NotFound from "@/views/errors/NotFoundView.vue";
import HomePage from "@/views/HomePage.vue";
import Admin from "@/views/Admin.vue";
import GoalsPage from '@/views/GoalsPage.vue';
import GoalDetails from '@/views/GoalDetails.vue';

const routes = [ 
    { path: '/', name: 'home', component: HomePage },
    { path: '/about', name: 'about', component: () => import('../views/AboutView.vue') },
    { path: '/login', name: 'login', component: LoginView },
    { path: '/forgot-password', name: 'forgot-password', component: ForgotPassword },
    { path: '/register', name: 'register', component: RegisterView },
    { path: '/admin', name: 'admin', component: Admin },
    { path: '/:catchAll(.*)', name: 'NotFound', component: NotFound},
    {path: '/goals', name: 'goals', component: GoalsPage},
    { path: '/goal/:id', component: GoalDetails, props: true }, // Dynamic goal page
]
    
export default routes;
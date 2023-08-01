import Vue from 'vue'
import VueRouter from 'vue-router';
import Vuex from "vuex";
import store from '../vuex/store'
import ActivietiesComponent from '../components/site/ActivitiesComponent.vue'
import ActivieCreate from '../components/site/ActivitieCreateComponent.vue'
import ActivitiesDetails from '../components/site/ActivitiesDetailsComponent.vue'
import ActivitieEditComponent from '../components/site/ActivitieEditComponent.vue'
import RegisterComponent from '../components/auth/RegisterComponent.vue'
import ActividadesComponent from '../components/ActividadesComponent.vue'
import mainComponent from '../components/MainComponent.vue'
import Login from '../components/auth/Login.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Login,
        name: 'login'
    },
    {
        path: '/register',
        component: RegisterComponent,
        name: 'register'
    }
    ,{
        path: '/atividades',
        component: mainComponent,
        meta: {auth: true},
        children: [
            {
                path: '/atividades',
                component: ActivietiesComponent,
                name: 'activities'
            },
            {
                path: '/atividades/create',
                component: ActivieCreate,
                name: 'creatte.activite'
            },
            {
                path: '/atividades/:id/detalhes',
                component: ActivitiesDetails,
                name: 'details.activitie',
                props: true 
            },
            {
                path: '/atividades/:id/edit',
                component: ActivitieEditComponent,
                name: 'edit.activitie',
                props: true 
            }
        ]
    
        
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
	const userAuthenticated = store.state.Auth.authenticated
    if(to.matched.some(record => record.meta.auth)) {
      if (userAuthenticated) {
        next()
        return
      }
      next('/')
    } else {
      next()
    }
})

export default router
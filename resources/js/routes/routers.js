import Vue from 'vue'
import VueRouter from 'vue-router';
import Vuex from "vuex";
import ActivietiesComponent from '../components/site/ActivitiesComponent.vue'
import ActivieCreate from '../components/site/ActivitieCreateComponent.vue'
import ActivitiesDetails from '../components/site/ActivitiesDetailsComponent.vue'
import ActivitieEditComponent from '../components/site/ActivitieEditComponent.vue'
import ActividadesComponent from '../components/ActividadesComponent.vue'
import mainComponent from '../components/MainComponent.vue'
import Login from '../components/auth/Login.vue'

Vue.use(VueRouter)

const routes = [
    {
    
        path: '/',
        component: mainComponent,
        children: [
            {
                path: '/',
                component: Login,
                name: 'login'
            },
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


export default router
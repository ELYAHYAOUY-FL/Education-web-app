import { createWebHistory , createRouter} from "vue-router";

import AdministrationPage from './src/pages/AdministrationPage.vue'
import studentPage from './src/pages/ElevePage.vue'
import parentPage from './src/pages/ParentsPage.vue'
import   professeurPage from './src/pages/ProfesserPage.vue'
import   AcuillePage from './src/pages/AcuillePage.vue'


const routes =[ 

    {
        path: '/',
        redirect: '/home'
      },
      {
        path: '/home',
        component: AcuillePage
      },
    {
    path : '/Administration',
   name :'Admin',
   component : AdministrationPage
},

{
    path : '/Student',
   name :'Eleve',
   component : studentPage
},
{
    path : '/professeur',
   name :'Prof',
   component : professeurPage
},
{

    path :'/parent',
    name :'parent',
   component :parentPage
}
];

const router  =createRouter({
    history : createWebHistory(),
    routes
});

export default router;


import { createWebHistory , createRouter} from "vue-router";

import AdministrationPage from './src/pages/AdministrationPage.vue'
import studentPage from './src/pages/ElevePage.vue'
import parentPage from './src/pages/ParentsPage.vue'
import   professeurPage from './src/pages/ProfesserPage.vue'
import   AcuillePage from './src/pages/AcuillePage.vue'
// import EtudiantListAdmin from './Page/NiveauScolaire/index.vue'
// admin import
import  NiveauListAdmin from './Page/NiveauScolaire/index.vue';
import EtudiantListAdmin from './Page/Etudiant/index.vue';
import EtudiantCreatAdmin from './Page/Etudiant/Create.vue';

 //import ProfesseurListAdmin from './Page/Professeur/index';
 import ProfesseurListAdmin from './Page/Professeur/index.vue';
 import ProfesseurcreateAdmin from './Page/Professeur/Create.vue';
//  import ProfesseurEditAdmin from './Page/Professeur/Edit.vue';

//cantine
import CantinePageadmin from './Page/Cantine/index.vue'
 
//parent
import ParentListAdmin from './Page/Parent/index.vue';
import ParentCreatAdmin from './Page/Parent/create.vue';

//Activity
import ActivitieyFormAdmin from './Page/Activitie/ActivityForm.vue'
import ActvityListAdmin from './Page/Activitie/ActivityList.vue'

//Textbook
import textbookProf from './PageProfesseur/Textbook/index.vue'

//login 
import  LoginPage from './src/pages/Login.vue';
import store  from '@/store';
const routes =[ 

    {
        path: '/',
        redirect: '/home',
        
      },
      {
        path: '/login' ,
        name: 'Login',
        component: LoginPage
      },

      {
        path: '/home',
        component: AcuillePage,meta: {guest:true}
      },
    {
    path : '/Administration',
   name :'Admin',
   component : AdministrationPage,
   meta: {requiresAuth:true}
},
{
  path : '/professeur',
 name :'Prof',
 component : professeurPage,
 meta: {requiresAuth:true ,  professeur: true},


},
{

  path :'/parent',
  name :'parent',
 component :parentPage
},

{
    path : '/Student',
   name :'Eleve',
   component : studentPage
},
// **********************admin router *********************
// student path 
{
  path : '/StudentPageadmin',
  name :'ElevePageadmin',
  component : EtudiantListAdmin
},
{
  path : '/StudentCreatadmin',
  name :'EtudiantCreatAdmin',
  component : EtudiantCreatAdmin
  },


  // niveau Scolaire Path 
{
path : '/NiveauPageadmin',
name : 'NiveauListAdmin',
component : NiveauListAdmin
},


//  prof path 
{
  path : '/ProfesseurPageadmin',
  name :'ProfPageadmin',
  component : ProfesseurListAdmin
},
{
  path : '/ProfesseurCreatePageadmin',
  name :'ProfcretePageadmin',
  component : ProfesseurcreateAdmin
},
// {
//   path : '/ProfesseurEditPageadmin',
//   name :'ProfEditPageadmin',
//   component : ProfesseurEditAdmin
// },
//  parent  path 
{
  path : '/ProfesseurPageadmin',
  name :'ProfPageadmin',
  component : ProfesseurListAdmin
},
{
  path : '/ProfesseurCreatePageadmin',
  name :'ProfcretePageadmin',
  component : ProfesseurcreateAdmin
},
//cantine
{
  path : '/CantinePageadmin',
  name :'CantPageadmin',
  component : CantinePageadmin
},
 
//activity
 
{
  path : '/ActivitieyFormAdmin',
  name :'ActivitieyFormAdmin',
  component :ActivitieyFormAdmin
},
{
  path : '/ActvityListAdmin',
  name :'ActvityListAdmin',
  component :ActvityListAdmin
},
// ParentAdmin
{
  path : '/ParentListAdmin',
  name :'parentListAdmin',
  component :ParentListAdmin
},
{
  path : '/ParentCreatAdmin',
  name :'parentCreatAdmin',
  component :ParentCreatAdmin
},

//Textbook
{
  path : '/textbookProf',
  name :'texbookProf',
  component :textbookProf,
  meta: {requiresAuth:true ,  professeur: true}
},
 


];

const router  =createRouter({
    history : createWebHistory(),
    routes
});
router.beforeEach((to, from, next) => {
  // set document title
  // document.title = `${to.meta.title} - ${store.getters['appName']}`
  const user_type = store.getters['auth/user_type']
  if(to.matched.some(route => route.meta.guest) && store.getters['auth/isLogged']) {
    if(store.getters['auth/user_type'] ==='professeur') 
        return next("/professeur").isLogged
  }
  if (to.matched.some(route => route.meta.requiresAuth)) {
    //  check if logged in if not, redirect to SignIn page.
    if(!store.getters['auth/isLogged']) {
      next({ name: 'Login' })
    }else{ 
      //check if page require admin user and user is admin
      if(store.getters['auth/user_type'] !=='professeur' && to.matched.some(route => route.meta.professeur)){
        return next('/login')
      }  
      // //check if page require entreprise user and user is entreprise
      // if(store.getters['auth/user_type'] !=='entreprise' && to.matched.some(route => route.meta.company)){
      //   return next('/error/401')
      // }   
      // //check if page require livreur user and user is livreur
      // if(store.getters['auth/user_type'] !=='livreur' && to.matched.some(route => route.meta.delivery)){
      //   return next('/error/401')
      // }
    next()
    }
  } else {
    next() 
  }

})

export default router;
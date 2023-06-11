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
 import Cantine from './PageEleve/Cantine.vue'
//parent
import ParentListAdmin from './Page/Parent/index.vue';
import ParentCreatAdmin from './Page/Parent/create.vue';
// notes
import GestionNoteEleveAdmin from './Page/gestion des note/Notes.vue'
//Activity
import ActivitieyFormAdmin from './Page/Activitie/ActivityForm.vue'
import ActvityListAdmin from './Page/Activitie/ActivityList.vue'
import Activity from './PageEleve/Activity.vue'
// ********************************professeur importing 
//Textbook
import textbookProf from './PageProfesseur/Textbook/index.vue'
//groupes
import Groupes from './PageProfesseur/niveau scolaire/gestionGreoupes.vue'
//Textbook
// import textbookProf from './PageProfesseur/Textbook/index.vue'
//Calendrie
import Calendrie from './PageProfesseur/calendarPag.vue'
import Calend from './PageEleve/calendarEleve.vue'
import Calendr from './src/pages/calendarAdmin.vue'

//Emploi Temps 
import EmploisTemps from './Page/EmploiTemps/Emploicreate.vue'
import Emploi from './PageEleve/Emploicreate.vue'
import EmploiProf from './PageProfesseur/Emploi.vue'
//login 
import  LoginPage from './src/pages/Login.vue';
import store  from '@/store';

//eleve
import HomeELEVE from './PageEleve/home.vue'
import NoteELEVE from './PageEleve/note.vue'

//paiement 
import paiementparent from './Page/Paiement/payementParent.vue'
import paiementprofesseur from './Page/Paiement/payementProfesseur.vue'
//  import Matiere from './Page/Matiere.vue'
 //matiere
import Matiere from './Page/Matiere.vue'
import ParenteleveDEtails from './PageParent/EleveDetails.vue'

//parent eleves
import MenulayoutEleve from './Layouts/MenuLayoutEleve.vue'
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
        component: AcuillePage,
        meta: {guest:true}
      },
    {
    path : '/Administration',
   name :'Admin',
   component : AdministrationPage,
   meta: {requiresAuth:true , administration:true}
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
 component :parentPage,
 meta: {requiresAuth:true, parent:true}

},

{
    path : '/Student',
   name :'Eleve',
   component : studentPage,
   meta: {requiresAuth:true ,eleve:true}

},
// **********************admin router *********************
// student path 
{
  path : '/Administration/Student',
  name :'ElevePageadmin',
  component : EtudiantListAdmin,
  meta: {requiresAuth:true , administration:true}

},
{
  path : '/Administration/StudentCreat',
  name :'EtudiantCreatAdmin',
  component : EtudiantCreatAdmin,
  meta: {requiresAuth:true , administration:true}

  },
//matier
{
  path : '/Administration/Matiere',
  name : 'MatiereAdmin',
  component : Matiere,
  meta: {requiresAuth:true , administration:true}
  
  },

//   //matier
// {
//   path : '/Administration/Matiere',
//   name : 'MatiereAdmin',
//   component : Matiere,
//   meta: {requiresAuth:true , administration:true}

//   },

  // niveau Scolaire Path 
{
path : '/Administration/NiveauScolaire',
name : 'NiveauListAdmin',
component : NiveauListAdmin,
meta: {requiresAuth:true , administration:true}

},

//Paiement
{
  path : '/Administration/paiementparent',
  name :'paiementparent',
  component :paiementparent ,
  meta: {requiresAuth:true , administration:true}


},
{
  path : '/Administration/paiementprofesseur',
  name :'paiementprofesseur',
  component :paiementprofesseur ,
  meta: {requiresAuth:true , administration:true}

},

{
path : '/Administration/gestionDesNote',
name : 'NotestAdmin',
component :GestionNoteEleveAdmin ,
meta: {requiresAuth:true , administration:true}

},


//  prof path 
{
  path : '/Administration/Professeur',
  name :'ProfPageadmin',
  component : ProfesseurListAdmin,
  meta: {requiresAuth:true , administration:true}

},
{
  path : '/Administration/ProfesseurCreat',
  name :'ProfcretePageadmin',
  component : ProfesseurcreateAdmin ,
  meta: {requiresAuth:true , administration:true}

},


// ParentAdmin
{
  path : '/Administration/Parent',
  name :'parentListAdmin',
  component :ParentListAdmin ,
  meta: {requiresAuth:true , administration:true}

},
{
  path : '/Administration/ParentCreat',
  name :'parentCreatAdmin',
  component :ParentCreatAdmin,
  meta: {requiresAuth:true , administration:true}

},

//cantine
{
  path : '/Administration/Cantine',
  name :'CantPageadmin',
  component : CantinePageadmin ,
  meta: {requiresAuth:true , administration:true}

},
{
  path : '/eleve/Cantine',
  name :'Cantine',
  component : Cantine  ,
  meta: {requiresAuth:true , eleve:true}

},
 
//activity
 
{
  path : '/Administration/ActivitieyForm',
  name :'ActivitieyFormAdmin',
  component :ActivitieyFormAdmin ,
  meta: {requiresAuth:true , administration:true}

},
{
  path : '/Administration/ActvityListAdmin',
  name :'ActvityListAdmin',
  component :ActvityListAdmin ,
  meta: {requiresAuth:true , administration:true}

},
{
  path : '/eleve/Activity',
  name :'Activity ',
  component :Activity  ,
  meta: {requiresAuth:true ,  eleve:true}

},
// calendrie
{
  path : '/Administration/Calendr',
  name :'Calendr',
  component :Calendr ,
  meta: {requiresAuth:true , administration:true}

},

{
  path : '/eleve/Calend',
  name :'Calendri',
  component :Calend ,
  meta: {requiresAuth:true , eleve:true}

},
//Emploi temps 
{
  path : '/Administration/EmploisTemps',
  name :'EmploisTemps',
  component :EmploisTemps ,
  meta: {requiresAuth:true , administration:true}

},
{
  path : '/eleve/Emploi',
  name :'Emploi',
  component :Emploi ,
  meta: {requiresAuth:true , eleve:true}

},


// ************************************** professeur routing  *****************************************

//Textbook
{
  path : '/professeur/textbookProf',
  name :'texbookProf',
  component :textbookProf,
  meta: {requiresAuth:true ,  professeur: true}
},
{
  path : '/parent/groupes',
  name :'groupes',
  component :Groupes,
  meta: {requiresAuth:true ,  professeur: true}
},
 
//EmploiProf

{
  path : '/professeur/EmploiProf',
  name :'emploiProf',
  component :EmploiProf,
  meta: {requiresAuth:true ,  professeur: true}
},
//calendrie 
{
  path : '/professeur/Calendrie',
  name :'Calendrie',
  component :Calendrie ,
  meta: {requiresAuth:true , professeur:true}

},


//***************************************** eleve routing ************** */
{
  path : '/student/home',
  name :'homeEleve',
  component :HomeELEVE ,
  meta: {requiresAuth:true , eleve:true}

},
{
  path : '/eleve/note',
  name :'noteEleve',
  component :NoteELEVE ,
  meta: {requiresAuth:true , eleve:true}

},

// *************************************** parent routing ***************/ 
{
  path : '/parentEleveDetails/:eleveId',
  name :'parenteleveDEtails',
  component :ParenteleveDEtails ,
  meta: {requiresAuth:true , parent:true}

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
    if(store.getters['auth/user_type'] ==='admin') 
        return next("/Administration").isLogged
    if(store.getters['auth/user_type'] ==='eleve') 
        return next("/Student").isLogged
    if(store.getters['auth/user_type'] ==='parent') 
        return next("/parent").isLogged
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
      //check if page require admin  user and user is admin
      if(store.getters['auth/user_type'] !=='admin' && to.matched.some(route => route.meta.administration)){
        return next('/login')
      }   
      if(store.getters['auth/user_type'] !=='eleve' && to.matched.some(route => route.meta.eleve)){
        return next('/login')
      }   
      if(store.getters['auth/user_type'] !=='parent' && to.matched.some(route => route.meta.parent)){
        return next('/login')
      }   
      // //check if page require livreur user and user is livreur
      // if(store.getters['auth/user_type'] !=='livreur' && to.matched.some(route => route.meta.delivery)){
      //   return next('/erxror/401')
      // }
    next()
    }
  } else {
    next() 
  }

})

export default router;
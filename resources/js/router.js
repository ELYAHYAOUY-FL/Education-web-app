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
 

//Activity
import ActivitieyFormAdmin from './Page/Activitie/ActivityForm.vue'
import ActvityListAdmin from './Page/Activitie/ActivityList.vue'

//Textbook
import textbookProf from './PageProfesseur/Textbook/index.vue'

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
  path : '/professeur',
 name :'Prof',
 component : professeurPage
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

//Textbook
{
  path : '/textbookProf',
  name :'texbookProf',
  component :textbookProf
},
 


];

const router  =createRouter({
    history : createWebHistory(),
    routes
});

export default router;
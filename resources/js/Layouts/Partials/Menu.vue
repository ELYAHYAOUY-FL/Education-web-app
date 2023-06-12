<template>
    <div>
    
    <aside class="main-sidebar slideProf" >
    
    <router-link to="/Administration" class="brand-link">
    <img src="~admin-lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="font-weight" style="color: rgb(236, 240, 240);" > EduSage </span>
    </router-link>
    
    <div class="sidebar">
    
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
    <img src="~admin-lte/dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
    <a href="#" class="d-block" style="color: rgb(236, 240, 240);" >Administration</a>
    </div>
    
    </div>
    <buttom   @click="logout" > 
                      <span>Logout</span>
            </buttom>
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
    <li class="nav-item">
       
    <router-link to="/Administration/NiveauScolaire" class="nav-link"  :class="{ active: $route.path === '/Administration/NiveauScolaire' }" >
       <i class="nav-icon fas fa-chalkboard" style="color: aliceblue;"></i>
    <p>
      Niveau scolaire
    </p>
    </router-link>
    </li>
    <!-- <li class="nav-item">
    <router-link to="/Administration/NiveauScolaire" class="nav-link"  :class="{ active: $route.path === '/Administration/NiveauScolaire' }">
       <i class="nav-icon fas fa-chalkboard" style="color: aliceblue;"></i>
    <p>
    Groupe
    </p>
    </router-link>
    </li> -->
    <!-- <li class="nav-item">
    <router-link to="/Administration/gestionDesNote" class="nav-link" :class="{ 'active': $route.path === '/Administration/gestionDesNote' }">
      <i class="fas fa-calendar" style="color: aliceblue;"></i>
    <p color="black"> Gestion des notes </p>
    </router-link>
    </li> -->
    <li class="nav-item">
    <router-link to="/Administration/Matiere" class="nav-link" :class="{ 'active': $route.path === '/Administration/Matiere' }">
       
  <i class="fas fa-globe-americas icon-small" style="color: aliceblue;"></i> 
  <i class="fas fa-scroll icon-x-large" style="color: aliceblue;"></i> 
    <p> Matière </p>
    </router-link>
    </li> 
    <!-- <li class="nav-item">
    <router-link to="/Administration/NiveauScolaire" class="nav-link"  :class="{ active: $route.path === '/Administration/NiveauScolaire' }">
       <i class="nav-icon fas fa-chalkboard" style="color: aliceblue;"></i>
    <p>
    Groupe
    </p>
    </router-link>
    </li> -->
    
    <li class="nav-item menu-close "> 
    <a href="#" class="nav-link " :class="{ 'active': $route.path.startsWith('/Student') }">
        <i class="nav-icon fas fa-users" style="color: aliceblue;"></i>
    <p>
      Étudiant
    <i class="right fas fa-angle-left" style="color: aliceblue;"></i>
    </p>
    </a>
     <ul class="nav nav-treeview">
    <li class="nav-item">
    <router-link to="/Administration/Student" class="nav-link " exact active-class="active">
    <i class="far fa-circle nav-icon" style="color: aliceblue;"></i>
    <p> Liste des  Étudiants </p>
    </router-link>
    </li>
    <li class="nav-item">
    <router-link to="/Administration/StudentCreat" class="nav-link" exact active-class="active">
    <i class="far fa-circle nav-icon" style="color: aliceblue;"></i>
    <p> Inscription</p>
    </router-link>
    </li>
    </ul> 
    </li>
    <li class="nav-item menu-close "> 
    <a href="#" class="nav-link " :class="{ 'active': $route.path.startsWith('/Student') }">
    <i class="nav-icon fas fa-users" style="color: aliceblue;"></i>
    <p>
     Professeur 
    <i class="right fas fa-angle-left"></i>
    </p>
    </a>
     <ul class="nav nav-treeview">
    <li class="nav-item">
    <router-link to="/Administration/Professeur" class="nav-link " :class="{ 'active': $route.path === '/Administration/Professeur' }">
    <i class="far fa-circle nav-icon" style="color: aliceblue;"></i>
    <p> Liste  </p>
    </router-link>
    </li>
    <li class="nav-item">
    <router-link to="/Administration/ProfesseurCreat" class="nav-link" :class="{ 'active': $route.path === '/Administration/ProfesseurCreat' }">
    <i class="far fa-circle nav-icon" style="color: aliceblue;"></i>
    <p> Inscription </p>
    </router-link>
    </li>
    </ul> 
    </li>
    <li class="nav-item menu-close "> 
    <a href="#" class="nav-link " :class="{ 'active': $route.path.startsWith('/Student') }">
    <i class="nav-icon fas fa-users" style="color: aliceblue;"></i>
    <p>
    Parent
    <i class="right fas fa-angle-left" style="color: aliceblue;"></i>
    </p>
    </a>
     <ul class="nav nav-treeview">
    <li class="nav-item">
    <router-link to="/Administration/Parent" class="nav-link " :class="{ 'active': $route.path === '/Administration/Parent' }">
    <i class="far fa-circle nav-icon" style="color: aliceblue;"></i>
    <p> tous les parents </p>
    </router-link>
    </li>
    <li class="nav-item">
    <router-link to="/Administration/ParentCreat" class="nav-link" :class="{ 'active': $route.path === '/Administration/ProfesseurCreat' }">
    <i class="far fa-circle nav-icon"></i>
    <p> ajouter parent </p>
    </router-link>
    </li>
    </ul> 
    </li>
    <li class="nav-item menu-close "> 
    <a href="#" class="nav-link " :class="{ 'active': $route.path.startsWith('/Student') }">
        <i class="nav-icon fas fa-utensils" style="color: aliceblue;"></i>
    <p>
      Cantine
    <i class="right fas fa-angle-left" style="color: aliceblue;"></i>
    </p>
    </a>
     <ul class="nav nav-treeview">
    <li class="nav-item">
    <router-link to="/Administration/Cantine" class="nav-link " :class="{ 'active': $route.path === '/Administration/Cantine' }">
    <i class="far fa-circle nav-icon" style="color: aliceblue;"></i>
    <p> Programme du semaine </p>
    </router-link>
    </li>
     
    </ul> 
    </li>
    <li class="nav-item menu-close "> 
    <a href="#" class="nav-link " :class="{ 'active': $route.path.startsWith('/Student') }">
        <i class="fas fa-futbol" style="color: aliceblue;"></i> <!-- Icône de ballon de football -->
  <i class="fas fa-paint-brush" style="color: aliceblue;"></i>
    <p>
      Activité parascolaire

    <i class="right fas fa-angle-left" style="color: aliceblue;"></i>
    </p>
    </a>
     <ul class="nav nav-treeview">
    <li class="nav-item">
    <router-link to="/Administration/ActivitieyForm" class="nav-link" :class="{ 'active': $route.path === '/Administration/ActivitieyForm' }" style="color: #4c9e9e;">
    <i class="far fa-circle nav-icon" style="color: aliceblue;"></i>
    <p> Ajoute une activité </p>
    </router-link>
    </li>
    <li class="nav-item">
    <router-link to="/Administration/ActvityListAdmin" class="nav-link" :class="{ 'active': $route.path === '/Administration/ActvityListAdmin' }">
    <i class="far fa-circle nav-icon" style="color: aliceblue;"></i>
    <p color="black">List des activité </p>
    </router-link>
    </li>    
</ul> 
    </li> 
    <li class="nav-item">
    <router-link to="/Administration/Calendr" class="nav-link" :class="{ 'active': $route.path === '/Administration/Calendr' }">
      <i class="fas fa-calendar" style="color: aliceblue;"></i>
    <p color="black"> Calendrier </p>
    </router-link>
    </li> 
      
    <li class="nav-item menu-close "> 
    <a href="#" class="nav-link " :class="{ 'active': $route.path.startsWith('/Student') }">
      <i class=" fas fa-solid fa-credit-card" style="color: #b5b7ba;"></i>
        <p>
          Paiement
    <i class="right fas fa-angle-left" style="color: aliceblue;"></i>
    </p>
    </a>
     <ul class="nav nav-treeview">
    <li class="nav-item">
    <router-link to="/Administration/paiementparent" class="nav-link" :class="{ 'active': $route.path === '//Administration/paiementparent' }">
    <i class="far fa-circle nav-icon" style="color: aliceblue;"></i>
    <p> Paiement parent</p>
    </router-link>
    </li>
    <li class="nav-item">
    <router-link to="/Administration/paiementprofesseur" class="nav-link" :class="{ 'active': $route.path === '/Administration/paiementprofesseur' }">
    <i class="far fa-circle nav-icon" style="color: aliceblue;"></i>
    <p color="black"> Paiement professeur</p>
    </router-link>
    </li>    
</ul> 
    </li>       
    <li class="nav-item">
    <router-link to="/Administration/EmploisTemps" class="nav-link" :class="{ 'active': $route.path === '/Administration/EmploisTemps' }">
      <i class="fas fa-sharp fa-solid fa-clock" style="color: aliceblue;"></i>
    <p color="black"> Emploi du temps </p>
    </router-link>
    </li>       
</ul>
    </nav>
    
    </div>
    
    </aside>
</div>
    </template>
   <script>
   import { mapGetters } from 'vuex'
   export default {
    computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },
  methods: {
    logout() {
      this.$store.dispatch('auth/logout').then(() => {
        this.$router.push('/login')
      })
    },
  },
   };
   </script>
   
<style scoped>
.slideProf{
  background-color: rgb(0, 0, 0);
}
.nav-link{
  color: #fff;
}
.nav-link :hover{
  color: #4c9e9e;
}
.nav-item :hover{
  color: #4c9e9e;
}
.active{
  color: #4c9e9e;
  background: #4c9e9e;
}
:root{
--el-menu-active-color:   rgb(76, 158, 158);

}
.nav-item{
  color: #4c9e9e;

}
</style>
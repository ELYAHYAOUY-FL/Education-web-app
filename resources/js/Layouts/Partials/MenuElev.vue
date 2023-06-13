<template>
    <div>
  
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
       
   
       
  
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="~admin-lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"> </a>
            </div>
            <buttom   @click="logout" > 
                      <span>Logout</span>
            </buttom>
          </div>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">  
              <li class="nav-item">
    <router-link to="/student/home" class="nav-link" :class="{ 'active': $route.path === '/student/home' }">
      <i class="fas fa-calendar" style="color: aliceblue;"></i>
    <p color="black"> home </p>
    </router-link>
    </li> 
              <li class="nav-item">
                <router-link to="/eleve/devoir" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Devoir
                  </p>
                </router-link>
            </li>
              <li class="nav-item">
                <router-link to="/eleve/cours" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Cours
                  </p>
                </router-link>
            </li>
              <li class="nav-item">
                <router-link to="/eleve/carnetdeNote" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Carnet de note 
                  </p>
                </router-link>
            </li>



<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon far fa-calendar-check"></i>
    <p>
      Présence
    </p>
  </a>
</li>
  
  <li class="nav-item">
    <router-link to="/eleve/Calend" class="nav-link" :class="{ 'active': $route.path === '/eleve/Calend' }">
      <i class="fas fa-calendar" style="color: aliceblue;"></i>
    <p color="black"> Calendrie </p>
    </router-link>
    </li>  
    <li class="nav-item">
    <router-link to="/eleve/Emploi" class="nav-link" :class="{ 'active': $route.path === '/eleve/Emploi' }">
      <i class="fas fa-sharp fa-solid fa-clock" style="color: aliceblue;"></i>
    <p color="black"> EmploiTemps </p>
    </router-link>
    </li>       
    <li class="nav-item">
    <router-link to="/eleve/Cantine" class="nav-link" :class="{ 'active': $route.path === '/eleve/Cantine' }">
      <i class="nav-icon fas fa-utensils" style="color: aliceblue;"></i>
    <p color="black"> Cantine </p>
    </router-link>
    </li>       
    <li class="nav-item">
    <router-link to="/eleve/Activity" class="nav-link" :class="{ 'active': $route.path === '/eleve/Activity' }">
      <i class="fas fa-futbol" style="color: aliceblue;"></i> <!-- Icône de ballon de football -->
  <i class="fas fa-paint-brush" style="color: aliceblue;"></i>
    <p color="black"> Activity </p>
    </router-link>
    </li>       
</ul>
 


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
    
   }
   </script>
<template>
    <div>
  
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
       
   
        <a href="#" class="brand-link">
          <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"> </span>
        </a>
  
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="~admin-lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"> </a>
            </div>
            <span>{{ user.username }} </span>
            <buttom   @click="logout" > 
                      <span>Logout</span>
            </buttom>
          </div>
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
              <li class="nav-item">
                <router-link to="/parent/groupes" class="nav-link" :class="{ active: $route.path === '/parent/groupes' }">
                  <i class="nav-icon fas fa-chalkboard"></i>
                  <p>
                    groupe  Scolaire
                  </p>
                </router-link>
              </li>
  
              <li class="nav-item menu-open ">
                <a href="#" class="nav-link " :class="{ active: $route.path.startsWith('/Etudiant') }">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Etudiant
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                    
                  <li class="nav-item">
                    <router-link to="" class="nav-link " :class="{ 'active': $route.path === '' }">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tous</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="" class="nav-link" :class="{ 'active': $route.path === '' }">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Nouveau</p>
                    </router-link>
                  </li>
                </ul>
              </li>
  
              <li class="nav-item">
                <a href="#" class="nav-link " :class="{ active: $route.path.startsWith('/Etudiant') }">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Class
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                      <router-link to="" class="nav-link " :class="{ 'active': $route.path === '' }">
                        <!-- <i class="far fa-circle nav-icon"></i> -->
                        <p>Tous</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="" class="nav-link" :class="{ 'active': $route.path === '' }">
                        <!-- <i class="far fa-circle nav-icon"></i> -->
                        <p>Nouveau</p>
                      </router-link>
                    </li>
                  </ul>
              </li>
  
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Devoir
                  </p>
                </a>
            </li>

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-clipboard-list"></i>
    <p>
      Projet
    </p>
  </a>
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
  <router-link to="/professeur/textbookProf" class="nav-link " :class="{ 'active': $route.path === '/textbookProf' }">
    <i class="fas fa-book"> </i>
    <p>Textbook</p>
  </router-link>
  </li>
  <li class="nav-item">
    <router-link to="/professeur/Calendrie" class="nav-link" :class="{ 'active': $route.path === '/professeur/Calendrie' }">
      <i class="fas fa-calendar" style="color: aliceblue;"></i>
    <p color="black"> Calendrie </p>
    </router-link>
    </li>
    <li class="nav-item">
    <router-link to="/professeur/EmploiProf" class="nav-link" :class="{ 'active': $route.path === '/professeur/EmploiProf' }">
      <i class="fas fa-sharp fa-solid fa-clock" style="color: aliceblue;"></i>
    <p color="black">  Emploi Temps </p>
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
    
   }
   </script>
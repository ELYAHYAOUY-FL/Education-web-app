<template>
    <div>
  
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
       
        <buttom   @click="logout" > 
                      <span>Logout</span>
            </buttom>
        <a href="#" class="brand-link">
          <img src="~admin-lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2"  alt="AdminLTE Logo" style="opacity: .8">
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
            
          </div>
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
              <li class="nav-item">
                <router-link to="/parent/groupes" class="nav-link" :class="{ active: $route.path === '/parent/groupes' }">
                  <i class="nav-icon fas fa-chalkboard"></i>
                  <p>
                    Les Notes
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/professeur/coursProf" class="nav-link " :class="{ 'active': $route.path === '/coursProf' }">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                     Cours
                  </p>
              </router-link>
            </li>

<li class="nav-item">
  <router-link to="/professeur/DevoirsProf" class="nav-link " :class="{ 'active': $route.path === '/DevoirsProf' }">
    <i class="nav-icon fas fa-clipboard-list"></i>
    <p>
      Devoirs
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
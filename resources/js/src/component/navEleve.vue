<template>
    <nav class="navbar1">
      <!-- Logo -->
      <div>
        <img src="../assest/images/logoo.png" alt="" class="logo1" />
      </div>
      <!-- Navigation Menu -->
      <ul class="nav-links">
        <!-- Using Checkbox Hack -->
        <input type="checkbox" id="checkbox_toggle" />
        <label for="checkbox_toggle" class="hamburger">&#9776;</label>
  
        <!-- Navigation Menus -->
        <div class="menu">
          <li>
            <router-link :to="`/parentEleveDetails/${eleveId}`">Accueille</router-link>
          </li>
  
          <li class="services">
            <router-link :to="`/parentElevecantine/${eleveId}`">cantine</router-link>
          </li>
  
          <li>
            <router-link :to="`/parentElevenote/${eleveId}`">suivre de notes</router-link>
          </li>
          <li>
            <router-link :to="`/parentElevecalendrier/${eleveId}`">calenderier </router-link>
          </li>
          <li>
            <router-link :to="`/parentEleveactivities/${eleveId}`">les activities parascolaire </router-link>
          </li>
          <li>
            <buttom  class="boton"  @click="logout" > 
                      <span>Logout</span>
            </buttom>
          </li>
        </div>
      </ul>
    </nav>
  </template>
 

  <script>
  import { mapGetters } from 'vuex'

export default {
  name: "Navbar",
  props: ['eleveId'],
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

<style>
.boton span{
  color:black;
}
:root{
  --el-color-primary: #4c9e9e;
  --el-menu-active-color: var(--el-color-primary);

}

.navbar1 {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 90px 20px ;
     margin-bottom: 0;
   
  }
    /* background-color:#1c1d1c; */
    /* height: 30%; */
   
    .navbar1 .nav-links  {
      margin-bottom: 0;
    }
 .logo1  {
      margin-top: 5px;
      margin-bottom: 0;
      color: #ffffff;
    width:80px;
    }
    
    .navbar1 .nav-links a {
    color: #ffffff;
    /* font-weight: bold; */
    list-style: none;
    opacity: 1 !important;
    margin: 0;
    } */
    
    /* LOGO */
    .logo1 {
      
    margin: 0 ;
    }
    
    /* NAVBAR MENU */
    .menu {
    display: flex;
    gap: 1em;
    font-size: 18px;
    }
    
    .menu li:hover {
    background-color: #4c9e9e;
    border-radius: 5px;
    transition: 0.3s ease;
    }
    
    .menu li {
    padding: 5px 14px;
    }
    
    /* DROPDOWN MENU */
    .services {
    position: relative; 
    }
</style>
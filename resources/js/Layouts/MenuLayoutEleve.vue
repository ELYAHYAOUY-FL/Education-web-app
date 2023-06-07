<template>
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
</li>
</ul>
</nav>
      <Menu/>
<div class="content-wrapper"> 
<!-- le contenu de la page  -->
<slot/> 
</div>

<Footer/>
</div>
  </template>
  <script>
import Footer from './Partials/Footer.vue';
import Menu from './Partials/MenuElev.vue';
export default {
  mounted() {
    this.$on('eleveSelected', (eleveId) => {
      this.goToEleveDashboard(eleveId);
    });
  },
  methods: {
    goToEleveDashboard(eleveId) {
      // Naviguez vers le tableau de bord de l'élève avec l'ID d'élève sélectionné
      this.$router.push(`/dashboard/${eleveId}`);
    }
  }
};
</script>
  
  
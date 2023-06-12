<template>
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
</li>
</ul>
</nav>
      <MenuLayoutEle/>
<div class="content-wrapper"> 
<!-- le contenu de la page  -->
<slot/> 
</div>

<Footer/>
</div>
  </template>

  <script setup>
import Footer from './Partials/Footer.vue';
import MenuLayoutEle from './Partials/MenuElev.vue';
</script>
  
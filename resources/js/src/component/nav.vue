<template>
  <nav class="navbar1">
<!-- LOGO -->
<!-- <div class="logo1">Pronote</div> -->
<div ><img src="../assest/images/logoo.png" alt="" class="logo1"></div>
<!-- NAVIGATION MENU -->
<ul class="nav-links">

<!-- USING CHECKBOX HACK -->
<input type="checkbox" id="checkbox_toggle"/>
<label for="checkbox_toggle" class="hamburger">&#9776;</label>


<!-- NAVIGATION MENUS -->
<div class="menu">
<li><a href="/">Accueil</a></li>
<li><a href="/">À propos de nous</a></li>

<li class="services">
<a href="/">Services</a>

<!-- DROPDOWN MENU -->
<ul class="dropdown">
<li><a href="/">Élève </a></li>
<li><a href="/">Parent </a></li>
<li><a href="/">Administration</a></li>
<li><a href="/">Enseignant </a></li>

</ul>

</li>

<li><a href="/">Paiement</a></li>
<li><a href="/">Contactez-nous </a></li>
</div>
</ul>
</nav>
</template>

<script>


export default {

  name: "Navbar",
 

};
</script>
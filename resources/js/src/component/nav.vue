<template>
  <nav class="navbar">
<!-- LOGO -->
<div class="logo">Pronote</div>

<!-- NAVIGATION MENU -->
<ul class="nav-links">

<!-- USING CHECKBOX HACK -->
<input type="checkbox" id="checkbox_toggle" />
<label for="checkbox_toggle" class="hamburger">&#9776;</label>


<!-- NAVIGATION MENUS -->
<div class="menu">
<li><a href="/">Acuille</a></li>
<li><a href="/">a propos de nous </a></li>

<li class="services">
<a href="/">Services</a>

<!-- DROPDOWN MENU -->
<ul class="dropdown">
<li><a href="/">Eleve </a></li>
<li><a href="/">Parent </a></li>
<li><a href="/">Aministration</a></li>
<li><a href="/">Ensegnent </a></li>

</ul>

</li>

<li><a href="/">Payemnt</a></li>
<li><a href="/">Contact-nous </a></li>
</div>
</ul>
</nav>
</template>

<script>


export default {

  name: "Navbar",
 

};
</script>
<template>
    <nav class="navbar12">
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
            <a :href="`/parentEleveDetails/${eleveId}`">Accueille</a>
          </li>
          <li><a href="/"></a></li>
  
          <li class="services">
            <a :href="`/parentElevecantine/${eleveId}`">cantine</a>
          </li>
  
          <li>
            <a :href="`/parentElevenote/${eleveId}`">suivre de notes</a>
          </li>
          <li>
            <a :href="`/parentElevecalendrier/${eleveId}`">calenderier </a>
          </li>
          <li>
            <a :href="`/parentEleveactivities/${eleveId}`">les activities parascolaire </a>
          </li>
        </div>
      </ul>
    </nav>
  </template>
 

  <script>
export default {
  name: "Navbar",
  props: ['eleveId'],
};
</script>
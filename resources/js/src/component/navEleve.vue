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


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
      <div class="menu1">
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
          <buttom class="boton" @click="logout">
            <span>Logout</span>
          </buttom>
        </li>
      </div>
    </ul>
  </nav>
</template>

<style>
.boton span {
  color: black;
}

.navbar1 {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 20px;
  margin-bottom: 0;
}

.logo1 {
  margin-top: 5px;
  margin-bottom: 0;
  color: #ffffff;
  width: 80px;
}

.navbar1 .nav-links {
  margin-bottom: 0;
}

.navbar1 .nav-links a {
  color: #333;
  list-style: none;
  opacity: 1 !important;
  margin: 0;
}

.menu1 {
  display: flex;
  gap: 1em;
  font-size: 18px;
}

.menu1 li:hover {
  background-color: #4c9e9e;
  border-radius: 5px;
  transition: 0.3s ease;
}

.menu1 li {
  padding: 5px 14px;
}

.services {
  position: relative;
}

/* Close Button */
.close-button {
  display: none;
  position: absolute;
  top: 10px;
  right: 20px;
  font-size: 24px;
  cursor: pointer;
}

input[type="checkbox"]:checked ~ .menu1 {
  display: block;
}

input[type="checkbox"]:checked ~ .close-button {
  display: block;
}

@media (max-width: 820px) {
  .menu1 {
    display: none;
    position: absolute;
    background-color: var(--teal);
    right: 0;
    left: 0;
    text-align: center;
    padding: 16px 0;
  }

  .menu1 li:hover {
    display: inline-block;
    background-color: var(--green);
    transition: 0.3s ease;
  }

  .menu1 li + li {
    margin-top: 12px;
  }

  input[type="checkbox"]:checked ~ .menu1 {
    display: block;
  }

  .hamburger {
    display: block;
  }

  .close-button {
    display: none;
  }

  header.hero .hero-text {
    margin-top: 15%;
    margin-bottom: 20%;
  }
}
</style>

<script>
import { mapGetters } from "vuex";

export default {
  name: "Navbar",
  props: ["eleveId"],
  computed: {
    ...mapGetters({
      user: "auth/user",
    }),
  },
  methods: {
    logout() {
      this.$store.dispatch("auth/logout").then(() => {
        this.$router.push("/login");
      });
    },
  },
};
</script>

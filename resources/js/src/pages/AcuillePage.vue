<template>
    <div>
      <div>
        <header class="hero" data-aos="fade-up-right">
          <Navbar/>
          <Hero/>
        </header>
        <UsersCard data-aos="fade-up-right"/>
      </div>
      <div>
        <Section data-aos="zoom-in"/>
      </div>
      <Footer data-aos="fade-up" />
    </div>
  </template>
  
  <script>
  import Hero from '../component/header.vue'
  import Navbar from '../component/nav.vue'
  import UsersCard from '../component/UsersCard.vue'
  import Footer from '../component/footer.vue'
  import Section from '../component/section.vue'
  import AOS from 'aos'
  import 'aos/dist/aos.css'
  
  export default {
    name: "AcuillePage",
    components: {
      Section,
      Footer,
      Hero,
      Navbar,
      UsersCard
    },
    mounted() {
      AOS.init();
    }
  };
  </script>
  
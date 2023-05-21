
<template>
    <div>
    <div>
     <header class="hero">
        <Navbar/>
         <Hero/>
     </header>
     <UsersCard/>
         </div>
         <div>
            <Section/>
         </div>
         <Footer/>
        </div>
</template>

<script>

 import Hero from '../component/header.vue'
 import Navbar from '../component/nav.vue'
 import UsersCard from '../component/UsersCard.vue'
 import Footer from '../component/footer.vue'
 import Section from '../component/section.vue'
export default {
    name :"AcuillePage",
components :{
    Section,
    Footer,
    Hero,
    Navbar,
    UsersCard
}
};
</script>

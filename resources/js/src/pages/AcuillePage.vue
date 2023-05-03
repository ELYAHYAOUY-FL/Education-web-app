
<template>
    <div>
     <header class="hero">
        <Navbar/>
         <Hero/>

     </header>
     <UsersCard/>
    
         </div>
</template>

<script>
 import Hero from '../component/header.vue'
 import Navbar from '../component/nav.vue'
 import UsersCard from '../component/UsersCard.vue'
export default {
    name :"AcuillePage",
components :{
    Hero,
    Navbar,
    UsersCard
}
};
</script>

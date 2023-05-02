
<template>
    <div>
     <header class="hero">
        <Navbar/>
         <Hero/>

     </header>
    
         </div>
</template>

<script>
 import Hero from '../component/header.vue'
 import Navbar from '../component/nav.vue'
export default {
    name :"AcuillePage",
components :{
    Hero,
    Navbar
}
};
</script>

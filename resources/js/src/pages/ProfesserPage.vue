<template>
  <MainLayoutProf>
    <router-view>
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0">Page home prof</h1>
</div>

</div>
</div>
</div>


<div class="content">
<div class="container-fluid">
 <CarnetNote/>
</div>
</div>
</router-view>
</MainLayoutProf>
  </template>
  <script>
   import MainLayoutProf from "../../Layouts/MainLayoutProf.vue";
   import CarnetNote from  "../../PageProfesseur/CreatCarnet.vue";

   export default{
    
    name: "Prof",
    components: { MainLayoutProf,
    CarnetNote,
    }
}
    
</script>
  
  
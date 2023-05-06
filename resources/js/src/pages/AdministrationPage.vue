<template>
  <MainLayout>
    <router-view>
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0">Page home</h1>
</div>

</div>
</div>
</div>


<div class="content">
<div class="container-fluid">
<h1>mon contenue</h1>

</div>
</div>
</router-view>
</MainLayout>
  </template>
  <script>
   import MainLayout from "../../Layouts/MainLayout.vue";

   export default{
    
    name: "Admin",
    components: { MainLayout }
}
    
</script>
  
  
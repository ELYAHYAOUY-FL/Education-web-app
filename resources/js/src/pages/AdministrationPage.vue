<template>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-XXXXXXXXXXXXXXXXXXXXXXXXXXXX" crossorigin="anonymous">

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


<div class="container">
    <h2></h2>
<div class="row">
  <div class="col-md-4">
    
    <div class="card" style=" background-color: #bae4cf; width: 85%;" >
      <div class="card-body"> <div> <i class="fas fa-users mr-2 fa-lg"></i>  
          </div>
        <div class="d-flex align-items-center">
         
          <p class="card-text">Nombre total d'étudiants : {{ dashboardData.totalStudents }}</p>
         
        </div>
        
        
        <!-- Autres statistiques... -->
      </div>
    </div>
  </div>
 
  <div class="col-md-4">
  <div class="card" style=" background-color: #bae4cf;  width: 85%;"  >
      <div class="card-body">
        <i class="fas fa-user mr-2 fa-lg"></i> <!-- Icône pour le nombre total de professeurs -->

     <div class="d-flex align-items-center">
           
          <p class="card-text">Nombre total de professeurs : {{ dashboardData.totalTeachers }}</p>
          
          
        </div>
        </div>
        </div>
      </div>
    
    <div class="col-md-4">
        <div class="card" style=" background-color: #bae4cf; " >
      <div class="card-body">
        <i class="fas fa-book mr-2 fa-lg"></i> <!-- Icône pour le nombre total de niveaux scolaires -->

        <div class="d-flex align-items-center">
           
          <p class="card-text">Nombre total de niveaux scolaires : {{ dashboardData.totalSchoolLevels }}</p>
            
           
        </div>
        </div>
      </div>
        </div>
 </div>
      </div>
       
</router-view>
</MainLayout>
  </template>
  
  <script>
   import MainLayout from "../../Layouts/MainLayout.vue";

import axios from 'axios';

export default {
  name: "Admin",
    components: { MainLayout },
    data() {
    return {
      dashboardData: {}
    };
  },
  mounted() {
    this.fetchDashboardData();
  },
  methods: {
    fetchDashboardData() {
      axios.get('/dashboard')
        .then(response => {
          this.dashboardData = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
};
    
</script>
  
  
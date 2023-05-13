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


<div class="container">
    <h2>Tableau de bord</h2>
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <i class="bi bi-people-fill mr-2"></i>
          <p class="card-text">Nombre total d'étudiants : {{ dashboardData.totalStudents }}</p>
        </div>
        <div class="d-flex align-items-center">
          <i class="bi bi-person-fill mr-2"></i>
          <p class="card-text">Nombre total de professeurs : {{ dashboardData.totalTeachers }}</p>
        </div>
        <div class="d-flex align-items-center">
          <i class="bi bi-book-fill mr-2"></i>
          <p class="card-text">Nombre total de niveaux scolaires : {{ dashboardData.totalSchoolLevels }}</p>
        </div>
        <!-- Autres statistiques... -->
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
<div class="overview-item overview-item--c1">
<div class="overview__inner">
<div class="overview-box clearfix">
<div class="icon">
<i class="zmdi zmdi-account-o"></i>
</div>
<div class="text">
<h2>10368</h2>
<span>members online</span>
</div>
</div>
<div class="overview-chart"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
<canvas id="widgetChart1" height="510" style="display: block; width: 367px; height: 255px;" width="734" class="chartjs-render-monitor"></canvas>
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
  
  
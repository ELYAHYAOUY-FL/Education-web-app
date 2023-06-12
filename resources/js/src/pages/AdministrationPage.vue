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
    <h2></h2>
<div class="row">
  <div class="col-md-4">
    
    <div class="card" style=" background-color: #bae4cf; width: 80%;" >
      <div class="card-body"> <div> <i class="fas fa-users mr-2 fa-lg"></i>  
          </div>
        <div class="d-flex align-items-center">
         
          <p class="card-text" style=" color: rgb(49, 49, 49);">Nombre total d'étudiants : {{ dashboardData.totalStudents }}</p>
         
        </div>
        
        
        <!-- Autres statistiques... -->
      </div>
    </div>
  </div>
 
  <div class="col-md-4">
  <div class="card" style=" background-color: #aad1be;  width: 85%;"  >
      <div class="card-body">
        <i class="fas fa-user mr-2 fa-lg"></i> <!-- Icône pour le nombre total de professeurs -->

     <div class="d-flex align-items-center">
           
          <p class="card-text" style=" color: rgb(49, 49, 49);">Nombre total de professeurs : {{ dashboardData.totalTeachers }}</p>
          
          
        </div>
        </div>
        </div>
      </div>
    
    <div class="col-md-4">
        <div class="cardss" style=" background-color: #a2c4b3;  width: 85%; " >
      <div class="card-body">
        <i class="fas fa-book mr-2 fa-lg"></i> <!-- Icône pour le nombre total de niveaux scolaires -->

        <div class="d-flex align-items-center">
           
          <p class="card-text" style=" color: rgb(49, 49, 49);">Nombre total de niveaux scolaires : {{ dashboardData.totalSchoolLevels }}</p>
            
           
        </div>
        </div>
      </div>
        </div>
 </div>
      </div>
      <div class="cardo">

        <div class="chart-container">
    <canvas ref="chart"></canvas>
  </div>
  <div class="cardoo">
  <div class="events-container">
    <div v-for="(event, index) in events" :key="event.id" class="event-item">
      <div class="notification" :style="{ backgroundColor: event.color }">
        <div class="notification__header">
          <h5 @click="toggleDescription(event)">{{ event.date }} {{ event.title }}</h5>
        </div>
        <div v-if="event.showDescription" class="notification__body">
          <p>{{ event.description }}</p>
        </div>
      </div>
    </div>
  </div>

 
</div>
</div>
<br><br>

<br><br>
<div class="calendar cale ">
    <div class="calendar__header hed">
      <button @click="previousMonth">&lt;</button>
      <h2>{{ monthNames[currentMonth] }} {{ currentYear }}</h2>
      <button @click="nextMonth">&gt;</button>
    </div>
    <div class="calendar__days dayy">
      <div
        v-for="day in days"
        :key="day"
        :class="{ 'calendar__day': true, 'calendar__day--current': isCurrentDay(day) }"
      >
        {{ day }}
      </div>
    </div>
  </div>

</router-view>
</MainLayout>
  </template>
  
  <script>
  import MainLayout from "../../Layouts/MainLayout.vue";
  import axios from 'axios';
  import  Chart  from 'chart.js/auto';
  
  export default {
    name: "Admin",
    components: { MainLayout },
    data() {
      return {
     dashboardData: {},
    chartInstance: null,
    months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin'],
    currentYear: new Date().getFullYear(),
      currentMonth: new Date().getMonth(),
      currentDay: new Date().getDate(),
      days: [],
      events: [],
  };
    },
    computed: {
    monthNames() {
      return [
        'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
        'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
      ];
    }
  },
    mounted() {
      this.fetchDashboardData();
      this.fetchPaymentRates();
      this.updateCalendar();
      this.fetchEvents();
  },   
    methods: {
      toggleDescription(event) {
      event.showDescription = !event.showDescription;
    },
      fetchEvents() {
      axios.get('/events')
        .then(response => {
          this.events = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    
      updateCalendar() {
      const firstDay = new Date(this.currentYear, this.currentMonth, 1).getDay();
      const totalDays = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
      this.days = Array.from({ length: totalDays }, (_, i) => i + 1).slice(firstDay);
    },
    isCurrentDay(day) {
      return (
        this.currentYear === new Date().getFullYear() &&
        this.currentMonth === new Date().getMonth() &&
        day === new Date().getDate()
      );
    },
    previousMonth() {
      if (this.currentMonth === 0) {
        this.currentMonth = 11;
        this.currentYear--;
      } else {
        this.currentMonth--;
      }
      this.updateCalendar();
    },
    nextMonth() {
      if (this.currentMonth === 11) {
        this.currentMonth = 0;
        this.currentYear++;
      } else {
        this.currentMonth++;
      }
      this.updateCalendar();
    },
      fetchDashboardData() {
        axios.get('/dashboard')
          .then(response => {
            this.dashboardData = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
  fetchPaymentRates() {
      axios.get('/payment-rates')
        .then(response => {
          const paymentRates = response.data.paymentRates;
          // Destruction du diagramme existant s'il existe
          if (this.chartInstance) {
            this.chartInstance.destroy();
          }
          // Initialisation du nouveau diagramme
          this.chartInstance = new Chart(this.$refs.chart, {
            type: 'bar',
            data: {
              labels: Object.keys(paymentRates),
              datasets: [{
                label: 'Taux de paiement',
                data: Object.values(paymentRates),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  type: 'linear',
                  beginAtZero: true
                }
              }
            }
          });
        })
        .catch(error => {
          console.error(error);
        });
    },

    }
  };
  </script>


<style>
.cale  {
  max-width: 300px;
  margin-left:  100px;
  
}

.hed {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.hed button {
  background: none;
  border: none;
  font-size: 18px;
  cursor: pointer;
}

.dayy {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 10px;
}

.calendar__day {
  text-align: center;
  padding: 10px;
  border: 1px solid #ccc;
}

.calendar__day--current {
  background-color: #82c5a9;
}
/*********    notification    ******** */
.cardoo{
  /* border: #fffcfc solid; */
  /* background-color: #ffffff; */
  width: fit-content;
  height: fit-content;
  padding: 10px 5px;
  border-radius: 5px;
}
.cardo{
  /* border: #fffcfc solid;
  background-color: #ffffff; */
  /* width: fit-content; */
  border-radius: 5px;
  display: grid;
  grid-template-columns: 10fr 1fr;
  grid-gap: 0px;
}
.notification {
  background-color: #f2f2f2;
  padding: 10px;
  border-radius: 5px;
  width: fit-content;
  height: fit-content;
}

.events-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  grid-gap: 2px;
}

.event-item {
  display: flex;
}

.chart-container {
  max-width: 750px;
  height: auto;
}

 
</style>
 
  
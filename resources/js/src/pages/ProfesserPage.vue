<template>
  <MainLayoutProf>
    <router-view>
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0">Bienvenue cher Professeur</h1>
</div>
<div class="cardoo col-sm-6">
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
</div>
</div>


<div class="content">
<div class="container-fluid">
 <CarnetNote/>

  

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
    },
    data() {
      return {
      
    chartInstance: null,
    months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin'],
    currentYear: new Date().getFullYear(),
      currentMonth: new Date().getMonth(),
      currentDay: new Date().getDate(),
      days: [],
      events: [],
  };},
  computed: {
    monthNames() {
      return [
        'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
        'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
      ];
    }
  },
    mounted() {
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
  } 
}
    
</script>
  
  
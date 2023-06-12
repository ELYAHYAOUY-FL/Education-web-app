<template>
  

    <div>
        <NavBar :eleveId="eleve.id" />
      <div class="calendar-container">
  
        <h1><i class="fas fa-calendar"></i> Calendrier</h1>
        <br>
        <transition name="fade">
          <div v-if="selectedEvent" class="event-details" @click="selectedEvent = null">
            <h3>{{ selectedEvent.title }}</h3>
            <div>{{ selectedEvent.description }}</div>
          </div>
        </transition>
        <FullCalendar :options="calendarOptions" class="calendrier" @click="scrollToEvent" />
      </div>
    </div>
  </template>
  
  <script>

import MenuLayoutEleve from "../Layouts/MenuLayoutEleve.vue";
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import NavBar from '../src/component/navEleve.vue'

import axios from 'axios';

export default {
   
  components: {
    FullCalendar,
    MenuLayoutEleve ,
    NavBar


  },

  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: [], // Les événements seront ajoutés dynamiquement
        eventClick: this.handleEventClick,
        
      },
      selectedEvent: null,
      eleve: {
        groupe: {},

        user: {},
        },
    };
  },
 
  methods: {

      fetchEleve() {
        axios
          .get('/eleves/' + this.$route.params.eleveId)
          .then(response => {
            this.eleve = response.data;
            console.log( this.eleve.id);
            this.eleve.groupe = response.data.groupe;
            this.groupeId= this.eleve.groupe.id;
            this.eleve.user = response.data.user;
             this.userId = this.eleve.user.id;
             
      console.log(this.groupeId);
            
            console.log('eleve:', this.eleve);
            console.log('eleve:', this.eleve);
       
          
      console.log(this.userId);
          })
          .catch(error => {
            console.error(error);
          });
      },
    handleEventClick(info) {
      this.selectedEvent = {
        title: info.event.title,
        description: info.event.extendedProps.description,
      };
    },
    scrollToEvent() {
      const eventDetailsElement = document.querySelector('.event-details');
      eventDetailsElement.scrollIntoView({ behavior: 'smooth' });
    },
    getevent(){
        axios.get('/events')
      .then(response => {
        this.calendarOptions.events = response.data;
      })
      .catch(error => {
        console.error(error);
      });
    }
  },
  mounted() {
    // Effectuer une requête HTTP pour récupérer les événements de la base de données
    this.fetchEleve();
    this.getevent();
  },
};
</script>
  
<style>
    .back{
        margin:10px;
        color:#000;
       display: flex;
       gap: 1rem;
       align-items: center;
        
    }
  .calendar-container {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 150vh;
  }
  
  .calendar-title {
    font-size: 24px;
    margin-bottom: 20px;
  }
  
  .event-details {
    background-color: #acdad0;
    padding: 10px;
    margin-top: 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  
  .event-details:hover {
    background-color: #8baca5;
  }
  
  .event-details h3 {
    margin-top: 0;
  }
  
  .calendrier {
    width: 80%;
    height: 900px;
  }
  ion-icon{
    color: #000;
    width: 20px;
  }
  </style>
<template>
    <MenuLayoutEleve>
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
    </MenuLayoutEleve>
  </template>
  
  <script>

  import MenuLayoutEleve from "../Layouts/MenuLayoutEleve.vue";
  import FullCalendar from '@fullcalendar/vue3';
  import dayGridPlugin from '@fullcalendar/daygrid';
  import interactionPlugin from '@fullcalendar/interaction';
  import axios from 'axios';
  
  export default {
    components: {
      FullCalendar,
      MenuLayoutEleve ,
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
      };
    },
    methods: {
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
    },
    mounted() {
      // Effectuer une requête HTTP pour récupérer les événements de la base de données
      axios.get('/events')
        .then(response => {
          this.calendarOptions.events = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
  };
  </script>
  
  <style>
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
  </style>
  
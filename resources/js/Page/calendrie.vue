<template>
    <MainLayout>
      <button @click="toggleWeekends">Toggle Weekends</button>
      <FullCalendar :options="calendarOptions" />
      <div>
        <h3>Ajouter un événement</h3>
        <input type="text" v-model="newEventTitle" placeholder="Titre de l'événement" />
        <button @click="addEvent">Ajouter</button>
      </div>
      <div>
        <h3>Ajouter un jour de vacances</h3>
        <input type="date" v-model="newHolidayDate" />
        <button @click="addHoliday">Ajouter</button>
      </div>
    </MainLayout>
  </template>
  
  <script>
  import MainLayout from "../Layouts/MainLayout.vue";
  import FullCalendar from '@fullcalendar/vue3'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import interactionPlugin from '@fullcalendar/interaction'
  
  export default {
    components: {
      FullCalendar,
      MainLayout,
    },
    data() {
      return {
        calendarOptions: {
          plugins: [dayGridPlugin, interactionPlugin],
          initialView: 'dayGridMonth',
          weekends: false,
          events: [],
          dateClick: this.handleDateClick,
        },
        newEventTitle: '',
        newHolidayDate: '',
      }
    },
    methods: {
      handleDateClick: function (arg) {
        // Gérer le clic sur une date
        const dateStr = arg.dateStr;
        const title = prompt("Titre de l'événement");
        if (title) {
          this.calendarOptions.events.push({ title, start: dateStr, end: dateStr });
        }
      },
      toggleWeekends() {
        // Activer ou désactiver les week-ends
        this.calendarOptions.weekends = !this.calendarOptions.weekends;
      },
      addEvent() {
        // Ajouter un événement
        const title = this.newEventTitle;
        if (title) {
          const dateStr = prompt("Date de l'événement (YYYY-MM-DD)");
          if (dateStr) {
            this.calendarOptions.events.push({ title, start: dateStr, end: dateStr });
            this.newEventTitle = '';
          }
        }
      },
      addHoliday() {
        // Ajouter un jour de vacances
        const dateStr = this.newHolidayDate;
        if (dateStr) {
          this.calendarOptions.events.push({ title: 'Vacances', start: dateStr, end: dateStr, classNames: 'holiday' });
          this.newHolidayDate = '';
        }
      }
    }
  }
  </script>
  
  <style>
  .holiday {
    background-color: #f2dede;
    color: #a94442;
  }
  </style>
  
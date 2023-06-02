<template>
  <MainLayout>
    <div class="container calendar"><br>
      <h1> <i class="fas fa-calendar" ></i>Calendrier</h1>
    <br>
      <button @click="showEventForm = !showEventForm" class="toggle-button">
        {{ showEventForm ? 'Fermer le formulaire' : 'Ajouter un événement' }}
      </button>
      <!-- Affichage de la description de l'événement sélectionné -->
    <transition name="fade">
      <div v-if="selectedEvent" class="container event-details" @click="selectedEvent = null" >
        <h3>{{ selectedEvent.title }}</h3>
        <div>{{ selectedEvent.description }}</div>
      </div>
    </transition>
      
      <transition name="slide">
        <div v-if="showEventForm" class="event-form">
          <h2>Ajouter un événement</h2>
          <form @submit.prevent="addEvent">
            <div>
              <label for="eventTitle">Titre:</label>
              <input type="text" id="eventTitle" v-model="newEvent.title" required>
            </div>
            <div>
              <label for="eventDate">Date:</label>
              <input type="date" id="eventDate" v-model="newEvent.date" required>
            </div>
            <div>
              <label for="eventDescription">Description:</label>
              <textarea id="eventDescription" v-model="newEvent.description"></textarea>
            </div>
            <div>
              <label for="eventColor">Couleur:</label>
              <input type="color" id="eventColor" v-model="newEvent.color">
            </div>
            <button type="submit">Ajouter</button>
          </form>
        </div>
      </transition>
    
      <FullCalendar :options="calendarOptions" class=" calendrier" @click="scrollToEvent" />
    </div>

    

  </MainLayout>
</template>

<style>
.calendrier {
  width: 80%;
  height: 900px;
}

.calendar {
  text-align: center;
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: auto;
}

.calendar-title {
  font-size: 24px;
  margin-bottom: 20px;
}

.event-form {
  margin: 20px 0;
}
 
.event-details {
  background-color: #acdad0;
  padding: 10px;
  margin-top: 20px;
  text-align: center;
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 40%;

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


/* .event-details div {
  margin-top: 10px;
  font-style: italic;
} */

button {
  padding: 10px 20px;
  background-color: #6bad8c;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #45a072;
}

form div {
  margin-bottom: 10px;
}

label {
  display: block;
}

input[type="text"],
input[type="date"],
textarea {
  width: 100%;
  padding: 5px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

input[type="color"] {
  padding: 0;
}

button[type="submit"] {
  background-color: #6fe9ba;
  margin-top: 10px;
}

.slide-enter-active,
.slide-leave-active,
.fade-enter-active,
.fade-leave-active {
  transition: all 0.5s;
}

.slide-enter,
.fade-enter {
  transform: translateX(100%);
  opacity: 0;
}

.slide-leave-to,
.fade-leave-to {
  transform: translateX(-100%);
  opacity: 0;
}
</style>

<script>
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import axios from 'axios';
import MainLayout from "../../Layouts/MainLayout.vue";

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
        events: [],
        eventClick: this.handleEventClick,
        eventContent: this.eventContent,
        slotDuration: '00:30:00', // Durée des créneaux horaires
        slotLabelInterval: '01:00', // Interval entre les étiquettes des créneaux horaires
        allDaySlot: false, // Désactiver l'affichage du créneau horaire toute la journée
      },
      showEventForm: false,
      newEvent: {
        title: '',
        date: '',
        description: '',
        color: '#ffffff',
      },
      selectedEvent: null,
    };
  },
  methods: {
    handleEventClick(info) {
      this.selectedEvent = null;
      if (info.event.extendedProps.description) {
        this.selectedEvent = {
          title: info.event.title,
          description: info.event.extendedProps.description,
        };
      }
    },
    eventContent(info) {
      const content = document.createElement('div');
      content.innerHTML = `<b>${info.event.title}</b>`;
      if (this.selectedEvent && this.selectedEvent.title === info.event.title) {
        const descriptionElement = document.createElement('div');
        descriptionElement.textContent = this.selectedEvent.description;
        content.appendChild(descriptionElement);
      }
      return { domNodes: [content] };
    },
    addEvent() {
      axios.post('/events', this.newEvent)
        .then(response => {
          this.calendarOptions.events.push(response.data);
          this.newEvent = {
            title: '',
            date: '',
            description: '',
            color: '#ffffff',
          };
          this.showEventForm = false;
        })
        .catch(error => {
          console.error(error);
        });
    },
    scrollToEvent() {
      const eventDetailsElement = document.querySelector('.event-details');
      eventDetailsElement.scrollIntoView({ behavior: 'smooth' });
    },
  },
  mounted() {
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

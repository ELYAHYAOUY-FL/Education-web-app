<template>
    <MenuLayoutEleve>
      <div class="activity-list">
        <h2>Liste des activités</h2>
        <ul class="list-group">
          <li v-for="activity in activities" :key="activity.id" class="list-group-item activity-item">
            <div class="d-flex align-items-center">
              <img :src="'/photos/' + activity.photo" alt="Photo" class="activity-photo mr-3">
              <div style="color: black; font-style: italic; font-size: 20px;" class="activitie">
                <h3 class="activity-title">{{ activity.nom }}</h3>
                <p class="activity-description">{{ activity.description }}</p>
                <p>Date: {{ activity.date }}</p>
                <p>Heure: {{ activity.heure }}</p>
              </div>
            </div>
           
          </li>
        </ul>
      </div>
    </MenuLayoutEleve>
  </template>
  
  
  <script>
  import 'font-awesome/css/font-awesome.css';
  import MenuLayoutEleve from "../Layouts/MenuLayoutEleve.vue";
  import axios from 'axios';
  export default {
    components: {
        MenuLayoutEleve
    },
    data() {
      return {
        activities:[],
        editingId: null,
          nom: '',
          description: '',
          date: '',
          heure: '',
          photo: null,
      
        inputKey: Date.now(), // Clé pour réinitialiser l'élément input file
        imagePreview: ''
      };
    },
    mounted() {
      this.fetchActivities();
    },
    methods: {
      fetchActivities() {
        axios.get('/activities')
          .then(response => {
            console.log('valid');
            this.activities = response.data;
          })
          .catch(error => {
            console.error('Erreur lors de la récupération des activités:', error);
          });
      },

      onFileChange(event) {
        const file = event.target.files[0];
        this.form.photo = file;
  
        // Afficher l'aperçu de l'image
        const reader = new FileReader();
        reader.onload = (e) => {
          this.imagePreview = e.target.result;
        };
        reader.readAsDataURL(file);
      },
      supprimerActivity(activityId) {
        axios.delete(`/activities/${activityId}`)
          .then(response => {
            console.log(response.data.message);
            this.fetchActivities(); // Mettre à jour la liste des activités après la suppression
          })
          .catch(error => {
            console.error(error);
          });
      },
      resetForm() {
        this.nom = '';
        this.description = '';
        this.date = '';
        this.heure = '';
        this.photo = null;
        this.imagePreview = '';
      }
    }
  };
  </script>
  
   
  <style>
  .activity-list {
    padding: 20px;
  }
  
  .activity-item {
    margin-bottom: 20px;
    border-radius: 4px;
  }
  
  .activity-title {
    color: #333;
    font-size: 18px;
    margin-bottom: 5px;
  }
  .activitie p {
    color: #666;
  }
  
  .activity-description {
    color: #666;
  }
  
  .activity-photo {
    width: 100px;
    height: auto;
    border-radius: 4px;
  }
  </style>
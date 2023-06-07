<template>
    <div>
      <h2>Derniers cahiers de notes des professeurs</h2>
      <ul>
        <li v-for="carnet in derniersCahiers" :key="carnet.groupe.id">
          <strong>Groupe:</strong> {{ carnet.groupe.nom }}<br>
          <strong>Contenu:</strong> {{ carnet.contenu }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        derniersCahiers: []
      };
    },
    mounted() {
      this.getContenusCahiersNotes();
    },
    methods: {
      getContenusCahiersNotes() {
        axios.get('/eleves/contenus-cahiers-notes/' + this.userId)
          .then(response => {
            this.derniersCahiers = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      }
    }
  };
  </script>
  
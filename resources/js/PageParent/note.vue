<template>
  

    <div>
        <NavBar :eleveId="eleve.id" />
        <div> 
      <div v-for="(last, matiereId) in lasts" :key="matiereId">
        {{ last.note.valeur }} à {{ last.matiere.titre }}
      </div>
     
    </div>
    </div>
  </template>
  
  <script>

import MenuLayoutEleve from "../Layouts/MenuLayoutEleve.vue";
import 'font-awesome/css/font-awesome.css';

import NavBar from '../src/component/navEleve.vue'

import axios from 'axios';

export default {
   
  components: {
    
    MenuLayoutEleve ,
    NavBar


  },

  data() {
    return {
     
      eleve: {
        groupe: {},

        user: {},
        },
        lasts: {} ,// Initialize lasts as an empty object

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
             this.fetchlastNote(this.userId);
      console.log(this.groupeId);
            
            console.log('eleve:', this.eleve);
            console.log('eleve:', this.eleve);
       
          
      console.log(this.userId);
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchlastNote(userid) {
        axios
          .get('/eleves/user/note/'+  userid)
          .then(response => {
            this.lasts = response.data;
           console.log(this.lasts)
          
          })
          .catch(error => {
            console.error(error);
          });
      },
  },
     
  mounted() {
    // Effectuer une requête HTTP pour récupérer les événements de la base de données
    this.fetchEleve();
  

 
}};
</script>
  

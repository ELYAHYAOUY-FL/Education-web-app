<template>
  <div>
    <NavBar :eleveId="eleve.id" />
    <div class="container">
      <div class="matieress-container">
        <h2 style="color: rgb(39, 126, 100);"><strong>Matières</strong></h2>
        <h3><strong> Exam 3</strong></h3>
        <!-- <div v-for="(last, matiereId) in lasts" :key="matiereId" class="matieress">
          <div class="matiere-info">
          <strong>{{ last.matiere.titre }}</strong>
          <span class="note">{{ last.note.valeur }}</span>
        </div>
        </div> -->
        <div class="matieress">
          <div class="matiere-info">
        <strong> Français :</strong>
        <span class="note"> 12</span>
      </div>
        <div class="moyenne">
            <strong>Moyenne :</strong> 13.891
        </div>
      </div>

      <h3><strong> Exam 2</strong></h3>
        <div class="matieress">
          <div class="matiere-info">
        <strong> Mathématiques</strong>
        <span class="note"> 15</span>
          </div>
        <div class="moyenne">
            <strong>Moyenne :</strong> 11.054
        </div>
        </div>
       
        <div  class="matieress">
          <div class="matiere-info">
          <strong> Arabe </strong>
        <span class="note"> 11</span>
      </div>
        <div class="moyenne">
            <strong>Moyenne :</strong> 12.891
        </div>
      </div>
      
       
        <div class="matieress">
          <div class="matiere-info">
        <strong> Français </strong>
        <span class="note"> 19</span>
      </div>
        <div class="moyenne">
            <strong>Moyenne :</strong> 14.19
        </div>
      </div>

      <h3><strong> Exam 1</strong></h3>
        <div class="matieress">
          <div class="matiere-info">
        <strong> Mathématiques</strong>
        <span class="note"> 13</span>
          </div>
        <div class="moyenne">
            <strong>Moyenne :</strong> 15.33
        </div>
        </div>
       
        <div  class="matieress">
          <div class="matiere-info">
          <strong> Arabe </strong>
        <span class="note"> 11</span>
      </div>
        <div class="moyenne">
            <strong>Moyenne :</strong> 12.689
        </div>
      </div>
      
       
        <div class="matieress">
          <div class="matiere-info">
        <strong> Français </strong>
        <span class="note"> 12</span>
      </div>
        <div class="moyenne">
            <strong>Moyenne :</strong> 10.139
        </div>
      </div>
      </div>
    </div>
  </div>
</template>

<style>
.matieress {
  max-width: 800px;
  margin: 0 auto;
}

.matieress-container {
  background-color: #f5f5f5;
  padding: 20px;
}

.matieress {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 0;
  border-bottom: 1px solid #ccc;
}

.matieress:last-child {
  border-bottom: none;
}

.notee {
  font-weight: bold;
}
.matiere-info {
  display: flex;
  align-items: center;
}

.note {
  margin-left: 10px;
  font-weight: bold;
}

.moyenne {
  margin-top: 5px;
  font-weight: bold;
  color: #888;
}

</style>

  
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
  

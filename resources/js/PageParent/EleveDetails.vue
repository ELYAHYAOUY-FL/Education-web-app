<template>
    <div>
        <NavBar :eleveId="eleve.id" />
        <div>
            <div v-if="lastNote">
      <h2>la dernier note déposé</h2>
      <p>Matiere: {{ lastNote.matiere.titre }}</p>
      <p>Note: {{ lastNote.note.valeur }}</p>
      <!-- <router-link to="/eleve/note">details</router-link> -->
    </div>
    
    <!-- <div v-else>
      <p>No last note available.</p>
    </div> -->
        </div>
        <div class="containe"><h2> <i class="fas fa-sharp fa-solid fa-clock" style="color: #6e7b7c;"></i>Emploi Temps </h2> </div>
   
   <div class="centereziation">
   
   <div class="emploi-temps" v-if="emploiTemps.length > 0">
     <div v-for="(emplois, jour) in groupedEmploiTemps" :key="jour">
       <div class="jour-container">
         <div class="jour-header">
           <strong>{{ jour }}</strong>
         </div>
         <div class="emplois-container"> 
            <div  class="emploi"
             v-for="emploi in emplois"
             :key="emploi.id"
             :style="{ 'animation-delay': getAnimationDelay(emploi.id) }">
             
             <div @click="toggleDescription(emploi.id)" class="matiere">{{ emploi.matiere.titre }}</div>
       <div class="heure">
         {{ emploi.heure_debut ? emploi.heure_debut.slice(0, 5) : '' }} à {{ emploi.heure_fin ? emploi.heure_fin.slice(0, 5) : '' }}

       </div>
       <div v-if="emploi.showDescription" class="description">
         {{ emploi.description }}
       </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
     <div>
      
     </div>
    </div>
  </template>
  
  <script>
  import { mapGetters } from 'vuex';
  import MenuLayoutEleve from "../Layouts/MenuLayoutEleve.vue";
  import NavBar from '../src/component/navEleve.vue'

  
  export default {
    components: {
      MenuLayoutEleve ,
      NavBar
    },
    computed: {
      ...mapGetters({
        user: 'auth/user'
      }),
    },
    data() {
      return {
        lastNote:'',
        userId:'',
      
        emploiTemps: [], // Initialize as an empty array
      groupes: [],
      groupId: '',
      groupedEmploiTemps: {},
        eleve: {
        groupe: {},

        user: {},
        },
      };
    },
    mounted() {
        this.fetchEleve();
        this.fetchGroupes();
  this.fetchMatieres();

    },
    methods: {
      fetchEleve() {
        axios
          .get('/eleves/' + this.$route.params.eleveId)
          .then(response => {
            this.eleve = response.data;
            this.eleve.groupe = response.data.groupe;
            this.groupeId= this.eleve.groupe.id;
            this.eleve.user = response.data.user;
             this.userId = this.eleve.user.id;
             this.fetchlastNote(this.userId);
      console.log(this.groupeId);
             this.fetchEmploiTemps(this.groupeId);

            console.log('eleve:', this.eleve);
            console.log('groupe:', this.eleve.groupe);
          
      console.log(this.userId);
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchlastNote(userid) {
  axios
    .get('/eleves/user/notes/' +userid )
    .then(response => {
      if (response.data && Array.isArray(response.data.last_notes)) {
        const lastNotes = response.data.last_notes;
        const lastNote = lastNotes[lastNotes.length - 1]; // Get the last note from the array

        this.lastNote = lastNote; // Assign the last note to a data property (e.g., lastNote)
       
      }
    })
    .catch(error => {
      console.error(error);
    });
},
fetchGroupes() {
        axios
          .get('/groupes')
          .then(response => {
            this.groupes = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchMatieres() {
        axios
          .get('/matieres')
          .then(response => {
            this.matieres = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
toggleDescription(emploiId) {
  const emploi = this.emploiTemps.find((emploi) => emploi.id === emploiId);
  if (emploi) {
    emploi.showDescription = !emploi.showDescription;
  }
},

    getAnimationDelay(index) {
      const baseDelay = 100;
      const delay = index * baseDelay;
      return `${delay}ms`;
    },

    extractHourFromDate(dateString) {
      const date = new Date(dateString);
      const hour = date.getHours();
      const minutes = date.getMinutes();
      const formattedHour = `${hour.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
      return formattedHour;
    },
    fetchEmploiTemps(groupeId) {
  axios
    .get(`/emplois/groupe/` + groupeId)
    .then(response => {
      this.emploiTemps = response.data;
      this.groupEmploiTempsByJour(); // Call the grouping method here
    })
    .catch(error => {
      console.error("Erreur lors de la récupération de l'emploi du temps.", error);
    });
},

  groupEmploiTempsByJour() {
    const groupByJour = {};
    this.emploiTemps.forEach(emploi => {
      const jour = emploi.jour;
      if (!groupByJour[jour]) {
        groupByJour[jour] = [];
      }
      groupByJour[jour].push(emploi);
    });
    this.groupedEmploiTemps = groupByJour; // Assign grouped emploiTemps to a new data property
  },

     
    },
  };
  </script>
  <style>
   
h2{ 
  padding-top: 20px;
  padding-left: 200px;
}
.emploi-temps {
  flex-wrap: wrap;
  margin-top: 50px;
}

.jour-container {
  flex-basis: 100%;
  margin-bottom: 2px;
  
}
.centereziation{
  display: flex;
  align-items: center;
  justify-content: center;
  
}

.jour-header {
  background-color: #82bbaf;
  color: #fff;
   
  padding: 5px;
  text-align: center;
}

.emplois-container {
  display: flex;
  flex-wrap: wrap;
}

.emploi {
  background-color: #37b6c7;
  color: #fff;
  padding: 10px;
  border-radius: 4px;
  margin-right: 10px;
  margin-bottom: 10px;
  animation-name: slide-in;
  animation-duration: 0.5s;
  animation-timing-function: ease;
  animation-fill-mode: both;
  transition: opacity 0.3s ease;
}

.emploi:nth-child(2n) {
  background-color: #3d5a5c;
}

@keyframes slide-in {
  0% {
    opacity: 0;
    transform: translateX(-100%);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

.p-no-emploi {
  margin-bottom: 20px;
}

.p-no-emploi:before {
  content: "Aucun emploi du temps disponible pour ce groupe.";
  color: #777;
}

/* Animation */

@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

@keyframes slide-in {
  0% {
    opacity: 0;
    transform: translateX(-100%);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}
  
  </style>
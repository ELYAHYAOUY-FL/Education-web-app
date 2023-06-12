<template>
  <MenuLayoutEleve>


    <div>
    <div v-if="lastNote">
      <h2>Last Note</h2>
      <p>Matiere: {{ lastNote.matiere.titre }}</p>
      <p>Note: {{ lastNote.note.valeur }}</p>
      <router-link to="/eleve/note">details</router-link>
    </div>
    <div v-else>
      <p>No last note available.</p>
    </div>
  </div>
  
    <div class="containe"><h2> <i class="fas fa-sharp fa-solid fa-clock" style="color: #6e7b7c;"></i>Emploi Temps </h2> </div>
   
    <div class="centereziation">
    <div class="content-header">
      <div class="content-header">
          <ul>
      <li v-if="user.eleve && eleve.groupe">
        {{ eleve.groupe.nom }}
      </li>
    </ul>
  </div>
    </div>
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
  </MenuLayoutEleve>
</template>

<script>
import { mapGetters } from 'vuex';
import MenuLayoutEleve from "../Layouts/MenuLayoutEleve.vue";

export default {
  components: {
    MenuLayoutEleve
  },
  computed: {
    ...mapGetters({
      user: 'auth/user'
    }),
},

  data() {
    return {
        lasts:{
            note:{},
            matiere:{}
        },
       
      emploiTemps: [], // Initialize as an empty array
      groupes: [],
      groupId: '',
      groupedEmploiTemps: {},
      moyennes: {}, // Object to store the averages

    };
  },

  mounted() {
  this.fetchGroupes();
  this.fetchMatieres();
  this.fetchEleve();
  this.fetchlastNote();
},

watch: {
  emploiTemps: {
    immediate: true,
    handler() {
      this.groupEmploiTempsByJour();
    }
  }
},

  methods: {
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

    fetchEleve() {
    axios.get('/eleves/user/' + this.user.id)
      .then(response => {
        const { data } = response;
        //  const grouup = data.groupe.id;
        this.groupId = data.groupe.id;
        console.log("hello")
        this.fetchEmploiTemps();// Fetch emploi temps after setting the groupe
      })
      .catch(error => {
        console.error(error);
      });
  },

  fetchlastNote() {
  axios
    .get('/eleves/user/notes/' + this.user.id)
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

    fetchEmploiTemps() {
    console.log(this.groupId);
    axios
      .get(`/emplois/groupe/` + this.groupId)
      .then(response => {
        this.emploiTemps = response.data;
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
  }
  }
};
</script>
<style scoped> 
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
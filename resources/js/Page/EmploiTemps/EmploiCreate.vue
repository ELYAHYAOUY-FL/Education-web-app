<template>
  <MainLayout>
    <div class="container">
      <h1>Créer un emploi du temps</h1>
      <!-- Affichage du message de succès -->
      <div v-if="successMessage" class="success-message"> 
        {{ successMessage }} 
      </div>

      <div class="toggle-form">
        <button class="toggle-form-button" @click="showForm = !showForm">
          <i class="fa fa-plus-circle"></i> Ajouter un emploi du temps
        </button>
      </div>

      <form v-if="showForm" @submit.prevent="saveTimetable" class="timetable-form">
        <div>
          <label>Jour:</label>
          <select v-model="jour" required>
            <option value="">Sélectionner un jour</option>
            <option value="Lundi">Lundi</option>
            <option value="Mardi">Mardi</option>
            <option value="Mercredi">Mercredi</option>
            <option value="Jeudi">Jeudi</option>
            <option value="Vendredi">Vendredi</option>
          </select>
        </div>
        <div>
          <label>Heure de début:</label>
          <input type="time" v-model="heureDebut" required>
        </div>

        <div>
          <label>Matière:</label>
          <select v-model="matiereId" required @change="updateSelectedMatiere">
            <option value="">Sélectionner une matière</option>
            <option v-for="matiere in matieres" :key="matiere.id" :value="matiere.id">{{ matiere.titre }}</option>
          </select>
        </div>
        <div>
          <label>Groupe:</label>
          <select v-model="groupeId" required @change="updateSelectedGroupe">
            <option value="">Sélectionner un groupe</option>
            <option v-for="groupe in groupes" :key="groupe.id" :value="groupe.id">{{ groupe.nom }}</option>
          </select>
        </div>
        <div class="form-buttons">
          <button type="submit">Enregistrer</button>
          <button type="button" @click="cancelForm">Annuler</button>
        </div>
      </form>
<!-- *************************************************************************************     ** -->
      <h1>Emploi temps</h1>
      <div class="select-groupe">
        <label for="groupe">Sélectionnez un groupe :</label>
        <select id="groupe" v-model="selectedGroupe" @change="fetchEmploiTemps">
          <option v-for="groupe in groupes" :value="groupe.id" :key="groupe.id">{{ groupe.nom }}</option>
        </select>
      </div>

      <div class="emploi-temps" v-if="emploiTemps.length > 0">
        <template v-for="(emplois, jour) in emploiTempsGroupedByJour" :key="jour">
          <div class="jour-container">
            <div class="jour-header">
              <strong>{{ jour }}</strong>
            </div>
            <div class="emplois-container">
              <div
                class="emploi"
                v-for="emploi in emplois"
                :key="emploi.id"
                :style="{ 'animation-delay': getAnimationDelay(emploi.id) }"
              >
                {{ emploi.matiere_titre }} à {{ extractHourFromDate(emploi.heure_debut) }}
              </div>
            </div>
          </div>
        </template>
       </div>
      <p v-else class="p-no-emploi">Aucun emploi du temps disponible pour ce groupe.</p>
    </div>
  </MainLayout>
</template>




<script>
import MainLayout from '../../Layouts/MainLayout.vue';
export default {
  name: 'EmploiTemps',
  components: { MainLayout },
  data() {
    return {
      jour: "",
      heureDebut: "",
      matiereId: "",
      groupeId: "",
      matieres: [], // Liste des matières
      groupes: [], // Liste des groupes
      selectedGroupe: null,
      emploiTemps: {},
      successMessage: "",
      errorMessage: "" ,
      showForm: false,
    };
  },
  mounted() {
    this.fetchGroupes();
    this.fetchMatieres();
  },
  computed: {
    emploiTempsGroupedByJour() {
      const groupByJour = {};
      this.emploiTemps.forEach(emploi => {
        const jour = emploi.jour;
        if (!groupByJour[jour]) {
          groupByJour[jour] = [];
        }
        groupByJour[jour].push(emploi);
      });
      return groupByJour;
    },
  },
  methods: {
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

    fetchMatieres() {
      axios
        .get('/matieres')
        .then(response => {
          this.matieres = response.data;
        })
        .catch(error => {
          console.error("Erreur lors de la récupération de la liste des matières.", error);
        });
    },
    fetchGroupes() {
      axios
        .get('/groupes')
        .then(response => {
          this.groupes = response.data;
        })
        .catch(error => {
          console.error("Erreur lors de la récupération de la liste des groupes.", error);
        });
    },
    fetchEmploiTemps() {
      if (this.selectedGroupe) {
        axios
          .get(`/emplois?groupe_id=${this.selectedGroupe}`)
          .then(response => {
            this.emploiTemps = response.data;
          })
          .catch(error => {
            console.error("Erreur lors de la récupération de l'emploi du temps.", error);
          });
      } else {
        this.emploiTemps = [];
      }
    },
    saveTimetable() {
      const emploiTemps = {
        jour: this.jour,
        heure_debut: this.heureDebut,
        matiere_id: this.matiereId,
        groupe_id: this.groupeId
      };

      axios
        .post("/emplois", emploiTemps)
        .then(response => {
          this.errorMessage = ""; // Réinitialiser le message d'erreu
          this.successMessage = "Emploi du temps enregistré avec succès.";
          this.resetForm();
          console.log("Emploi du temps enregistré avec succès.", response.data);
        })
        .catch(error => {
          this.successMessage = ""; // Réinitialiser le message de succès
          this.errorMessage = "Erreur lors de l'enregistrement de l'emploi du temps.";
          console.error("Erreur lors de l'enregistrement de l'emploi du temps.", error);
        });
    },
    updateSelectedMatiere() {
      if (this.matiereId) {
        axios
          .get(`/matieres/${this.matiereId}`)
          .then(response => {
            const matiereDetails = response.data;
            console.log("Détails de la matière :", matiereDetails);
          })
          .catch(error => {
            console.error("Erreur lors de la récupération des détails de la matière.", error);
          });
      }
    },
    updateSelectedGroupe() {
      if (this.groupeId) {
        axios
          .get(`/groupes/${this.groupeId}`)
          .then(response => {
            const groupeDetails = response.data;
            console.log("Détails du groupe :", groupeDetails);
          })
          .catch(error => {
            console.error("Erreur lors de la récupération des détails du groupe.", error);
          });
      }
    },
    resetForm() {
      this.jour = "";
      this.heureDebut = "";
      this.matiereId = "";
      this.groupeId = "";
    }
  }
}
</script>


<style scoped>
.container {
  margin: 20px;
}

.success-message {
  background-color: #dff0d8;
  color: #3c763d;
  padding: 10px;
  margin-bottom: 10px;
}

.toggle-form {
  margin-bottom: 10px;
}

.toggle-form-button {
  background-color: #337ab7;
  color: #fff;
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.toggle-form-button:hover {
  background-color: #286090;
}

.timetable-form {
  margin-bottom: 20px;
}

.timetable-form div {
  margin-bottom: 10px;
}

.timetable-form label {
  display: inline-block;
  width: 100px;
}

.timetable-form select,
.timetable-form input[type="time"] {
  padding: 5px;
}

.form-buttons {
  margin-top: 10px;
}

.form-buttons button {
  background-color: #5cb85c;
  color: #fff;
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-right: 10px;
}

.form-buttons button:hover {
  background-color: #449d44;
}

.select-groupe {
  margin-bottom: 20px;
}

.select-groupe label {
  margin-right: 10px;
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
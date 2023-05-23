<template>
  <MainLayout>
    <h1 class="text-center">Liste des étudiants</h1>
    <div class="container row">
      <div v-for="eleve in eleves" :key="eleve.id" class="col-md-4 mb-4 fade-in">
        <div class="card-header">
          <h5 class="card-title">{{ eleve.nom_francais }}</h5>
        </div>
        <div class="card-body" v-if="!eleve.editMode">
          <div class="row">
            <div class="col-md-3">
              <img :src="'/photos/' + eleve.photo" alt="Photo" class="eleve-photo img-fluid rounded-circle">
            </div>
            <div class="col-md-9">
              <p class="card-text" @click="toggleDetails(eleve)" style="padding: 20px;">
                Prénom: {{ eleve.prenom_francais }}
              </p>
              <p class="card-text" @click="toggleDetails(eleve)">
                Nom: {{ eleve.nom_francais }}
              </p>
              <transition name="fade">
                <div v-if="eleve.detailsVisible">
                  <p class="card-text">Classe: {{ eleve.classe.nom }}</p>
                  <p class="card-text">CNE: {{ eleve.CNE }}</p>
                  <p class="card-text">Date de naissance: {{ formatBirthDate(eleve.date_naissance) }}</p>
                </div>
              </transition>
            </div>
          </div>
        </div>
        <div class="card-body" v-else>
          <form @submit="updateEleve(eleve)">
         <div>
    <label for="nom_francais">Nom (Français):</label>
    <input type="text" id="nom_francais" v-model="eleve.nom_francais">
     
       </div>
  <div>
    <label for="nom_arabe">Nom (Arabe):</label>
    <input type="text" id="nom_arabe" v-model="eleve.nom_arabe">
    
  </div>
  <div>
    <label for="prenom_francais">Prénom (Français):</label>
    <input type="text" id="prenom_francais" v-model="eleve.prenom_francais">
     
  </div>
  <div>
    <label for="prenom_arabe">Prénom (Arabe):</label>
    <input type="text" id="prenom_arabe" v-model="eleve.prenom_arabe">
     
  </div>
  <div>
    <label for="date_naissance">Date de naissance:</label>
    <input type="date" id="date_naissance" v-model="eleve.date_naissance">
    
  </div>
  <div>
    <label for="lieu_naissance">Lieu de naissance:</label>
    <input type="text" id="lieu_naissance" v-model="eleve.lieu_naissance">
     
  </div>
  <div>
    <label for="sex">Sexe:</label>
    <select id="sex" v-model="eleve.sex">
      <option value="male">Male</option>
      <option value="female">Female</option>
    </select>
    
  </div>
  <div>
    <label for="photo">Photo:</label>
    <input  type="file" id="photo" @change="onFileChange"  >
     
  </div>
  <div>
    <label for="CNE">CNE:</label>
    <input type="text" id="CNE" v-model="eleve.CNE">
     
  </div>
  <div>
    <label for="classe_id">Classe:</label>
    <select id="classe_id" v-model="eleve.classe_id">
      <option v-for="classe in classes" :key="classe.id" :value="classe.id">{{ classe.nom }}</option>
    </select>
     
  </div>
  <div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
   <button class="btn btn-secondary" @click="cancelEditMode(eleve)">Annuler</button>
  </div>
</form>

        </div>
        <div class="card-footer">
          <button class="btn btn" style="color: rgb(15, 189, 160);" @click="deleteEleve(eleve.id)">
            <i class="fa fa-trash"></i>
          </button>
          <button class="btn btn" style="color: rgb(40, 112, 100);" @click="toggleEditMode(eleve)">
            <i class="fa fa-pencil"></i>
          </button>
        </div>
      </div>
    </div>
  </MainLayout>
</template>


<style scoped>
.fade-in {
  animation: fadeIn 0.5s ease-in-out;
  transition: all 0.4s ease-in-out;

}

@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: translateY(10px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}
.fade-in:hover {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.card-header {
  background-color: rgb(62, 148, 148);
  padding: 10px;
  text-align: center;
}

.card-title {
  margin-bottom: 0;
}

.eleve-photo {
  
  width: 100px;
  height: 90px;
  object-fit: cover;
}

.card-text {
  margin-bottom: 0;
  cursor: pointer;
}

 
</style>





<script>
import moment from 'moment';

import axios from 'axios';
import MainLayout from '../../Layouts/MainLayout.vue';

export default {
  components: { MainLayout },
  data() {
  return {
    eleves: [],
    photo: null,
    classes: [],
    nouvellePhoto: null, 
  };
},
  mounted() {
    this.fetchEtudiants();
    this.fetchClasses();
  },
  methods: {
    fetchClasses() {
      axios.get('/api/classes')
        .then(response => {
          this.classes = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
   
    fetchEtudiants() {
      axios
        .get('/api/eleves')
        .then(response => {
          this.eleves = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    async deleteEleve(id) {
  try {
    const response = await axios.delete(`/api/eleves/${id}`);
    this.eleves = this.eleves.filter(eleve => eleve.id !== id);
  } catch (error) {
    console.log(error);
  }
},
    toggleDetails(eleve) {
      eleve.detailsVisible = !eleve.detailsVisible;
    },
    formatBirthDate(date) {
      return moment(date).format('YYYY-MM-DD');
    },

    onFileChange(event) {
      this.nouvellePhoto = event.target.files[0];
    },

    toggleEditMode(eleve) {
      eleve.editMode = !eleve.editMode;
    },
    updateEleve(eleve) {
  const updatedEleve = {
    id: eleve.id,
    prenom_francais: eleve.prenom_francais,
    nom_francais: eleve.nom_francais,
    date_naissance: eleve.date_naissance,
    lieu_naissance: eleve.lieu_naissance,
    sex: eleve.sex,
    CNE: eleve.CNE,
    classe_id: eleve.classe_id,
    photo: this.nouvellePhoto, 
    
  };
  axios
    .put(`/api/eleves/${eleve.id}`, updatedEleve)
    .then((response) => {
      console.log(response.data); 
      eleve.editMode = false;
    })
    .catch((error) => {
      console.error(error); 
    });
},

    cancelEditMode(eleve) {
      eleve.editMode = false;
    },
  },
};
</script>
 
 
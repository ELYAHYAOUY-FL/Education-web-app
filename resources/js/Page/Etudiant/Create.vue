<template>
  <MainLayout>
  <div>
    <h1>Create New Student</h1>
    <form @submit.prevent="submitForm">
      <div>
        <label for="nom_francais">Nom (Français):</label>
        <input type="text" id="nom_francais" v-model="formData.nom_francais">
        <span v-if="errors.nom_francais" class="error">{{ errors.nom_francais[0] }}</span>
      </div>
      <div>
        <label for="nom_arabe">Nom (Arabe):</label>
        <input type="text" id="nom_arabe" v-model="formData.nom_arabe">
        <span v-if="errors.nom_arabe" class="error">{{ errors.nom_arabe[0] }}</span>
      </div>
      <div>
        <label for="prenom_francais">Prénom (Français):</label>
        <input type="text" id="prenom_francais" v-model="formData.prenom_francais">
        <span v-if="errors.prenom_francais" class="error">{{ errors.prenom_francais[0] }}</span>
      </div>
      <div>
        <label for="prenom_arabe">Prénom (Arabe):</label>
        <input type="text" id="prenom_arabe" v-model="formData.prenom_arabe">
        <span v-if="errors.prenom_arabe" class="error">{{ errors.prenom_arabe[0] }}</span>
      </div>
      <div>
        <label for="date_naissance">Date de naissance:</label>
        <input type="date" id="date_naissance" v-model="formData.date_naissance">
        <span v-if="errors.date_naissance" class="error">{{ errors.date_naissance[0] }}</span>
      </div>
      <div>
        <label for="lieu_naissance">Lieu de naissance:</label>
        <input type="text" id="lieu_naissance" v-model="formData.lieu_naissance">
        <span v-if="errors.lieu_naissance" class="error">{{ errors.lieu_naissance[0] }}</span>
      </div>
      <div>
        <label for="sex">Sexe:</label>
        <select id="sex" v-model="formData.sex">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
        <span v-if="errors.sex" class="error">{{ errors.sex[0] }}</span>
      </div>
      <div>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" @change="onFileChange">
        <span v-if="errors.photo" class="error">{{ errors.photo[0] }}</span>
      </div>
      <div>
        <label for="CNE">CNE:</label>
        <input type="text" id="CNE" v-model="formData.CNE">
        <span v-if="errors.CNE" class="error">{{ errors.CNE[0] }}</span>
      </div>
      <div>
        <label for="classe_id">Classe:</label>
        <select id="classe_id" v-model="formData.classe_id">
          <option v-for="classe in classes" :key="classe.id" :value="classe.id">{{ classe.nom }}</option>
        </select>
        <span v-if="errors.classe_id" class="error">{{ errors.classe_id[0] }}</span>
      </div>
      <div>
        <button type="submit">Add</button>
      </div>
    </form>
  </div>
</MainLayout>
</template>

<script>
import axios from 'axios';
import MainLayout from '../../Layouts/MainLayout.vue';

export default {
  components: { MainLayout },
  data() {
    return {
      formData: {
        nom_francais: '',
        nom_arabe: '',
        prenom_francais: '',
        prenom_arabe: '',
        date_naissance: '',
        lieu_naissance: '',
        sex: '',
        photo: null,
        CNE: '',
        classe_id: '',
        // user_id: '',
      },
      errors: {},
      classes: [], 
      // users:[],// Tableau des classes disponibles
    };
  },
  mounted() {
    this.fetchClasses();
    // this.fetchUsers(); // Récupérer les classes disponibles lors du montage du composant
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
    // fetchUsers(){

    // },
    onFileChange(event) {
      this.formData.photo = event.target.files[0];
    },
    submitForm() {
      this.errors = {}; // Réinitialiser les erreurs

      // Créer un objet FormData pour envoyer les données du formulaire en tant que multipart/form-data
      const formData = new FormData();
      formData.append('nom_francais', this.formData.nom_francais);
      formData.append('nom_arabe', this.formData.nom_arabe);
      formData.append('prenom_francais', this.formData.prenom_francais);
      formData.append('prenom_arabe', this.formData.prenom_arabe);
      formData.append('date_naissance', this.formData.date_naissance);
      formData.append('lieu_naissance', this.formData.lieu_naissance);
      formData.append('sex', this.formData.sex);
      formData.append('photo', this.formData.photo);
      formData.append('CNE', this.formData.CNE);
      formData.append('classe_id', this.formData.classe_id);

      axios
        .post('/api/eleves', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then(response => {
          // Succès : faire quelque chose avec la réponse
          console.log(response.data);
          // Rediriger ou afficher un message de succès, par exemple :
         
        })
        .catch(error => {
          // Erreur : afficher les erreurs de validation
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
          console.error(error);
        });
    },
  },
};
</script>

<style>
.error {
  color: red;
}
</style>

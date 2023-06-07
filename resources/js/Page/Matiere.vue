<template>
  <MainLayout> 
  <div>
    <!-- Affichage des matières -->
    <div v-for="matiere in matieres" :key="matiere.id">
      <h3>{{ matiere.titre }}</h3>
      <h3>{{ matiere.coefficient }}</h3>
      <p>{{ matiere.description }}</p>
      <button @click="downloadPdf(matiere.pdf)">Télécharger PDF</button>
      <button @click="editMatiere(matiere)">Modifier</button>
    </div>

    <div v-if="editingMatiere">
      <form @submit.prevent="updateMatiere">
  <div>
    <label for="titre">Titre :</label>
    <input v-model="editMatiereData.titre" type="text" id="titre" placeholder="Titre" required>
  </div>
  <div>
    <label for="coefficient">Coefficient :</label>
    <input v-model="editMatiereData.coefficient" type="number" id="coefficient" placeholder="Coefficient" required>
  </div>
  <div>
    <label for="description">Description :</label>
    <textarea v-model="editMatiereData.description" id="description" placeholder="Description" required></textarea>
  </div>
  <div>
    <label for="pdf">PDF :</label>
    <input ref="pdfFile" type="file" accept="application/pdf" id="pdf">
  </div>
  <div>
    <button type="submit">Enregistrer</button>
    <button type="button" @click="cancelEdit">Annuler</button>
  </div>
</form>

    </div>

    <!-- Formulaire d'ajout/modification -->
    <form @submit.prevent="saveMatiere">
      <input type="text" v-model="matiere.titre" placeholder="Titre" required>
      <textarea v-model="matiere.description" placeholder="Description" required></textarea>
      <input type="number" v-model="matiere.coefficient" placeholder="coefficient" required> 
      <input type="file" @change="onFileChange">
      <button type="submit">Enregistrer</button>
    </form>
  </div>
</MainLayout>
</template>




<script>
import MainLayout from '../Layouts/MainLayout.vue';
export default {
   
  components: { MainLayout },
  data() {
    return {
      matieres: [],
      matiere: {
        titre: '',
        description: '',
        coefficient: '',
        pdf: null
      },
      editingMatiere: null,
      editMatiereData: {
        titre: '',
        description: '',
        coefficient: '',
        pdf: null
      }
    };
  },
  created() {
    this.fetchMatieres();
  },
  methods: {
    fetchMatieres() {
      // Appel à l'API pour récupérer les matières depuis Laravel
      axios.get('/matieres')
        .then(response => {
          this.matieres = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    downloadPdf(filename) {
      // Appel à l'API pour télécharger le fichier PDF
      axios.get(`/matieres/${filename}/download`, { responseType: 'blob' })
        .then(response => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', filename);
          document.body.appendChild(link);
          link.click();
        })
        .catch(error => {
          console.log(error);
        });
    },
    onFileChange(event) {
      this.matiere.pdf = event.target.files[0];
    },
    saveMatiere() {
      let formData = new FormData();
      formData.append('titre', this.matiere.titre);
      formData.append('description', this.matiere.description);
      formData.append('coefficient', this.matiere.coefficient);
      formData.append('pdf', this.matiere.pdf);

      // Envoi du formulaire vers Laravel pour enregistrer la matière
      axios.post('/matieres', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
        .then(response => {
          this.matiere.titre = '';
          this.matiere.description = '';
          this.matiere.coefficient = '';
          this.matiere.pdf = null;
          this.fetchMatieres();
        })
        .catch(error => {
          console.error(error);
        });
    },
    editMatiere(matiere) {
      this.editingMatiere = matiere;
      this.editMatiereData.titre = matiere.titre;
      this.editMatiereData.description = matiere.description;
      this.editMatiereData.coefficient = matiere.coefficient;
      this.editMatiereData.pdf = null;
    },
    cancelEdit() {
      this.editingMatiere = null;
      this.editMatiereData.titre = '';
      this.editMatiereData.coefficient = '';
      this.editMatiereData.description = '';
      this.editMatiereData.pdf = null;
    },
    updateMatiere() {
      const formData = new FormData();
      formData.append('titre', this.editMatiereData.titre);
      formData.append('description', this.editMatiereData.description);
      formData.append('coefficient', this.editMatiereData.coefficient);
      formData.append('pdf', this.$refs.pdfFile.files[0]);
      console.log('error')
      axios.put(`/matieres/${this.editingMatiere.id}/update`, formData)
        .then(response => {
          // Mise à jour réussie, mettre à jour la liste des matières et réinitialiser les données d'édition
          this.fetchMatieres();
          this.cancelEdit();
          console.log('error2')
        })
        .catch(error => {
          console.error(error);
        });
    },
  }
};
</script>

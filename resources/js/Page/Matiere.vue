<template>
  <MainLayout> 
  <div>
    <div class="buttonContaine">
        <button class="acceptButto" @click="toggleForm(matiere)"> + Ajouter</button>
        <transition name="fade">
        <div v-if="matiere.showForm">
          <form @submit.prevent="saveMatiere(matiere)" >
            <input type="text" v-model="matiere.titre" placeholder="Titre" required>
            <textarea v-model="matiere.description" placeholder="Description" required></textarea>
            <input type="number" v-model="matiere.coefficient" placeholder="Coefficient" required> 
            <label> Fichier: </label>
              <input type="file" @change="onFileChange"> 
              
            <button type="submit">Enregistrer</button>
           
          </form>
        
        </div>
      </transition>
      </div>
      <transition name="slide">
      <div v-if="editingMatiere" ref="editForm">
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
  </transition>  
      <div class="matieres-container">
  <div v-for="matiere in matieres" :key="matiere.id" class="card matiere">
    <div class="flexicon">
      <i class="fas fa-flask icon-large"></i> 
  <i class="fas fa-microscope icon-medium"></i> 
  <i class="fas fa-globe-americas icon-small"></i> 
  <i class="fas fa-scroll icon-x-large"></i>  
    </div>
    <p class="cookieHeading" @click="toggleDescription(matiere)"><h3>{{ matiere.titre }}</h3> </p>
    <div v-if="matiere.showDescription">
    <p class="cookieDescription" >{{ matiere.description }}</p>
      <h3>Coefficient :{{ matiere.coefficient }}</h3>
      <button class="declineButton"  @click="editMatiere(matiere)">Modifier</button>
    </div>
      
    <div class="buttonContainer">
      <button class="acceptButton" @click="downloadPdf(matiere.pdf)">Télécharger PDF</button>
    </div>
  </div>
</div>
  
  </div>
  
</MainLayout>
</template>
<style>
.fade-enter-active,
.fade-leave-active,
.slide-enter-active,
.slide-leave-active {
  transition: opacity 0.5s, transform 0.5s;
}

.fade-enter,
.fade-leave-to,
.slide-enter,
.slide-leave-to {
  opacity: 0;
}

.slide-enter,
.slide-leave-to {
  transform: translateY(20px);
}
.card.matiere i.icon-large {
  font-size: 27px; /* Taille d'icône large */
}

.card.matiere i.icon-medium {
  font-size: 27px; /* Taille d'icône moyenne */
}

.card.matiere i.icon-small {
  font-size: 27px; /* Taille d'icône petite */
}

.card.matiere i.icon-x-large {
  font-size: 27px; /* Taille d'icône très grande */
}

.matieres-container {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  margin-left: 30px;
  
}
 
.matiere {
  margin-top: 30px;
  width: 300px;
  height: auto;
  background-color: rgb(255, 255, 255);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px 30px;
  gap: 13px;
  position: relative;
  overflow: hidden;
  box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.062);
}

#cookieSvg {
  width: 50px;
}

#cookieSvg g path {
  fill: rgb(97, 81, 81);
}

.flexicon{
  display: flex;
  
   
}
 
.cookieHeading {
  font-size: 1.2em;
  font-weight: 800;
  color: rgb(26, 26, 26);
}

.cookieDescription {
  text-align: center;
  font-size: 0.7em;
  font-weight: 600;
  color: rgb(99, 99, 99);
}

.buttonContainer {
  display: flex;
  gap: 20px;
  flex-direction: row;
}

.acceptButton {
  width: 150px;
  height: auto;
  background-color: #35998c;
  transition-duration: .2s;
  border: none;
  color: rgb(241, 241, 241);
  cursor: pointer;
  font-weight: 600;
  border-radius: 20px;
}

.declineButton {
  width: 150px;
  height: auto;
  background-color: rgb(218, 218, 218);
  transition-duration: .2s;
  color: rgb(46, 46, 46);
  border: none;
  cursor: pointer;
  font-weight: 600;
  border-radius: 20px;
}

.declineButton:hover {
  background-color: #ebebeb;
  transition-duration: .2s;
}

.acceptButton:hover {
  background-color: #25796d;
  transition-duration: .2s;
}
</style>



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
    toggleForm(matiere) {
    matiere.showForm = !matiere.showForm;
  },
    toggleDescription(matiere) {
    matiere.showDescription = !matiere.showDescription;
  },
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
          matiere.showForm = false;
        })
        .catch(error => {
          console.error(error);
        });
    },
    editMatiere(matiere) {
      matiere.showForm = true;
      this.editingMatiere = matiere;
      this.editMatiereData.id = matiere.id;
      this.editMatiereData.titre = matiere.titre;
      this.editMatiereData.description = matiere.description;
      this.editMatiereData.coefficient = matiere.coefficient;
      this.editMatiereData.pdf = null;

      // Faire défiler jusqu'au formulaire
      this.$nextTick(() => {
        const formElement = this.$refs.editForm;
        formElement.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      });
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

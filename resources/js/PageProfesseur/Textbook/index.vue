<template>
  <MainLayoutProf>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2>Ajouter un cahier de texte</h2>
          <form v-if="!editMode" @submit.prevent="addTextbook" class="textbook-form">
            <div class="form-group">
              <input type="text" v-model="form.title" class="form-control" placeholder="Titre" required>
            </div>
            <div class="form-group">
              <textarea v-model="form.description" class="form-control" placeholder="Description"></textarea>
            </div>
            <div class="form-group">
              <input type="date" v-model="form.date" class="form-control" required>
            </div>
            <div class="form-group">
              <input type="time" v-model="form.heure" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-add"><i class="fas fa-plus"></i> Ajouter</button>
          </form>
            <!-- Formulaire pour modifier un cahier de texte -->
    <form  v-else @submit.prevent="updateTextbook" class="textbook-form">
      <div class="form-group">
        <input type="text" v-model="editForm.title" class="form-control" required>
      </div>
      <div class="form-group">
        <textarea v-model="editForm.description" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <input type="date" v-model="editForm.date" class="form-control" required>
      </div>
      <div class="form-group">
        <input type="time" v-model="editForm.heure" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Mettre à jour</button>
      <button @click="cancelEdit" class="btn btn-danger"><i class="fas fa-times"></i> Annuler</button>
    </form>
        </div>
        <div class="col-md-6">
          <h2>Mes Cahiers de Texte</h2>
          <div v-for="textbook in textbooks" :key="textbook.id" class="textbook-item">
            <h3 @click="toggleDescription(textbook.id)" class="textbook-title">{{ textbook.title }}</h3>
            <p v-if="isDescriptionVisible(textbook.id)" class="textbook-description">{{ textbook.description }}</p>
            <div class="textbook-details">
              <p>Date: {{ textbook.date }}</p>
              <p>Heure: {{ textbook.heure }}</p>
            </div>
            <button @click="editTextbook(textbook)" class="btn btn-secondary btn-edit"><i class="fas fa-edit"></i> Modifier</button>
            <button @click="deleteTextbook(textbook.id)" class="btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i> Supprimer</button>
          </div>
        </div>
      </div>
    </div>

  
  </MainLayoutProf>
</template>



<style>
.textbook-item {
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.textbook-item:hover {
  background-color: #f5f5f5;
}

.textbook-title {
  cursor: pointer;
}

.textbook-description {
  margin-top: 10px;
}

.textbook-details {
  margin-top: 10px;
  color: #888;
}

.btn-add {
  animation: fadeInUp 0.5s ease;
}

.btn-edit {
  animation: fadeInLeft 0.5s ease;
}

.btn-delete {
  animation: fadeInRight 0.5s ease;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeInLeft {
  from {
    opacity: 0;
    transform: translateX(-20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes fadeInRight {
  from {
    opacity: 0;
    transform: translateX(20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}


</style>


<!-- <script>
import MainLayoutProf from "../../Layouts/MainLayoutProf.vue";
import axios from 'axios';
export default {
  name: "Prof",
    components: { MainLayoutProf },
  data() {
    return {
      textbooks: [],
      selectedTextbook: null,
      form: {
        title: "",
        description: "",
        date: "",
        heure: "",
      },
      editMode: false,
       
    };
  },
  created() {
    this.getTextbooks();
  },
  methods: {
    getTextbooks() {
      // Faites une requête à votre backend pour récupérer les textbooks
      axios.get('/textbooks')
        .then(response => {
          this.textbooks = response.data;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des textbooks:', error);
        });
    },
    showTextbookDetails(textbookId) {
      // Recherche du textbook correspondant dans la liste
      this.selectedTextbook = this.textbooks.find(textbook => textbook.id === textbookId);
    },
  
    editTextbook(textbook) {
    this.editMode = true;
    this.form = {
      id: textbook.id,
      title: textbook.title,
      description: textbook.description,
      date: textbook.date,
      heure: textbook.heure
    };
  },
  submitForm() {
    if (this.editMode) {
      // Appel à l'API pour mettre à jour le cahier de texte existant
      axios.put(`/api/textbooks/${this.form.id}`, this.form)
        .then(response => {
          // Afficher les modifications dans la vue
          const index = this.textbooks.findIndex(item => item.id === this.form.id);
          if (index !== -1) {
            this.textbooks[index] = { ...this.form };
          }
          this.cancelEdit();
        })
        .catch(error => {
          console.log(error);
          // Gérer l'erreur de mise à jour
        });
    } 
  },
  cancelEdit() {
    this.editMode = false;
    this.resetForm();
  },
  resetForm() {
    this.form = {
      id: null,
      title: '',
      description: '',
      date: '',
      heure: ''
    };
  },

    
    supprimertexbook(id) {
      if (confirm("Êtes-vous sûr de vouloir supprimer ce Textbook?")) {
        axios
          .delete(`/api/textbooks/${id}`)
          .then(response => {
            this.textbooks = this.textbooks.filter(textbook => textbook.id !== id);
            console.log(' Textbook deleted successfully');
          })
          .catch(error => {
            console.log(error.response);
          });
      }
    },
    createTextbook() {
  // Effectuer une requête HTTP pour créer un nouveau cahier de texte
  const newTextbook = {
    title: this.form.title,
    description: this.form.description,
    date: this.form.date,
    heure: this.form.heure
  };

  axios.post('/textbooks', newTextbook)
    .then(response => {
      // Ajouter le nouveau cahier de texte à la liste
      this.textbooks.push(response.data);
      console.log('Textbook created successfully');
    })
    .catch(error => {
      console.error('Erreur lors de la création du cahier de texte:', error);
    });
},


//     submitForm() {
//       if (this.editMode) {
//         this.updateTextbook();
//       } else {
//         this.createTextbook();
//       }
//       this.resetForm();
//     },
//     cancelEdit() {
//   // Annuler l'édition, réinitialiser le formulaire
//   this.editMode = false;
//   this.resetForm();
  
//   // Restaurer les valeurs d'origine du cahier de texte
//   const editedIndex = this.textbooks.findIndex(textbook => textbook.id === this.editedTextbookId);
//   if (editedIndex !== -1) {
//     this.textbooks[editedIndex] = { ...this.originalTextbook };
//   }
// },

    // resetForm() {
    //   this.form.title = "";
    //   this.form.description = "";
    //   this.form.date = "";
    //   this.form.heure = "";
    // },
 }
     
  }
</script> -->
<script>
import MainLayoutProf from "../../Layouts/MainLayoutProf.vue";
export default {
  name: "Prof",
    components: { MainLayoutProf },
  data() {
    return {
      textbooks: [],
      form: {
        title: '',
        description: '',
        date: '',
        heure: '',
      },
      editMode: false,
      editForm: null,
      visibleDescriptions: []
    };
    
  },
  mounted() {
    this.getTextbooks();
  },
  methods: {
    // Récupérer la liste des cahiers de texte
    getTextbooks() {
      axios.get('/api/textbooks')
        .then(response => {
          this.textbooks = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    // Ajouter un cahier de texte
    addTextbook() {
      axios.post('/api/textbooks', this.form)
        .then(response => {
          this.textbooks.push(response.data);
          this.resetForm();
        })
        .catch(error => {
          console.log(error);
        });
    },
    // Modifier un cahier de texte
    editTextbook(textbook) {
      this.editMode = true;
  this.editForm = {
    id: textbook.id,
    title: textbook.title,
    description: textbook.description,
    date: textbook.date,
    heure: textbook.heure,
  };
},

    // Mettre à jour un cahier de texte
    updateTextbook() {
      axios.put(`/api/textbooks/${this.editForm.id}`, this.editForm)
        .then(response => {
          const index = this.textbooks.findIndex(item => item.id === this.editForm.id);
          if (index !== -1) {
            this.textbooks[index] = response.data;
          }
          this.cancelEdit();
        })
        .catch(error => {
          console.log(error);
        });
    },
    // Annuler la modification d'un cahier de texte
    cancelEdit() {
      this.editMode = false;
      this.editForm = null;
    },
    // Supprimer un cahier de texte
    deleteTextbook(id) {
      axios.delete(`/api/textbooks/${id}`)
        .then(response => {
          this.textbooks = this.textbooks.filter(item => item.id !== id);
        })
        .catch(error => {
          console.log(error);
        });
    },
    // Réinitialiser le formulaire
    resetForm() {
      this.form = {
        title: '',
        description: '',
        date: '',
        heure: '',
      };
    },
    toggleDescription(textbookId) {
      if (this.isDescriptionVisible(textbookId)) {
        const index = this.visibleDescriptions.indexOf(textbookId);
        if (index !== -1) {
          this.visibleDescriptions.splice(index, 1);
        }
      } else {
        this.visibleDescriptions.push(textbookId);
      }
    },
    isDescriptionVisible(textbookId) {
      return this.visibleDescriptions.includes(textbookId);
    },
  },
};
</script>
 
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
              <input type="time" v-model="form.heure"  class="form-control" required>
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
        <input type="time" v-model="editForm.heure"  class="form-control" required>
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
<script>
import MainLayoutProf from "../../Layouts/MainLayoutProf.vue";
import { mapGetters } from 'vuex';

export default {
  name: "Prof",
    components: { MainLayoutProf },
    computed: {
      ...mapGetters({
        user: 'auth/user'
      }),
    },
  data() {
    return {
      textbooks: [],
      form: {
        title: '',
        description: '',
        date: '',
        heure: '',
        professeur_id :'',
      },
      textbookId:'',
      editMode: false,
      editForm: null,
      visibleDescriptions: []
    };
    
  },
  mounted() {
    this.getTextbooks();
    this.fetchProf();
  },
  methods: {
    // Récupérer la liste des cahiers de texte
    fetchProf() {
    axios.get('/professeurs/user/' + this.user.id)
      .then(response => {
        const { data } = response;
        //  const grouup = data.groupe.id;
        this.textbookId = data.id;

        console.log(this.textbookId)
        this.getTextbooks();// Fetch emploi temps after setting the groupe
      })
      .catch(error => {
        console.error(error);
      });
  },
    getTextbooks() {
      axios.get('/textbooks/getbyProf/' + this.textbookId)
        .then(response => {
          this.textbooks = response.data;
        
          console.log(this.textbooks)
        })
        .catch(error => {
          console.log(error);
        });
    },
    // Ajouter un cahier de texte
    addTextbook() {
      this.form.professeur_id= this.textbookId
      console.log(this.form.professeur_id)
      axios.post('/textbooks', this.form)
        .then(response => {
          // this.textbooks.push(response.data);
          this.getTextbooks();
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
      axios.put(`/textbooks/${this.editForm.id}`, this.editForm)
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
      axios.delete(`/textbooks/${id}`)
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
 
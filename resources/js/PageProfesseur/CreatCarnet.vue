<template>
    <div>
      <h2>Carnet de notes</h2>
      <button @click="toggleForm" class="btn btn-primary mt-3">{{ showForm ? 'Masquer le formulaire' : 'Afficher le formulaire' }}</button>
          <br><br><br> 
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li v-for="(carnetNote, index) in carnetNotes" :key="carnetNote.id" :data-target="'#carouselExampleIndicators'" :data-slide-to="index" :class="{ active: index === 0 }"></li>
        </ol>
        <div class="carousel-inner">
          <div v-for="(carnetNote, index) in carnetNotes" :key="carnetNote.id" :class="{ 'carousel-item': true, active: index === 0 }">
            <div class="note-card">
              <strong>Groupe :</strong> {{ carnetNote.groupe.nom }}<br>
              <strong>Contenu :</strong> {{ carnetNote.contenu }}
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Suivant</span>
        </a>
      </div>
      <div>
      <form v-show="showForm" @submit.prevent="addcarnetbook" class="mt-3">
                 <div class="form-group">
            <label for="groupe">Sélectionner le groupe :</label>
            <select v-model="selectedGroupe" class="form-control">
              <option v-for="groupe in professeur.groupes" :key="groupe.id" :value="groupe.id">
                {{ groupe.nom }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="contenu">Contenu du carnet de notes :</label>
            <textarea v-model="form.contenu" rows="5" cols="40" placeholder="Contenu du carnet de notes" required class="form-control"></textarea>
          </div>
          <!-- Add additional form fields if needed -->
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
      </div>
    </div>

    
  </template>
  
 
  

  
  <script>
  import axios from 'axios';
  import { mapGetters } from 'vuex';
  
  export default {
    computed: {
      ...mapGetters({
        user: 'auth/user'
      }),
    },
    data() {
      return {
        carnetNotes: [], // Vos données de carnets de notes
        showForm: false,          // Nombre d'éléments à afficher par page
        carnetNotes: {
        
        },
        form:{
            contenu:'',
            professeur_id :'',
            groupe_id: '',

        },
        selectedGroupe: null,
        groupes: [],
        professeur: {
            groupes: [{}],
        },
        contenu: '',
        carnetbookId:'',
      };
    },
    
    mounted() {
    //  this.fetchGroupes();
      this.fetchProfesseur();
      this.getCarnetbook();
    //  this.fetchCarnetNotes();
    },
    methods: {
      toggleForm() {
      this.showForm = !this.showForm;
    },
         // Aller à une page spécifique
        fetchProfesseur() {
        axios
          .get('/professeurs/user/' + this.user.id)
          .then(response => {
            const { data } = response;
            this.carnetbookId = data.id;

            console.log(this.user.id)
            console.log(this.carnetbookId)
            this.getCarnetbook();
           this.professeur.groupes = data.groupes;
           
          })
          .catch(error => {
            console.error(error);
          });
      },
    getCarnetbook() {
      axios.get('/carnetnotes/getbyProf/' + this.carnetbookId)
        .then(response => {
          console.log('hfffy')
            this.carnetNotes = response.data;
            console.log('hy')
        })
        .catch(error => {
          console.log(error);
        });
    },
   
  
    
      addcarnetbook() {

      this.form.professeur_id= this.carnetbookId
      this.form.groupe_id= this.selectedGroupe
      this.form.date= this.selectedGroupe
      
      console.log(this.form.professeur_id)
      axios.post('/carnetnotes', this.form)
        .then(response => {
          
          this.getCarnetbook();
          this.resetForm();
          this.showForm = false;
        })
        .catch(error => {
          console.log(error);
        });
    },
//       submitForm() {
//   const carnetNoteData = {
//     contenu: this.contenu,
//   };

//   const professeurId = this.user.id; // Utilisez l'ID du professeur connecté à partir de votre application ou de votre système d'authentification

//   axios.post(`/professeurs/${professeurId}/carnetnotes`, carnetNoteData)
//     .then(response => {
//       const carnetNote = response.data.carnetNote;
//       console.log('Carnet de notes créé avec succès:', carnetNote);
//     })
//     .catch(error => {
//       console.log('Erreur lors de la création du carnet de notes:', error);
//     });
// },
resetForm() {
      this.form = {
        contenu: '',
        selectedGroupe: '',
        
      };
    },
    },
  };
  </script>
  
  <style>
   .note-card {
    background-color: #f8faf9;
    border: 1px solid #dee2e6;
    padding: 10px;
    margin: 10px;
    text-align: center;
    width: calc(50% - 10px);
    height: auto;
    transition: transform 0.3s ease-in-out;
  }
  
  /* Animation on hover for note cards */
  .note-card:hover {
    transform: scale(1.1);
  }
  
  /* Center the carousel and note cards */
  #carouselExampleIndicators {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  /* Center the content inside carousel items */
  .carousel-item .note-card {
    margin: auto;
  }
  
  .carousel-item {
    height: 200px; /* Ajustez la hauteur selon vos besoins */
  }
  
  .carousel-control-prev,
  .carousel-control-next {
    width: 30px;
    height: 30px;
  }
  
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: #000; /* Couleur de l'icône de navigation */
  }
  
  .carousel-indicators li {
    background-color: #000; /* Couleur de l'indicateur actif */
  }
  </style>
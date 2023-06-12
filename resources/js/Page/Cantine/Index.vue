<template>
  <MainLayout>
    <div class="container">
      
      <div class="column ">
        <h2>Programme de la semaine</h2>
        <div class="grid2">
        <div class="ajouterprogramme">
      <!-- Formulaire d'ajout -->
      <form  @submit.prevent="ajouterProgramme()" class="add-form"> 
        <div class="form-content">
          <input type="text" v-model="nouveauNom" class="form-input" placeholder="Nom du jour">
          <input type="text" v-model="nouveauMenu" class="form-input" placeholder="Menu du jour">
          <div class="form-buttons">
            <button type="submit" class="btn-add"><i class="fas fa-plus"></i> Ajouter</button>
          </div>
        </div>
      </form>
    </div>
      <div class="programme">
        <div v-for="(jour, index) in jours" :key="index" class="jour" @click="afficherMenu(jour)">
          <i v-for="(icon, index) in icons" :key="index" class="icon" :class="icon"></i> 
          <h3>{{ jour.nom }}</h3>
          <p v-show="jour.afficherMenu">{{ jour.menu }}</p>
          <div class="actions">
            <i class="fas fa-regular fa-edit fa-sm" style="color: #44a28f;" @click="modifierMenu(jour)"></i>
            <i class="fas fa-regular fa-trash fa-sm" style="color: #44a28f;" @click="supprimerJour(jour.id)"></i>
          </div>
          <!-- Formulaire de modification -->
          <form v-if="jour.modificationActive" @submit.prevent="sauvegarderMenu(jour)">
            <div class="form-content">
              <input type="text" v-model="jour.nouveauMenu" class="form-input">
              <div class="form-buttons">
                <button type="submit"><i class="fas fa-check"></i></button>
                <button type="button" @click="annulerModification(jour)"><i class="fas fa-times"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
  </div>
    </div>
  </MainLayout>
</template>


<script>
import 'font-awesome/css/font-awesome.css';
import MainLayout from '../../Layouts/MainLayout.vue';
import axios from 'axios';

export default {
  components: { MainLayout },
  data() {
  return {
    nouveauNom: '',
    nouveauMenu: '',
    jours: [
     ],
    icons: [
        'fas fa-utensils',
        'fas fa-hamburger',
        'fas fa-pizza-slice'
        
        ]

  };
},
  mounted() {
    this.fetchProgrammeSemaine();
  },
  methods: {
    fetchProgrammeSemaine() {
      axios.get('/programme-semaine')
        .then(response => {
          this.jours = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },

    // async addNiveauScolaire() {
    //   const newProgrammeMenu = {
    //     nom: this.nom
    //   };
    //   try {
    //     const response = await axios.post('/ajouter-menu', newProgrammeMenu);
    //     // handle the response as needed
    //     this.showForm = false;
    //   } catch (error) {
    //     console.error(error);
    //   }
    // },
   
    
  ajouterProgramme() {
    // Valider les données du formulaire
    if (!this.nouveauNom || !this.nouveauMenu) {
      return;
    }

    // Créer un nouvel objet contenant les données à envoyer
    const data = {
      nom: this.nouveauNom,
      menu: this.nouveauMenu
    };

    // Envoyer les données au serveur (backend)
    axios.post('/ajouter-menu', data)
      .then(response => {
        // Le programme a été ajouté avec succès, mettre à jour la liste des programmes
        this.jours = response.data.menus;

        // Réinitialiser les champs du formulaire
        this.nouveauNom = '';
        this.nouveauMenu = '';
      })
      .catch(error => {
        console.log(error);
      });
  }

,


    afficherMenu(jour) {
      if (!jour.menu) {
        axios.get(`/menu-jour/${jour.jour}`)
          .then(response => {
            jour.menu = response.data.menu;
            jour.afficherMenu = true;
          })
          .catch(error => {
            console.log(error);
          });
      } else {
        jour.afficherMenu = !jour.afficherMenu;
      }
    },
    modifierMenu(jour) {
      // Afficher le formulaire de modification pour le jour sélectionné
      jour.modificationActive = true;
      jour.nouveauMenu = jour.menu; // Pré-remplir le formulaire avec le menu existant
    },
    sauvegarderMenu(jour) {
      const nouveauMenu = jour.nouveauMenu; // Récupérer le nouveau menu saisi

      axios.put(`/menu-jour/${jour.nom}`, { menu: nouveauMenu })
        .then(response => {
          // La mise à jour a réussi, mettre à jour localement le menu dans l'objet jour
          jour.menu = response.data.menu;
          jour.modificationActive = false;
       
        })
        .catch(error => {
          console.log(error);
          // En cas d'erreur, afficher un message d'erreur ou effectuer une action appropriée
        });
    },
    annulerModification(jour) {
      // Annuler les modifications et masquer le formulaire
      jour.modificationActive = false;
    },
    supprimerJour(idJour) {
  if (confirm("Êtes-vous sûr de vouloir supprimer ce jour et son menu ?")) {
    axios.delete(`/menu-jour/${idJour}`)
      .then(response => {
        // La suppression a réussi, retirer le jour de la liste
        const index = this.jours.findIndex(item => item.id === idJour);
        if (index !== -1) {
          this.jours.splice(index, 1);
        }
      })
      .catch(error => {
        console.log(error);
        // En cas d'erreur, afficher un message d'erreur ou effectuer une action appropriée
      });
  }
},

 


    
  }
};
</script>

 
  
<style scoped>
.grid2{
  display: grid;
  grid-template-columns:1fr 1fr  ;
}
@media (max-width: 450px) {
  .grid2{
    display: grid;
    grid-template-columns:1fr;
  }
}

.container {
  display: flex;
}
.programme {
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-wrap: wrap;
  margin-top: 20px;
}
.column {
  flex: 2;
  padding: 20px;
  background-color: #f8f9fa;
}
.jour {
  text-align: center;
  margin-bottom: 20px;
  width: 200px;
  padding: 20px;
  background-color: #c7f1e0;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  position: relative;
  overflow: hidden;
}

.jour i {
  font-size: 24px;
  margin-bottom: 10px;
}

.jour h3 {
  margin-bottom: 10px;
}

.jour p {
  font-size: 14px;
  color: #888;
  margin-top: 10px;
}

.actions {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 10px;
}

.actions i:hover {
  color: #0056b3;
}

.add-form {
  margin-top: 20px;
}

.form-content {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.form-input {
  width: 50%;
  padding: 8px;
  margin-bottom: 8px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.form-buttons {
  display: flex;
  justify-content: flex-end;
  margin-top: 8px;
}

.form-buttons button {
  background-color: transparent;
  border: none;
  cursor: pointer;
  transition: color 0.3s ease;
}

.form-buttons button i {
  font-size: 16px;
}

.form-buttons button:first-child {
  margin-right: 8px;
  
}

.form-buttons button:last-child {
  color: #164d41;
}

.form-buttons button:hover {
  color: #66a58b;
}

.btn-add {
  display: flex;
  align-items: center;
  background-color: #00ffaa;
  color: #fff;
  padding: 8px 12px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-add i {
  margin-right: 6px;
}

.btn-add:hover {
  background-color: #a5daca;
}

</style>



   
  
<template>
  <MainLayoutProf>
    <div>
      <h2>Déposer un cours</h2>
      <button @click="toggleForm" class="btn btn-primary mt-3">{{ showForm ? 'Masquer le formulaire' : 'Afficher le formulaire' }}</button>
      <br><br><br> 
      <form v-show="showForm" @submit.prevent="addCourbook" class="mt-3">
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
          <textarea v-model="form.contenu" rows="5" cols="40" placeholder="Contenu du carnet de notes" required class="form-control" name="form[contenu]"></textarea>
        </div>
        <div>
          <label for="titre">Titre :</label>
          <input type="text" id="titre" v-model="form.titre" name="form[titre]">
        </div>
        <div>
          <label for="fichier">Fichier :</label>
          <input type="file" id="fichier" name="fichier" @change="onFileChange">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      </form>
    </div>
    <div v-for="cour in cours" :key="cour.id" class="note-card">
      <div class="card-header">
        <strong>Groupe :</strong> {{ cour.groupe.nom }}
      </div>
      <div class="card-body">
        <div class="card-content">
          <strong>Titre :</strong> <h1>{{ cour.titre }} </h1><br>
          <strong>Contenu :</strong> {{ cour.contenu }}
        </div>
        <div class="card-footer">
         
          <strong>Fichier :</strong> <a :href="telechargerUrl(cour.id, cour.fichier)" download>Télécharger le fichier</a>
        </div>
      </div>
    </div>
  </MainLayoutProf> 
</template>

<style>
.note-card {
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  overflow: hidden;
  transition: transform 0.3s ease-in-out;
  display: grid;
  
  
}

.note-card:hover {
  transform: translateY(-5px);
}

.card-header {
  background-color: #007bff;
  color: #fff;
  padding: 10px;
  font-weight: bold;
}

.card-body {
  padding: 20px;
}

.card-content {
  margin-bottom: 10px;
}

.card-footer {
  background-color: #f2f2f2;
  padding: 10px;
}

.btn-primary {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #0069d9;
}

textarea {
  resize: vertical;
  min-height: 100px;
}

input[type="file"] {
  display: none;
}

input[type="file"] + label {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

input[type="file"] + label:hover {
  background-color: #0069d9;
}
</style>

  

  
  <script>
  import MainLayoutProf from "../Layouts/MainLayoutProf.vue";
import { mapGetters } from 'vuex';
import axios from 'axios';

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
      cours: [], 
      cours:{},
      showForm: false,          // Nombre d'éléments à afficher par page
      form:{
        titre: '',
        contenu: '',
        },
        selectedFile: null,

        selectedGroupe: null,
        groupes: [],
        professeur: {
            groupes: [{}],
        },
     
      coursbookId: '',
    };
  },
  mounted() {
   
      this.fetchProfesseure();
      this.getCoursbook();
   
    },
  methods: {
    toggleForm() {
      this.showForm = !this.showForm;
    },
    telechargerUrl(id, nomFichier) {
  return route('telecharger.fichier', { id: id, nomFichier: encodeURIComponent(nomFichier) });
},

    fetchProfesseure() {
        axios
          .get('/professeurs/user/' + this.user.id)
          .then(response => {
            const { data } = response;
            this.coursbookId = data.id;
            console.log(this.user.id)
            this.getCoursbook();
           this.professeur.groupes = data.groupes;
           
          })
          .catch(error => {
            console.error(error);
          });
      },
      getCoursbook() {
      axios.get('/cours/getbyProf/' + this.coursbookId)
        .then(response => {
          console.log('hfffy')
            this.cours = response.data;
            console.log('hy')
        })
        .catch(error => {
          console.log(error);
        });
    },
    telechargerUrl(id) {
      return `/telecharger-fichier/${id}`;
    },
  
    addCourbook() {
    this.form.professeur_id = this.coursbookId;
    this.form.groupe_id = this.selectedGroupe;
    this.form.date = this.selectedGroupe;
    console.log('ajoute');

    // Créer un objet FormData pour envoyer les données
    let formData = new FormData();
    formData.append('titre', this.form.titre);
    formData.append('contenu', this.form.contenu);
    formData.append('groupe_id', this.form.groupe_id);
    formData.append('fichier', this.form.fichier, this.form.fichier.name);
    formData.append('professeur_id', this.form.professeur_id);

    console.log(this.form.professeur_id);

    // Envoyer la requête POST à votre endpoint Laravel
    axios.post('/coursEE', formData, {
        headers: {
            'Content-Type': 'multipart/form-data' // Définir le type de contenu comme multipart/form-data
        }
    })
        .then(response => {
            console.log('ajouteeee11');

            // Traiter la réponse du serveur en cas de succès
            console.log(response.data);
            // Réinitialiser le formulaire
            this.selectedGroupe = null;
            this.form.contenu = '';
            this.form.titre = '';
            this.form.fichier = null;
        })
        .catch(error => {
            // Traiter les erreurs de la requête
            console.error(error);
        });
},
onFileChange(event) {
    // Récupérer le fichier sélectionné et le stocker dans la variable form.fichier
    this.form.fichier = event.target.files[0];
    this.form.fichierName = event.target.files[0].name; // Ajouter cette ligne pour stocker le nom du fichier
},

     
  },
    

resetForm() {
this.form = {
  contenu: '',
  selectedGroupe: '',
  titre: '',
  
};
},
     
  }
;
  </script>
  
   
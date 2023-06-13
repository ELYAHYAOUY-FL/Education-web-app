<template>
    <MainLayoutProfDev>
      <div> 

      <button @click="toggleForm" class="btn btn-primary mt-3">{{ showForm ? 'Masquer le formulaire' : 'Afficher le formulaire' }}</button>
          <br><br><br> 
    <form v-show="showForm" @submit.prevent="addDevoir" class="mt-3">
                 <div class="form-group">
            <label for="groupe">Sélectionner le groupe :</label>
            <select v-model="selectedGroupe" class="form-control">
              <option v-for="groupe in professeur.groupes" :key="groupe.id" :value="groupe.id">
                {{ groupe.nom }}
              </option>
            </select>
          </div>
          <div>
        <label for="titre">Titre :</label>
        <input  type="text" id="titre" v-model="form.titre"  name="form[titre]">
      </div>
          <div class="form-group">
            <label for="contenu"> Description :</label>
            <textarea v-model="form.description" rows="5" cols="40" placeholder=" Description du devoir" required class="form-control" name="form[contenu]" ></textarea>
          </div>
          <div class="form-group">
        <label for="date_limite">Date limite</label>
        <input type="date" v-model="form.date_limite" id="date_limite" class="form-control">
      </div>
        
      <div>
        <label for="fichier">Fichier :</label>
        <input type="file" id="fichier" name="fichier" @change="onFileChange">
      </div>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
  </div>



   <!-- ******************************* Affichage **************************************** -->
   <h2>Liste des devoirs</h2>
<div class="devoirs">
  <div v-for="devoir in devoirs" :key="devoir.id" class="devoir-card">
    <h2>Titre :  {{ devoir.titre }}  </h2>
    <p>Description :{{ devoir.description }}</p>
    <p>Date limite : {{ devoir.date_limite }}</p>
    <p>fichier : <a :href="telechargerUrl(devoir.id, devoir.fichier)" download>Télécharger le fichier</a></p>  
  </div>
</div>

</MainLayoutProfDev> 
  </template>
<style>
.devoirs {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
}

.devoirs .devoir-card {
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 20px;
  transition: transform 0.3s ease-in-out;
}

.devoirs .devoir-card:hover {
  transform: translateY(-5px);
}

.devoirs .devoir-card h2 {
  margin-top: 0;
  font-size: 20px;
}

.devoirs .devoir-card p {
  margin-bottom: 10px;
  font-size: 14px;
}

.devoirs .devoir-card a {
  color: #007bff;
  text-decoration: none;
  font-weight: bold;
}

.devoirs .devoir-card a:hover {
  text-decoration: underline;
}
</style>



 
  

  
  <script>
  import MainLayoutProfDev from "../Layouts/MainLayoutProf.vue";
import { mapGetters } from 'vuex';

export default {
  name: "Prof",
    components: {
      MainLayoutProfDev },
    computed: {
      ...mapGetters({
        user: 'auth/user'
      }),
    },
    data() {
    return {
      devoirs: [],
      devoir:{},
      showForm: false,          // Nombre d'éléments à afficher par page
      form:{
        titre: '',
        description: '',
        dateLimite: '',
        },
        selectedFile: null,
        selectedGroupe: null,
        groupes: [],
        professeur: {
            groupes: [{}],
        },
     
        devoirId: '',
  
    };
  },
  mounted() {
    this.fetchDevoirs();
    this.fetchProfesseure();
      this.getDevoirs();
  },
  methods: {
    fetchDevoirs() {
      axios.get('/devoirs').then(response => {
        this.devoirs = response.data;
      }).catch(error => {
        console.error(error);
      });
    },
    toggleForm() {
      this.showForm = !this.showForm;
    },
    telechargerUrl(id, nomFichier) {
    return `/telecharger-fichier/${id}/${encodeURIComponent(nomFichier)}`;
},
fetchProfesseure() {
        axios
          .get('/professeurs/user/' + this.user.id)
          .then(response => {
            const { data } = response;
            this.devoirId = data.id;
            console.log(this.user.id)
            this.getDevoirs();
           this.professeur.groupes = data.groupes;
           
          })
          .catch(error => {
            console.error(error);
          });
      },
      getDevoirs() {
      axios.get('/devoirs/getbyProf/' + this.devoirId)
        .then(response => {
          console.log('hfffy')
            this.devoirs = response.data;
            console.log('hy')
        })
        .catch(error => {
          console.log(error);
        });
    },
    // validerDevoir(id) {
    //   axios.put(`/devoirs/${id}/valider`).then(response => {
    //     console.log(response.data.message);
    //     const devoirIndex = this.devoirs.findIndex(devoir => devoir.id === id);
    //     if (devoirIndex !== -1) {
    //       this.devoirs[devoirIndex].valide = true;
    //     }
    //   }).catch(error => {
    //     console.error(error);
    //   });
    // },
    addDevoir() {
    this.form.professeur_id = this.devoirId;
    this.form.groupe_id = this.selectedGroupe;
    this.form.date = this.selectedGroupe;
    console.log('ajoute');

    // Créer un objet FormData pour envoyer les données
    let formData = new FormData();
    formData.append('titre', this.form.titre);
    formData.append('description', this.form.description);
    formData.append('groupe_id', this.form.groupe_id);
    formData.append('fichier', this.form.fichier, this.form.fichier.name);
    formData.append('date_limite', this.form.date_limite);
    formData.append('professeur_id', this.form.professeur_id);

    console.log(this.form.professeur_id);

    // Envoyer la requête POST à votre endpoint Laravel
    axios.post('/devoirEE', formData, {
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
            this.form.description  = '';
            this.form.titre = '';
            this.form.fichier = null;
            this.getDevoirs();
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
  };
 
  </script>
  
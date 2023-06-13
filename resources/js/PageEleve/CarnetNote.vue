<template>
  <MenuLayoutEleve>
  
  <div class="row">
    <div v-for="cour in cours" :key="cour.id" class="col-md-4">
      <div class="cards">
        <div class="card-header">
        </div>
        <div class="card-body">
          <div class="card-content">
            <h1 @click="toggleDescription(cour)" class="titles"  >{{ cour.professeur.user.prenom_francais }}</h1>
            <transition name="fade">
              <div v-if="cour.showDescription"  class="content">
                <strong>Contenu :</strong> {{ cour.contenu }}
                <br>
              </div>
            </transition>
          </div>
        </div>
      </div>
    </div>
  </div>
</MenuLayoutEleve>
</template>

<style>
.note-card {
background-color: #fff;
border-radius: 5px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
margin-bottom: 20px;
overflow: hidden;
width: 100%; /* Adjust the width as needed */

transition: transform 0.3s ease-in-out;
display: grid;


}
.cards{
  width: 100%; /* Adjust the width as needed */
}
.titles {
cursor: pointer;
font-size: 20px;
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

/* input[type="file"] {
display: none;
} */

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
import { mapGetters } from 'vuex';
import MenuLayoutEleve from "../Layouts/MenuLayoutEleve.vue";

export default {
  components: {
    MenuLayoutEleve
  },
  computed: {
    ...mapGetters({
      user: 'auth/user'
    }),

},
  data() {
      return {
        lasts: {} ,// Initialize lasts as an empty object
        showForm: false,

  groupes: [],
  cours: [],
  groupId: '',
  eleve: {}, // Add the 'eleve' object here
};
  },
  mounted() {
 
  this.fetchEleve();

},


  methods: {
      toggleDescription(cour) {
  cour.showDescription = !cour.showDescription;
},
  toggleForm() {
    this.showForm = !this.showForm;
  },
  telechargerUrl(id, nomFichier) {
return route('telecharger.fichier', { id: id, nomFichier: encodeURIComponent(nomFichier) });
},
      fetchEleve() {
axios.get('/eleves/user/' + this.user.id)
  .then(response => {
    const { data } = response;
    this.groupId = data.groupe.id;
    console.log('eleve:', this.groupId);

    this.eleve = data; // Set the 'eleve' object with the data from the API response
this.fetchlastGroupe(this.groupId);
    console.log('eleve:', this.eleve);
    
  })
  .catch(error => {
    console.error(error);
  });
},
telechargerUrl(id) {
    return `/telecharger-fichier/${id}`;
  },



fetchlastGroupe(groupeId) {
      axios
        .get('/carnetnotes/getbygroupe/'+ groupeId)
        .then(response => {

          console.log(this.groupeId);
          this.cours = response.data;
          console.log('cours:', this.cours);

        
        })
        .catch(error => {
          console.error(error);
        });
    },

 
  

  }
};
</script>



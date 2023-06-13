<template>
  <MenuLayoutEleve>
    <div class="devoirs-container">
      <h2>Les devoirs à faire</h2>
      <ul>
        <li v-for="devoir in devoirs" :key="devoir.id" class="devoir-card">
          <div class="card-front">
            <strong>{{ devoir.titre }}</strong><br>
            <strong>Contenu :</strong> {{ devoir.description }}
            <strong>Professeur :</strong> {{ devoir.professeur.user.nom_francais }} - {{ devoir.professeur.matiere.titre }}
           
          </div>
          <div class="card-back">
            <p>{{ devoir.titre }}</p>
            <strong>Statut :</strong>
            <div v-if="devoir.pivot.validation === 0">
              <p>Non fait</p>
              <input type="radio" class="hidenn" name="fait" value="false" checked />
              <input type="radio" name="fait" value="true" v-model="devoirDone[devoir.id]" @change="mentionDevoireDone(devoir.id)" />
            </div>
            <div v-else>
              <p>Fait</p>
            </div>
            <a :href="telechargerUrl(devoir.id, devoir.fichier)" download>Télécharger le fichier</a>
          </div>
        </li>
      </ul>
    </div>
  </MenuLayoutEleve>
</template>


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
    groupes: [],
    devoirs: [],
    groupId: '',
    eleveid: '',
    devoirId: '',
    devoirDone: {} ,// Object to store the done status of each devoir

    groupedEmploiTemps: {}
  };
  },
  mounted() {

  this.fetchEleve();
},


  methods: {
    telechargerUrl(id, nomFichier) {
        return route('telecharger.fichier', { id: id, nomFichier: encodeURIComponent(nomFichier) });
      }, telechargerUrl(id) {
        return `/telecharger-fichier/${id}`;
      },
    fetchEleve() {
    axios.get('/eleves/user/' + this.user.id)
      .then(response => {
        const { data } = response;
        this.eleveid=response.data.id;
        //  const grouup = data.groupe.id;
        this.groupId = data.groupe.id;
        this.fetchdevoir( this.eleveid);
        this.getEleveid( this.eleveid);
        console.log( this.eleveid);
      
      })
      .catch(error => {
        console.error(error);
      });
  },
  getEleveid(eleveid){
    this.eleveid=eleveid;
  },

  mentionDevoireDone(devoirId) {
    const eleveId=this.eleveid;
     axios.put('/eleves/devoirs/' + eleveId+'/'+devoirId).then(response => {
      this.fetchdevoir( eleveId);
        console.log("hello")
      })
      .catch(error => {
        console.error(error);
      });
    },
   fetchdevoir(eleveid){
    axios.get('/eleves/devoir/' + eleveid)
      .then(response => {
       this.devoirs=response.data;
        console.log("hello");
       
      })
      .catch(error => {
        console.error(error);
      });
   }


  }
};
</script>

<style>
.devoirs-container {
  background-image: url('../src/assest/images/parentpagedetails.jpg');
  background-size: cover;
  background-position: center;
  color: #457973;
  padding: 20px;
  height:100vh;
}
.devoirs-container h1{
  font-size: 30px;
}
.devoir-card {
  position: relative;
  list-style: none;
  width: 300px;
  height: 200px;
  background-color: #fff;
  color: #457973;
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease-in-out;
  cursor: pointer;
}

.devoir-card:hover {
  transform: translateY(-5px);
}

.card-front {
  display: flex;
  flex-direction: column;
}

.card-back {
  display: none;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #457973cc;
  color: #fff;
  border-radius: 10px;
  padding: 20px;
  transition: opacity 0.3s ease-in-out;
}

.devoir-card:hover .card-back {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  opacity: 1;
}

.card-back p {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.card-back a {
  color: #fff;
  text-decoration: underline;
}
.hidenn{
  display:none;
}

h2 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}
</style>

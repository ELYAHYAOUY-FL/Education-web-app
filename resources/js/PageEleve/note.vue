<template>
    <MenuLayoutEleve>
      <div>
      <div v-for="(last, matiereId) in lasts" :key="matiereId">
        {{ last.note.valeur }} à {{ last.matiere.titre }}
      </div>
     
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
          lasts: {} ,// Initialize lasts as an empty object

 
    groupes: [],
    groupId: '',
    eleve: {}, // Add the 'eleve' object here
  };
    },
    mounted() {
    this.fetchGroupes();
    this.fetchMatieres();
    this.fetchEleve();
    this.fetchlastNote();
  },


    methods: {
    
        fetchEleve() {
  axios.get('/eleves/user/' + this.user.id)
    .then(response => {
      const { data } = response;
      this.groupId = data.groupe.id;
      this.eleve = data; // Set the 'eleve' object with the data from the API response

      console.log('eleve:', this.eleve);
      console.log('groupe:', this.eleve.groupe);
      console.log('matieres:', this.eleve.groupe.matieres);
    })
    .catch(error => {
      console.error(error);
    });
},

fetchlastNote() {
        axios
          .get('/eleves/user/note/'+  this.user.id)
          .then(response => {
            this.lasts = response.data;
           console.log(this.lasts)
           console.log(this.user.id)
          })
          .catch(error => {
            console.error(error);
          });
      },

      fetchGroupes() {
        axios
          .get('/groupes')
          .then(response => {
            this.groupes = response.data;
           
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchMatieres() {
        axios
          .get('/matieres')
          .then(response => {
            this.matieres = response.data;
        
          })
          .catch(error => {
            console.error(error);
          });
      },

    }
  };
  </script>
  <style scoped> 
     </style>
  
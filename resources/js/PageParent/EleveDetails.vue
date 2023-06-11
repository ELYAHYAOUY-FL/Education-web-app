<template>
    <div>
        <NavBar :eleveId="eleve.id" />
      <!-- <h1>Eleve ID: {{ eleve.id }}</h1>
      <h1>Eleve nom: {{ eleve.user.nom_francais }}</h1>
      <h1>Eleve groupe: {{ eleve.groupe.nom }}</h1> -->
    </div>
  </template>
  
  <script>
  import { mapGetters } from 'vuex';
  import MenuLayoutEleve from "../Layouts/MenuLayoutEleve.vue";
  import NavBar from '../src/component/navEleve.vue'

  
  export default {
    components: {
      MenuLayoutEleve ,
      NavBar
    },
    computed: {
      ...mapGetters({
        user: 'auth/user'
      }),
    },
    data() {
      return {
        groupes: [],
        eleve: {
        groupe: {},

        user: {},
        },
      };
    },
    mounted() {
      this.fetchEleve();
    },
    methods: {
      fetchEleve() {
        axios
          .get('/eleves/' + this.$route.params.eleveId)
          .then(response => {
            this.eleve = response.data;
            this.eleve.groupe = response.data.groupe;
            this.eleve.user = response.data.user;
  
            console.log('eleve:', this.eleve);
            console.log('groupe:', this.eleve.groupe);
          
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
    },
  };
  </script>
  
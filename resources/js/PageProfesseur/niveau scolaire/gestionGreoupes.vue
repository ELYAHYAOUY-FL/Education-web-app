<template>
    <MainLayout>
      <div class="content-header">
        <span>{{ user.nom_francais }}</span>
        <ul v-for="groupe in professeur.groupes" :key="groupe.id">
          <li>
            {{ groupe.nom }}
            <ul>
              <li v-for="eleve in groupe.eleves" :key="eleve.id">
                <!-- {{ eleve.CNE }} -->
                <ul>
                        
                    {{eleve.user.nom_francais}}
                    {{eleve.user.prenom_francais}}
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </MainLayout>
  </template>
  
  m
  
  
  <script>
  import MainLayout from "../../Layouts/MainLayoutProf.vue";
  import { mapGetters } from 'vuex';
  
  export default {
    components: { MainLayout },
    computed: {
      ...mapGetters({
        user: 'auth/user',
      }),
    
    },
    data() {
      return {
        groupes: [],
        matieres: [],
        eleves:[],

        professeur: {
            groupes: [{
                eleves:[]
            }],
        }
      };
    },
    mounted() {
  this.fetchProfesseur();
  this.fetchGroupes();
  this.fetchMatieres();
  this.fetchEleves(); // Call the fetchEleves method
},

    methods: {
      fetchProfesseur() {
        axios
          .get('/professeurs/user/' + this.user.id)
          .then(response => {
            const { data } = response;
      this.professeur.groupes = data.groupes;
           
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchGroupes() {
        axios
          .get('/groupes/')
          .then(response => {
            this.groupes = response.data;
            console.log(this.groupes)
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchEleves() {
        axios
          .get('/eleves')
          .then(response => {
            this.eleves = response.data;
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
  
  <style>
  /* Add your styles here */
  </style>
  
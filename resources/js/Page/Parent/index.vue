<template>
  <MainLayout>
  <div>
      <h1>Liste des parents avec leurs élèves</h1>

      <ul>
            <li v-for="parent in parents" :key="parent.id">
                <h3>{{ parent.nom }}</h3>
                <ul>
                    <li v-for="eleve in parent.eleves" :key="eleve.id">
                        {{ eleve.nom_francais }} {{ eleve.nom_arabe }}
                    </li>
                </ul>
            </li>
        </ul>
  </div>
</MainLayout>
  </template>
  
  <script>
  
  import axios from 'axios';
  import MainLayout from '../../Layouts/MainLayout.vue';
  
  export default {
    components: { MainLayout },
  data() {
      return {
          parents: [],
          
      };
  },
  mounted() {
      this.fetchParents();
  },
  methods: {
      fetchParents() {
          // Faites une requête HTTP pour obtenir la liste des parents avec les élèves
          // Utilisez l'URL appropriée pour votre application
          axios.get('/api/parents')
              .then(response => {
                  this.parents = response.data;
              })
              .catch(error => {
                  console.error(error);
              });
      }
  }
};
</script>





<!-- <template>
    <MainLayout>
      <div>
        <h1>Liste des Parents</h1>
        <ul>
          <li v-for="parent in parents" :key="parent.id">
            <p>Nom: {{ parent.nom }}</p>
            <p>Prénom: {{ parent.prenom }}</p>
            <p>Date de naissance: {{ formatDate(parent.date_naissance) }}</p>
            <p>Lieu de naissance: {{ parent.lieu_naissance }}</p>
            <p>Téléphone: {{ parent.tel }}</p>
            <p>Adresse: {{ parent.address }}</p>
            <p>CNI: {{ parent.CNI }}</p>
            <p>Identifiant de paiement: {{ parent.payement_id }}</p>
            <p>Identifiant utilisateur: {{ parent.user_id }}</p>
          </li>
        </ul>
      </div>
    </MainLayout>
  </template>
  
  <script>
  import moment from 'moment';
  import axios from 'axios';
  import MainLayout from '../../Layouts/MainLayout.vue';
  
  export default {
    components: { MainLayout },
    data() {
      return {
        parents: [],
      };
    },
    mounted() {
      this.fetchParents();
    },
    methods: {
      fetchParents() {
        axios.get('/api/parents')
          .then(response => {
            this.parents = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      formatDate(date) {
        return moment(date).format('YYYY-MM-DD');
      },
    },
  };
  </script>
   -->
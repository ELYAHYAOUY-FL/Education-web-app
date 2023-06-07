<template>
    <div>
     <h1>hello perent </h1>
     <buttom   @click="logout" > 
                      <span>Logout</span>
            </buttom>
    </div>
    <div>
    <h1>Liste des élèves</h1>
    <ul>
      <li v-for="eleve in eleves" :key="eleve.id" @click="goToDashboard(eleve.id)">
        {{ eleve.nom }}
      </li>
    </ul>
  </div>
  </template>
  
  <script>
  import { mapGetters } from 'vuex'

  export default {
    name: "parent" ,
    computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },
  data() {
    return {
      eleves: [], // Liste des élèves
    };
  },
  mounted() {
    axios.get('/parents/user/' + this.user.id)
      .then(response => {
        console.log(this.user.id)
        const parentId = response.data.id;
        this.parents=response.data
        console.log(this.parents.CNI)
        // Faites une autre requête API pour récupérer les élèves associés au parent
        
      })
      .catch(error => {
        console.error(error);
      });
  },
  methods: {
    logout() {
      this.$store.dispatch('auth/logout').then(() => {
        this.$router.push('/login')
      })
    },
    goToDashboard(eleveId) {
    this.$router.push(`/dashboard/${eleveId}`);
  }
  },
   
  }
  </script>
  
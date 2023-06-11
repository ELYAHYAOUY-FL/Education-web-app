<template>
  <div class="parent-container">
    <div class="header">
      <button @click="logout">
        <span>Logout</span>
      </button>
    </div>
    <div class="card">
      <ul>
        <li v-for="eleve in eleves" :key="eleve.id" @click="goToDashboard(eleve.id)">
          {{ eleve.user.prenom_francais }} {{ eleve.user.nom_francais }}
        </li>
      </ul>
    </div>
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
      eleves: [],
    
      parent:{}
    };
  },
  mounted() {
    this.fetchParent();
  },
  methods: {
    logout() {
      this.$store.dispatch('auth/logout').then(() => {
        this.$router.push('/login')
      })
    },
    goToDashboard(eleveId) {
    this.$router.push(`/eleveParent/${eleveId}`);
  },

  fetchParent() {
      axios
        .get('/parents/user/' + this.user.id)
        .then(response => {
          const { data } = response;
          this.eleves = data.eleves;

          console.log(this.user.id)
         
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
   
  }
  </script>
  
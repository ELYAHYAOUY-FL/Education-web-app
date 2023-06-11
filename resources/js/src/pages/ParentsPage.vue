<template>
  <div>
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
      user:{},
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
    this.$router.push(`/dashboard/${eleveId}`);
  },

  fetchParent() {
      axios
        .get('/parents/user/' + this.user.id)
        .then(response => {
          const { data } = response;
         
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
   
  }
  </script>
  
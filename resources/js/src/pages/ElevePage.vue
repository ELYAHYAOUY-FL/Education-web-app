<template>
  <MainLayoutEleve>
    <div>
     <h1>hello eleve 
       <CarnetNote/>
     </h1>
     <buttom   @click="logout" > 
                      <span>Logout</span>
            </buttom>
    </div>
  </MainLayoutEleve>
  </template>
  
  <script>
  import { mapGetters } from 'vuex'
  import MainLayoutEleve from "../../Layouts/MenuLayoutEleve.vue";
  import CarnetNote from '../../PageEleve/CarnetNote.vue';
  export default {
    name: "Eleve",
    components: { MainLayoutEleve, CarnetNote, },
    computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },
  methods: {
    logout() {
      this.$store.dispatch('auth/logout').then(() => {
        this.$router.push('/login')
      })
    },
  },
   
  }
  </script>
  
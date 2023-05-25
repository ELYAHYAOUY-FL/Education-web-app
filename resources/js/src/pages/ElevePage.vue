<template>
    <div>
     <h1>hello eleve 

     </h1>
     <buttom   @click="logout" > 
                      <span>Logout</span>
            </buttom>
    </div>
  </template>
  
  <script>
  import { mapGetters } from 'vuex'
  export default {
    name: "Eleve",
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
  
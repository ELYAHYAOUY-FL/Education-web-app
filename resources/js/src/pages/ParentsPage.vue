<template >
  <div  class="parent-container">
   
    <div class="card-container">
      <ul>
        <li v-for="eleve in eleves" :key="eleve.id" @click="goToDashboard(eleve.id)" class="cardul">
          <div class="flex_cards">
            <span>
          {{ eleve.user.prenom_francais }} {{ eleve.user.nom_francais }} {{ eleve.id }}
          </span>
          <div class="cold-3">
              <img :src="'/photos/' + eleve.photo" alt="Photo" class="eleve_photo">
            </div>
          </div>
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
  this.$router.push(`/parentEleveDetails/${eleveId}`);
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


<style>
.parent-container {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px;
  height: 100vh;
}

.parent-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
 /* // color:rgb(76, 158, 158); */
  background-color: rgba(0, 0, 0, 0.7);
  z-index: -1;
}


.parent-container::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('../assest/images/parentPageHero.jpg');
  background-size: cover;
  background-position: center;
  z-index: -2;
}

.header {
  background-color: #333;
  color: #fff;
  padding: 10px;
  margin-bottom: 20px;
}
.card-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
.cardul {
  background-color: rgba(0, 0, 0, 0.5);
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

}
.flex_cards{
  display: flex;
  gap:1rem;
  justify-content: center;
  align-items: center;
}
ul {
  list-style-type: none;
  padding: 0;
  display: flex;
  gap:1rem;
}

li {
  margin-bottom: 10px;
  color: #fff;
  cursor: pointer;
}
.eleve_photo {
  width: 7rem;
  height: 7rem;
  border-radius:50% ;
}
</style>

  
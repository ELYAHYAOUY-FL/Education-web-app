<template>
  

    <div>
        <NavBar :eleveId="eleve.id" />
        <div class="container">
       
       <div class="column ">
         <h2>Programme de la semaine</h2>
         <div class="grid2">
       <div class="programme">
         <div v-for="(jour, index) in jours" :key="index" class="jour" @click="afficherMenu(jour)">
           <div class="icongap">

               <i v-for="(icon, index) in icons" :key="index" class="icon" :class="icon"></i> 
           </div>
           <h3>{{ jour.nom }}</h3>
           <p v-show="jour.afficherMenu">{{ jour.menu }}</p>
            
         </div>
       </div>
       <div class="ajouterprogramme">
           <img :src="image" alt=""  width="500" height="400"  /> 
       </div> 
     </div>
     
       
     
   </div>
     </div>
    </div>
  </template>
  
  <script>

import MenuLayoutEleve from "../Layouts/MenuLayoutEleve.vue";
import 'font-awesome/css/font-awesome.css';
import Cantine from "../../../public/photos/Cantine.png"
import NavBar from '../src/component/navEleve.vue'

import axios from 'axios';

export default {
   
  components: {
    
    MenuLayoutEleve ,
    NavBar


  },

  data() {
    return {
     
      eleve: {
        groupe: {},

        user: {},
        },
        nouveauNom: '',
      nouveauMenu: '',
      jours: [
       ],
       image : Cantine,
      icons: [
          'fas fa-utensils',
          'fas fa-hamburger',
          'fas fa-pizza-slice'
          
          ]
  
    };
  },
 
  methods: {

      fetchEleve() {
        axios
          .get('/eleves/' + this.$route.params.eleveId)
          .then(response => {
            this.eleve = response.data;
            console.log( this.eleve.id);
            this.eleve.groupe = response.data.groupe;
            this.groupeId= this.eleve.groupe.id;
            this.eleve.user = response.data.user;
             this.userId = this.eleve.user.id;
             
      console.log(this.groupeId);
            
            console.log('eleve:', this.eleve);
            console.log('eleve:', this.eleve);
       
          
      console.log(this.userId);
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchProgrammeSemaine() {
        axios.get('/programme-semaine')
          .then(response => {
            this.jours = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      },
  
  
      afficherMenu(jour) {
        if (!jour.menu) {
          axios.get(`/menu-jour/${jour.jour}`)
            .then(response => {
              jour.menu = response.data.menu;
              jour.afficherMenu = true;
            })
            .catch(error => {
              console.log(error);
            });
        } else {
          jour.afficherMenu = !jour.afficherMenu;
        }
      },
  
  },
  mounted() {
    // Effectuer une requête HTTP pour récupérer les événements de la base de données
    this.fetchEleve();
    this.fetchProgrammeSemaine();

 
  },
};
</script>
  
<style scoped>
  .icon{
    color: rgb(21, 168, 212);
  }
  .icongap{
    display: flex;
    justify-content: space-evenly;
  }
  .grid2{
    display: grid;
    grid-template-columns:1fr 1fr  ;
  }
  @media (max-width: 450px) {
    .grid2{
      display: grid;
      grid-template-columns:1fr;
    }
  }
  
  .container {
    display: flex;
  }
  .programme {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
    margin-top: 20px;
  }
  .column {
    flex: 2;
    padding: 20px;
    background-color: #f8f9fa;
  }
  .jour {
    text-align: center;
    margin-bottom: 20px;
    width: 200px;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
  }
  
  .jour i {
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  .jour h3 {
    margin-bottom: 10px;
  }
  
  .jour p {
    font-size: 14px;
    color: #888;
    margin-top: 10px;
  }
  
   
  </style>
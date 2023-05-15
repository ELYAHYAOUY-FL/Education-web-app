<template>
  <MainLayout> 
   <div>
     <h2>Programme de la semaine</h2>
     <div class="programme">
       <div v-for="(jour, index) in jours" :key="index" class="jour" @click="afficherMenu(jour)">
         <i v-for=" (icon,index) in icons" :key="index" class="icon" :class="icon"></i>
         <h3>{{ jour.nom }}</h3>
         <p  v-show="jour.afficherMenu">{{ jour.menu }}</p>
         <div class="actions">
           <i class="fas fa-regular fa-edit fa-sm" style="color: #44a28f;" @click="modifierMenu(jour)"></i>
           <i class=" fas fa-regular fa-trash fa-sm" style="color: #44a28f;" @click="supprimerJour(jour.jour)"></i>
           <!-- <i class="fas fa-trash" @click="supprimerJour(jour.jour)"></i> -->
         </div>
       </div>
     </div>
     <form @submit.prevent="ajouterJour" class="fade-in">
        <div class="form-content">
          <input type="text" v-model="nouveauJour" class="form-input" placeholder="Nom du jour">
          <input type="text" v-model="nouveauMenu" class="form-input" placeholder="Menu du jour">
          <div class="form-buttons">
            <button type="submit" class="btn-add"><i class="fas fa-plus"></i> Ajouter</button>
          </div>
        </div>
      </form>
   </div>
</MainLayout>
 </template>
 
 <script>
 import 'font-awesome/css/font-awesome.css';
 import MainLayout from '../../Layouts/MainLayout.vue';
 import axios from 'axios';
 export default {
   components : { MainLayout},
   
   data() {
     return {
       jours: [
         { jour: 'lundi', nom: 'Lundi', menu: 'Menu du lundi', class_icon : 'fas fa-utensils' },
         { jour: 'mardi', nom: 'Mardi', menu: 'Menu du mardi' , class_icon : 'fas fa-hamburger'},
         { jour: 'mercredi', nom: 'Mercredi', menu: 'Menu du mercredi' , class_icon : 'fas fa-pizza-slice' },
         { jour: 'jeudi', nom: 'Jeudi', menu: 'Menu du jeudi' , class_icon : '', class_icon : 'fas fa-fish'},
         { jour: 'vendredi', nom: 'Vendredi', menu: 'Menu du vendredi', class_icon : 'fas fa-fish' }
       ],
       icons: [
        'fas fa-utensils',
        'fas fa-hamburger',
        'fas fa-pizza-slice',
        'fas fa-fish'
        
       
       ]
     };
   },
   
  
     
   
 };
 </script>
 
 <style scoped>
 
 .programme {
   display: flex;
   justify-content: space-around;
   align-items: center;
   flex-wrap: wrap;
   margin-top: 20px;
 }
 
 .jour {
   text-align: center;
   margin-bottom: 20px;
   width: 200px;
   padding: 20px;
   background-color: #f8f9fa;
   border-radius: 5px;
   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
 }
 
 .jour i {
  font-size: 24px;
  margin-bottom: 10px;
  color: #888;
}
 
 .jour h3 {
   margin-bottom: 10px;
 }
 
 .jour p {
   font-size: 14px;
   color: #888;
 }
 
 
 .form-content {
  display: flex;
  align-items: center;
  opacity: 0;
  animation: fadeIn 0.5s ease forwards;
}

.fade-in {
  animation: fadeIn 0.5s ease forwards;
  opacity: 0;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.form-input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 14px;
  opacity: 0;
  animation: fadeIn 0.5s ease forwards;
}

.form-buttons {
  display: flex;
  align-items: center;
  margin-left: 10px;
  opacity: 0;
  animation: fadeIn 0.5s ease forwards;
}

.btn-add {
  padding: 6px 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px;
  background-color: #007bff;
  color: #fff;
  opacity: 0;
  animation: fadeIn 0.5s ease forwards;
  transition: background-color 0.3s ease;
}

.btn-add:hover {
  background-color: #0056b3;
}

 </style>
 
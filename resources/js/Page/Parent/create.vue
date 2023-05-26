<template>
  <MainLayout>
    <div class="content-header">
      <div class="container-fluid">
        <h2>les fromation du parent : </h2> <div v-if="successMessage" class="alert alert-success text-center">
      <i class="fa fa-check-circle"></i>
      {{ successMessage }}
    </div>

        <form  @submit.prevent="addViremnt" enctype="multipart/form-data">
          <div class="form-group">
        <label for="frais">Les Frais : </label>
          <input type="text" class="form-control" id="frais" v-model="modelValue.frais" required>
         </div>
          <!-- <div class="form-group">
    <label for="date">Date de virement </label>
    <input type="date" class="form-control" id="date" v-model="modelValue.date" required>
  </div> -->
          <div class="form-group">
    <label for="nom_compte">Nom Compte :</label>
    <input type="text" class="form-control" id="nom_compte" v-model="modelValue.nom_compte" required>
  </div>
  <!-- <div class="form-group">
            <label for="est_paye">Est payee  :</label>
            <select  class="form-control" id="est_paye" v-model="modelValue.est_paye" required>
              <option value=""></option>
              <option value="1">Oui</option>
              <option value="0">Non</option>
            </select>
            
           </div>-->
        
          <div class="form-group">
    <label for="prenom">Prénom</label>
    <input type="text" class="form-control" id="prenom" v-model="modelValue.prenom" required>
  </div>
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" v-model="modelValue.nom" required>
  </div>
          <div class="form-group">
            <label for="date_naissance">Date nissance</label>
            <input type="date" class="form-control" id="date_naissance" v-model="modelValue.date_naissance" required>
          </div>
          <div class="form-group">
            <label for="lieu_naissance">Lieu nissance</label>
            <input type="text" class="form-control" id="lieu_naissance" v-model="modelValue.lieu_naissance" required>
          </div>
          <div class="form-group">
            <label for="tel">Tel</label>
            <input type="number" class="form-control" id="tel" v-model="modelValue.tel" required>
          </div>
          
          <!-- <div class="form-group">
            <label for="salaire">Salaire</label>
            <input type="number" class="form-control" id="salaire" v-model="modelValue.salaire" required>
          </div> -->
          <div class="form-group">
            <label for="address">Adress</label>
            <input type="text" class="form-control" id="address" v-model="modelValue.address" required>
          </div>
          <div class="form-group">
            <label for="CIN">CNI :</label>
            <input  class="form-control" id="CNI" v-model="modelValue.CNI" required>
              
          </div>
          <div>
  <label for="eleves">Élèves :</label>
  <select id="eleves" v-model="modelValue.eleves" required>
    <option v-for="eleve in eleves" :key="eleve.id" :value="eleve.id">{{ eleve.nom }}</option>
  </select>
</div>

           <div class="form-group">
            <input type="submit" class="btn btn-primary" value="save">
          </div> 

        </form>

      </div>
    </div>
  </MainLayout>
</template>
  <script>
  
  import MainLayout from "../../Layouts/MainLayout.vue";
  import axios from "axios";
  
  export default {
    components: { MainLayout },
    data() {
    return {
      modelValue: {
         frais: '',
        est_paye: '',
        nom_compte: '',
        // date: '',
        prenom: '',
        nom: '',
        date_naissance: '',
        lieu_naissance: '',
        tel: '',
        address: '',
        CNI: '',
        eleves: '',
      
        
      },
      eleves: [],
     allEleves: [] ,
      errors: {},
      successMessage: ""
     
    };
  },
  
  created() {
        // Récupérer tous les élèves depuis l'API
        this.fetchAllEleves();
    },
    methods: {
        fetchAllEleves() {
            // Faites une requête à l'API pour récupérer tous les élèves
            // et mettez à jour la propriété allEleves avec les données renvoyées
            // Exemple avec axios :
            axios.get('/api/eleves')
                .then(response => {
                    this.eleves = response.data;
                    console.log('All eleves:', this.eleves);
                })
                .catch(error => {
                    console.error(error);
                });
        },
      addViremnt() {
    axios.post('/api/payements', this.modelValue)
      .then(response => {
        const payemnentId = response.data.payement_id;
  
        // Associate virement with the professor
        this.modelValue.payement_id = payemnentId;
  
        // Call the addProfessor method to create the professor
        this.addProfessor();
        this.successMessage = "Form submitted successfully";
      })
      .catch(error => {
        console.log(error.response.data);
        this.errors = error.response.data.errors;
      });
  },
  
  addProfessor() {
    const formData = new FormData();
    formData.append('prenom', this.modelValue.prenom);
    formData.append('nom', this.modelValue.nom);
    formData.append('date_naissance', this.modelValue.date_naissance);
    formData.append('lieu_naissance', this.modelValue.lieu_naissance);
    formData.append('tel', this.modelValue.tel);
    formData.append('diplom', this.modelValue.diplom);
    formData.append('frais', this.modelValue.frais);
    formData.append('address', this.modelValue.address);
    formData.append('CNI', this.modelValue.CNI);
    formData.append('payement_id', this.modelValue.payement_id);

    this.modelValue.eleves.forEach(eleveId => {
    formData.append('eleves[]', eleveId);
  });
  
    axios
      .post('/api/parent', formData, {
        headers: {
          'Content-Type': 'multipart/form-data', // Set the content type to multipart/form-data
        },
      })
      .then(response => {
        const parentId = response.data.parent_id;
  
        // Handle the response
      })
      .catch(error => {
        console.log(error.response.data);
        this.errors = error.response.data.errors;
      });
  },
    },
  }
  ;
  </script>
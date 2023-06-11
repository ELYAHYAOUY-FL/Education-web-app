<template>
  <MainLayout>
    <div class="content-header">
      <div class="container-fluid">
        <h2>Ajouter des parents: </h2>
      

        <form @submit.prevent="addProfesseur" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nom_francais">Nom en français</label>
            <input type="text" class="form-control" id="nom_francais" v-model="modelValue.nom_francais" required>
          </div>
          <div class="form-group">
            <label for="nom_arabe">Nom en arabe</label>
            <input type="text" class="form-control" id="nom_arabe" v-model="modelValue.nom_arabe" required>
          </div>
          <div class="form-group">
            <label for="prenom_francais">Prénom en français</label>
            <input type="text" class="form-control" id="prenom_francais" v-model="modelValue.prenom_francais" required>
          </div>
          <div class="form-group">
            <label for="prenom_arabe">Prénom en arabe</label>
            <input type="text" class="form-control" id="prenom_arabe" v-model="modelValue.prenom_arabe" required>
          </div>
          <div class="form-group">
            <label for="date_naissance">Date de naissance</label>
            <input type="date" class="form-control" id="date_naissance" v-model="modelValue.date_naissance" required>
          </div>
          <div class="form-group">
            <label for="lieu_naissance">Lieu de naissance</label>
            <input type="text" class="form-control" id="lieu_naissance" v-model="modelValue.lieu_naissance" required>
          </div>
          <div class="form-group">
            <label for="sex">Sex :</label>
            <select  class="form-control" id="sex" v-model="modelValue.sex" required>
              <option value=""></option>
              <option value="F">F</option>
              <option value="M">M</option>
            </select>
            
          </div>
          <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" accept="image/*" class="form-control" id="photo" @change="handlePhotoChange" required>
            <div>
              <img :src="previewPhoto" alt="" id="image-preview" style="width:30%; height:30%; border-radius:15px; display:none;">
            </div>
            <div v-if="errors && errors.photo" class="text-danger">{{ errors.photo[0] }}</div>
          </div>
      
        <div class="form-group">
            <label for="adresse">Adress</label>
            <input type="text" class="form-control" id="adresse" v-model="modelValue.adresse" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" v-model="modelValue.email" required>
          </div>
          <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" v-model="modelValue.password" required>
          </div>
          <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" v-model="modelValue.username" required>
          </div>
         
         
        
          <div class="form-group">
            <label for="CNI">CNI</label>
            <input type="text" class="form-control" id="CNI" v-model="modelValue.CNI" required>
          </div>
          
          <div class="form-group">
            <label for="tel">tel</label>
            <input type="text" class="form-control" id="tel" v-model="modelValue.tel" required>
          </div>
        
        

        <div v-for="eleve in eleves" :key="eleve.id">
  <label>
    <input type="checkbox" v-model="modelValue.eleve_ids" :value="eleve.id">
    {{ eleve.id }}
  </label>
</div>

<div>
    <input type="hidden" v-model="modelValue.user_type">
    <!-- Other code -->
  </div>




          <div class="form-group">
            <label for="numero_compte">numero_compte</label>
            <input type="text" class="form-control" id="numero_compte" v-model="modelValue.numero_compte" required>
          </div>
          <div class="form-group">
            <label for="type_bank">type_bank</label>
            <input type="text" class="form-control" id="type_bank" v-model="modelValue.type_bank" required>
          </div>
         
          

          <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <div v-if="successMessage" class="alert alert-success text-center">
          <i class="fa fa-check-circle"></i>
          {{ successMessage }}
        </div>
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
        nom_francais: "",
        nom_arabe: "",
        prenom_francais: "",
        prenom_arabe: "",
        date_naissance: "",
        lieu_naissance: "",
        sex: "",
        email: "",
        password: "",
        username: "",
        user_type: "parent",
        adresse: "",
        photo: null,
        CNI: "",
        tel: "",
        user_id:"",
        eleve_ids: [],
        type_bank:"",
        numero_compte:""
 

      },
      parents: [],
      // groupes: [],
      eleves: [],
      previewPhoto: null,
      successMessage: "",
    };
  },
  mounted() {
    
    this. fetchEleves() ;  // Call the  method when the component is mounted
  },

 methods: {
  fetchEleves() {
    
    axios.get('/eleves') 
      .then(response => {
        this.eleves = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  },



addProfesseur() {
  const formData = new FormData();
  formData.append("nom_francais", this.modelValue.nom_francais);
      formData.append("nom_arabe", this.modelValue.nom_arabe);
      formData.append("prenom_francais", this.modelValue.prenom_francais);
      formData.append("prenom_arabe", this.modelValue.prenom_arabe);
      formData.append("date_naissance", this.modelValue.date_naissance);
      formData.append("lieu_naissance", this.modelValue.lieu_naissance);
      formData.append("sex", this.modelValue.sex);
      formData.append("email", this.modelValue.email);
      formData.append("password", this.modelValue.password);
      formData.append("username", this.modelValue.username);
      formData.append("user_type", this.modelValue.user_type);
      formData.append("adresse", this.modelValue.adresse);
      formData.append("CNI", this.modelValue.CNI);
      formData.append("tel", this.modelValue.tel);
      formData.append("type_bank", this.modelValue.type_bank); // Append the photo file to the form data
      formData.append("numero_compte", this.modelValue.numero_compte); // Append the photo file to the form data
      // Append other form fields
  formData.append('user_id', this.modelValue.user_id);
  this.modelValue.eleve_ids.forEach((groupId) => {
    formData.append('eleve_ids[]', groupId);
  });

 axios.post('/parents', formData, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  })
    .then(response => {
     
    })
    .catch(error => {
      console.log(error.response.data);
      this.errors = error.response.data.errors;
    });
},
   
addBankinfo(){
  const bankinfoData = {
    professeur_id: this.modelValue.professeur_id,
    // Add other bankinfo-related fields
  };

  axios.post('/bankinformations', bankinfoData)
    .then(response => {
      // Handle the response
    })
    .catch(error => {
      console.log(error.response.data);
      this.errors = error.response.data.errors;
    });
},

   
handlePhotoChange(event) {
      this.modelValue.photo = event.target.files[0];
      this.previewImage(event);
    },
    previewImage(event) {
      const file = event.target.files[0];
      if (!file) {
        return;
      }

      const reader = new FileReader();

      reader.onload = (event) => {
        const img = document.getElementById("image-preview");
        img.style.display = "block";
        img.src = event.target.result;
      };

      reader.readAsDataURL(file);
    },

clearForm() {
  this.modelValue = {
    nom_francais: "",
    nom_arabe: "",
    prenom_francais: "",
    prenom_arabe: "",
    date_naissance: "",
    lieu_naissance: "",
    sex: "",
    email: "",
    password: "",
    username: "",
    user_type: "professeur",
    adresse: "",
    photo: null,
    CNI: "",
    rib: "",
    groupe_id: ""
  };
  this.previewPhoto = null;
  this.successMessage = "";
}

  },
 
}
;
</script>


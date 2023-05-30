<template>
  <MainLayout>
    <div class="content-header">
      <div class="container-fluid">
        <h2>Ajouter des élèves:</h2>
      

        <form @submit.prevent="addUser" enctype="multipart/form-data">
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
          <img src="" alt="" id="image-preview" style="width:30%; height:30%; border-radius:15px; display:none;">
        </div>
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
         
          <!-- <div class="form-group">
            <label for="user_type"></label>
            <input type="text" class="form-control" id="user_type" v-model="modelValue.user_type" required>
          </div> -->
          <div class="form-group">
            <label for="user_type">Type d'utilisateur :</label>
            <select  class="form-control" id="user_type" v-model="modelValue.user_type" required>
              <option value=""></option>
              <!-- <option value="F">eleve</option> -->
             <option value="professeur">professeur</option>
               <!-- <option value="M">admin</option>
              <option value="M">parent</option> -->
            </select>
            
          </div>
          <div class="form-group">
            <label for="CNI">CNI</label>
            <input type="text" class="form-control" id="CNI" v-model="modelValue.CNI" required>
          </div>
          
          <div class="form-group">
            <label for="tel">tel</label>
            <input type="text" class="form-control" id="tel" v-model="modelValue.tel" required>
          </div>
          <div class="form-group">
            <label for="diplom">Diplom</label>
            <input type="text" class="form-control" id="diplom" v-model="modelValue.diplom" required>
          </div>
          <!-- <div class="form-group">
            <label for="numero_compte">numero_compte</label>
            <input type="text" class="form-control" id="numero_compte" v-model="modelValue.numero_compte" required>
          </div>
          <div class="form-group">
            <label for="type_bank">type_bank</label>
            <input type="text" class="form-control" id="type_bank" v-model="modelValue.type_bank" required>
          </div>
          <div class="form-group">
            <label for="rib">RIB</label>
            <input type="text" class="form-control" id="rib" v-model="modelValue.rib" required>
          </div> -->
          <!-- <div>
  <label for="groupe_id">Group:</label>
  <select id="groupe_id" v-model="modelValue.groupe_id">
    <option v-for="groupe in groupes" :key="groupe.id" :value="groupe.id">{{ groupe.nom }}</option>
  </select>
</div> -->
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
        user_type: "",
        adresse: "",
        photo: null,
        CNI: "",
        tel: "",
        diplom: "",
        rib: "",
        type_bank:"",
        numero_compte:""

      },
      professeurs: [],
      // groupes: [],
      previewPhoto: null,
      successMessage: "",
    };
  },
  mounted() {
    // this.fetchEtudiants();
    // this.fetchClasses();
  },

 methods: {
  // fetchClasses() {
  //     axios.get('/groupes')
  //       .then(response => {
  //         this.groupes = response.data;
  //       })
  //       .catch(error => {
  //         console.error(error);
  //       });
  //   },
   

   

  addUser() {
  axios.post('/users', this.modelValue)
    .then(response => {
          const userId = response.data.user_id;
          this.modelValue.user_id = userId;
          this.addProfesseur();
          this.successMessage = "Form submitted successfully";
          this.clearForm();
        })
        .catch(error => {
          console.log(error.response.data);
          this.errors = error.response.data.errors;
        });
    },

addProfesseur() {
  const formData = new FormData();
  formData.append('photo', this.modelValue.photo); // Append the photo file to the form data
  formData.append('diplom', this.modelValue.diplom);
  formData.append('CNI', this.modelValue.CNI);
  formData.append('tel', this.modelValue.tel);
  formData.append('user_id', this.modelValue.user_id);

 axios.post('/professeurs', formData, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  })
    .then(response => {
      const professeurId = response.data.professeur_id;
      // this.modelValue.professeur_id = professeurId;
      // this.addBankinfo();
      // Handle the response
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
    const img = document.getElementById('image-preview');
    if (img) {
      img.src = event.target.result;
      img.style.display = 'block';
    }
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
    user_type: "",
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


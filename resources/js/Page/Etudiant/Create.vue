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
        <div class="form-group">
            <label for="adresse">Adress</label>
            <input type="text" class="form-control" id="adresse" v-model="modelValue.adresse" required>
          </div>
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
            <label for="CNE">CNE</label>
            <input type="text" class="form-control" id="CNE" v-model="modelValue.CNE" required>
          </div>
                <div>
        <label for="groupe_id">Group:</label>
        <select id="groupe_id" v-model="modelValue.groupe_id">
          <option v-for="groupe in groupes" :key="groupe.id" :value="groupe.id">{{ groupe.nom }}</option>
        </select>
      </div>

      <div>
    <input type="hidden" v-model="modelValue.user_type">
    <!-- Other code -->
  </div>


        <div>
          <label for="existe">si parent existe </label>
          <input type="radio" id="existe" name="parent" value="1" v-model="parentcheck" >
          <label for="nom_existe"> si n'existe pas  </label>
          <input type="radio" id="nom_existe" name="parent" value="0" v-model="parentcheck" >

        </div>
        <div v-if="parentcheck==1">
          <div v-for="parent in parents" :key="parent.id">
          <label>
            <input type="checkbox" v-model="modelValue.parents_ids" :value="parent.id">
            {{ parent.user.nom_arabe }} {{ parent.user.id }}
          </label>
        </div>
        </div>
        <div v-if="parentcheck==0">
  
          <div class="form-group">
            <label for="nom_francais_parent">Nom en français</label>
            <input type="text" class="form-control" id="nom_francais_parent" v-model="modelValue.nom_francais_parent" required>
          </div>
          <div class="form-group">
            <label for="nom_arabe">Nom en arabe</label>
            <input type="text" class="form-control" id="nom_arabe_parent" v-model="modelValue.nom_arabe_parent" required>
          </div>
          <div class="form-group">
            <label for="prenom_francais_parent">Prénom en français</label>
            <input type="text" class="form-control" id="prenom_francais_parent" v-model="modelValue.prenom_francais_parent" required>
          </div>
          <div class="form-group">
            <label for="prenom_arabe_parent">Prénom en arabe</label>
            <input type="text" class="form-control" id="prenom_arabe_parent" v-model="modelValue.prenom_arabe_parent" required>
          </div>
          <div class="form-group">
            <label for="date_naissance_parent">Date de naissance</label>
            <input type="date" class="form-control" id="date_naissance_parent" v-model="modelValue.date_naissance_parent" required>
          </div>
          <div class="form-group">
            <label for="lieu_naissance_parent">Lieu de naissance</label>
            <input type="text" class="form-control" id="lieu_naissance_parent" v-model="modelValue.lieu_naissance_parent" required>
          </div>
          <div class="form-group">
            <label for="sex_parent">Sex :</label>
            <select class="form-control" id="sex_parent" v-model="modelValue.sex_parent" required>
              <option value=""></option>
              <option value="F">F</option>
              <option value="M">M</option>
            </select>
          </div>
          <div class="form-group">
            <label for="adresse_parent">Adresse</label>
            <input type="text" class="form-control" id="adresse_parent" v-model="modelValue.adresse_parent" required>
          </div>
          <div class="form-group">
            <label for="email_parent">Email</label>
            <input type="email" class="form-control" id="email_parent" v-model="modelValue.email_parent" required>
          </div>
          <div class="form-group">
            <label for="password_parent">Mot de passe</label>
            <input type="password" class="form-control" id="password_parent" v-model="modelValue.password_parent" required>
          </div>
          <div class="form-group">
            <label for="username_parent">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username_parent" v-model="modelValue.username_parent" required>
          </div>
         
          <div class="form-group">
            <label for="CNI_parent">CNI</label>
            <input type="text" class="form-control" id="CNI_parent" v-model="modelValue.CNI_parent" required>
          </div>
          <div class="form-group">
            <label for="tel_parent">Téléphone</label>
            <input type="text" class="form-control" id="tel_parent" v-model="modelValue.tel_parent" required>
          </div>
          <div class="form-group">
            <label for="numero_compte">numero_compte</label>
            <input type="text" class="form-control" id="numero_compte" v-model="modelValue.numero_compte" required>
          </div>
          <div class="form-group">
            <label for="type_bank">type_bank</label>
            <input type="text" class="form-control" id="type_bank" v-model="modelValue.type_bank" required>
          </div>
          <div>
    <input type="hidden" v-model="modelValue.user_type_parent">
    <!-- Other code -->
  </div>              
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
        user_type: "eleve",
        adresse: "",
        photo: null,
        CNE: "",
        tel_parent: "",
        CNI_parent: "",
        user_type_parent: "parent",
        username_parent: "",
        password_parent: "",
        email_parent: "",
        adresse_parent: "",
        sex_parent: "",
        type_bank:"",
        numero_compte:"",
        lieu_naissance_parent: "",
        date_naissance_parent: "",
        prenom_arabe_parent: "",
        prenom_francais_parent: "",
        nom_arabe_parent: "",
        nom_francais_parent: "",
        parents_ids:[]
            },
      eleves: [],
      groupes: [],
      previewPhoto: null,
      successMessage: "",
      parentcheck:"",
      parents:[]
    };
  },
  mounted() {
    // this.fetchEtudiants();
    this.fetchClasses();
    this.fetchPreants();
  },

 methods: {
  fetchClasses() {
      axios.get('/groupes')
        .then(response => {
          this.groupes = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
   
  addUser() {
  axios.post('/users', this.modelValue)
    .then(response => {
          const userId = response.data.user_id;
          this.modelValue.user_id = userId;
          this.addEleve();
          this.successMessage = "Form submitted successfully";
          this.clearForm();
        })
        .catch(error => {
          console.log(error.response.data);
          this.errors = error.response.data.errors;
        });
    },
    fetchPreants() {
    // Fetch the groupes from the server or any other data source
    // Assign the fetched groupes to the groupes property
    axios.get('/parents') // Replace '/api/groupes' with the actual endpoint to fetch the groupes
      .then(response => {
        this.parents = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  },

    addEleve() {
      const formData = new FormData();
  formData.append('photo', this.modelValue.photo); // Append the photo file to the form data

      formData.append('CNE', this.modelValue.CNE);
      formData.append('user_id', this.modelValue.user_id);
      formData.append('groupe_id', this.modelValue.groupe_id);
      formData.append('tel_parent', this.modelValue.tel_parent);
      formData.append('CNI_parent', this.modelValue.CNI_parent);
      formData.append('user_type_parent', this.modelValue.user_type_parent);
      formData.append('username_parent', this.modelValue.username_parent);
      formData.append('password_parent', this.modelValue.password_parent);
      formData.append('email_parent', this.modelValue.email_parent);
      formData.append('adresse_parent', this.modelValue.adresse_parent);
      formData.append('sex_parent', this.modelValue.sex_parent);
      formData.append('lieu_naissance_parent', this.modelValue.lieu_naissance_parent);
      formData.append('date_naissance_parent', this.modelValue.date_naissance_parent);
      formData.append('prenom_arabe_parent', this.modelValue.prenom_arabe_parent);
      formData.append('prenom_francais_parent', this.modelValue.prenom_francais_parent);
      formData.append('nom_francais_parent', this.modelValue.nom_francais_parent);
      formData.append('nom_arabe_parent', this.modelValue.nom_arabe_parent);
      formData.append("type_bank", this.modelValue.type_bank); // Append the photo file to the form data
      formData.append("numero_compte", this.modelValue.numero_compte); // Append the photo file to the form data
      formData.append('parentcheck', this.parentcheck);
      
      this.modelValue.parents_ids.forEach((parentId) => {
    formData.append('parents_ids[]', parentId);
    console.log(formData);
  });
      axios.post('/eleves', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      }).then(response => {
        const eleveId = response.data.eleve_id;
        // Handle the response
      }).catch(error => {
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
    user_type: "eleve",
    adresse: "",
    photo: null,
    CNE: "",
    groupe_id: ""
  };
  this.previewPhoto = null;
  this.successMessage = "";
}

  }
 
}
;
</script>


<template>
  <MainLayout>
    <div class="content-header">
      <div class="container-fluid">
        <form @submit.prevent="addProfessor">
          <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" v-model="modelValue.first_name" required>
  </div>
  <div class="form-group">
    <label for="prenom">Prénom</label>
    <input type="text" class="form-control" id="prenom" v-model="modelValue.last_name" required>
  </div>
          <div class="form-group">
            <label for="age">Âge</label>
            <input type="number" class="form-control" id="age" v-model="modelValue.age" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" v-model="modelValue.email" required>
          </div>
          <div class="form-group">
            <label for="diplome">Diplôme</label>
            <input type="text" class="form-control" id="diplome" v-model="modelValue.diplome" required>
          </div>
          <div class="form-group">
            <label for="salaire">Salaire</label>
            <input type="number" class="form-control" id="salaire" v-model="modelValue.salaire" required>
          </div>
          <div class="form-group">
            <label for="address">Adress</label>
            <input type="text" class="form-control" id="address" v-model="modelValue.address" required>
          </div>
          <div class="form-group">
  <label for="niveau_scolaire">Niveau Scolaire :</label>
  <select :class="{'is-invalid': !selectedNiveauScolaire}" class="form-control" id="niveau_scolaire" v-model="selectedNiveauScolaire">
    <option value=""></option>
    <option :value="niveau_scolaire" v-for="niveau_scolaire in niveau_scolaires" :key="niveau_scolaire.id">{{ niveau_scolaire.nom }}</option>
  </select>
  <span v-if="!selectedNiveauScolaire" class="invalid-feedback error">Please select a niveau scolaire</span>
</div>

          <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control" id="photo" @change="handlePhotoChange" required>
            <img :src="modelValue.photoPreview" alt="Selected Image" class="img-thumbnail" style="max-width: 100px; max-height: 50px">
          </div>
          <div class="form-group">
    <label for="phone_number">Numéro de téléphone</label>
    <input type="tel" class="form-control" id="phone_number" v-model="modelValue.phone_number" required>
  </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Ajouter">
          </div>
        </form>
        <div v-if="errors.length > 0" class="alert alert-danger">
      <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>
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
        first_name: "",
        last_name: "",
        age: "",
        email: "",
        diplome: "",
        salaire: "",
        address: "",
        photo: "",
        photoPreview: "",
        phone_number: "",
      },
      niveau_scolaires: [],
      errors: [],
      selectedNiveauScolaire: null
    };
  },
  mounted() {
    this.fetchNiveauScolaires();
  },
  methods: {
    fetchNiveauScolaires() {
      try {
        console.log('on mounted');
        axios.get('adminn/nivScolairListe').then((response) => {
          console.log(response.data);
          this.selectedNiveauScolaire = response.data[0]; // Set a default value if needed
          this.niveau_scolaires = response.data;
        });
      } catch (error) {
        console.error(error);
      }
    },
    addProfessor() {
  // Create a FormData object
  const formData = new FormData();

  // Append the modelValue data to the FormData object
 
  formData.append('nom', this.modelValue.first_name);
      formData.append('prenom', this.modelValue.last_name);
      // Remaining form fields
  formData.append('age', this.modelValue.age);
  formData.append('email', this.modelValue.email);
  formData.append('diplome', this.modelValue.diplome);
  formData.append('salaire', this.modelValue.salaire);
  formData.append('address', this.modelValue.address);
  formData.append('niveau_scolaire', this.selectedNiveauScolaire.id); // Use selectedNiveauScolaire
  formData.append('photo', this.modelValue.photo);
  formData.append('phone_number', this.modelValue.phone_number);
      // Remaining form fields

  axios
    .post('/api/admin/professeur', formData)
    .then((response) => {
      this.modelValue = {
        first_name: "",
        last_name: "",
        age: "",
        email: "",
        diplome: "",
        salaire: "",
        address: "",
        photo: "",
        photoPreview: "",
        phone_number: "",
      };
      this.errors = []; // Clear the errors array
      console.log(response.data);
      // Display a success message or perform any other necessary actions
    })
    .catch((error) => {
      if (error.response && error.response.data && error.response.data.errors) {
        this.errors = Object.values(error.response.data.errors).flat();
      } else {
        console.log(error);
      }
    });
},


    handlePhotoChange(event) {
      const file = event.target.files[0];
      this.modelValue.photo = file;
      this.previewImage(event);
    },
    previewImage(event) {
      if (event.target.files.length > 0) {
        const file = event.target.files[0];
        const src = URL.createObjectURL(file);
        this.modelValue.photoPreview = src;
      }
    },
  },
};
</script>


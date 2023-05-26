<template>
  <MainLayout>
    <div class="content-header">
      <div class="container-fluid">
        <h2>les fromation de virement  : </h2> <div v-if="successMessage" class="alert alert-success text-center">
      <i class="fa fa-check-circle"></i>
      {{ successMessage }}
    </div>

        <form  @submit.prevent="addViremnt" enctype="multipart/form-data">
          <div class="form-group">
        <label for="salaire">Salire</label>
          <input type="text" class="form-control" id="salaire" v-model="modelValue.salaire" required>
         </div>
          <!-- <div class="form-group">
    <label for="date">Date de virement </label>
    <input type="date" class="form-control" id="date" v-model="modelValue.date" required>
  </div> -->
          <div class="form-group">
    <label for="rib">RIB</label>
    <input type="text" class="form-control" id="rib" v-model="modelValue.rib" required>
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
          <div class="form-group">
            <label for="diplom">Diplôme</label>
            <input type="text" class="form-control" id="diplom" v-model="modelValue.diplom" required>
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
      salaire: '',
      est_paye: '',
      rib: '',
      // date: '',
      prenom: '',
      nom: '',
      date_naissance: '',
      lieu_naissance: '',
      tel: '',
      diplom: '',
      address: '',
      sex: '',
      photo: null, // Change this line to null  
         
    },
    errors: {},
    successMessage: ""
   
  };
},

 methods: {
    addViremnt() {
  axios.post('/api/virements', this.modelValue)
    .then(response => {
      const virementId = response.data.virement_id;
      this.modelValue.virement_id = virementId;

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
  formData.append('photo', this.modelValue.photo); // Append the photo file to the form data

  // Append other fields to the form data
  formData.append('prenom', this.modelValue.prenom);
  formData.append('nom', this.modelValue.nom);
  formData.append('date_naissance', this.modelValue.date_naissance);
  formData.append('lieu_naissance', this.modelValue.lieu_naissance);
  formData.append('tel', this.modelValue.tel);
  formData.append('diplom', this.modelValue.diplom);
  formData.append('salaire', this.modelValue.salaire);
  formData.append('address', this.modelValue.address);
  formData.append('sex', this.modelValue.sex);
  formData.append('virement_id', this.modelValue.virement_id); // Include the virement_id

  axios
    .post('/api/professuers', formData, {
      headers: {
        'Content-Type': 'multipart/form-data', // Set the content type to multipart/form-data
      },
    })
    .then(response => {
      const professorId = response.data.professuer_id;

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
}

  },
}
;
</script>


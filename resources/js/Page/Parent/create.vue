<template>
  <MainLayout>
    <div class="content-header">
      <div class="container-fluid">
        <h2>Ajouter parents :</h2>

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
            <select class="form-control" id="sex" v-model="modelValue.sex" required>
              <option value=""></option>
              <option value="F">F</option>
              <option value="M">M</option>
            </select>
          </div>
          <div class="form-group">
            <label for="adresse">Adresse</label>
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
            <label for="user_type">Type d'utilisateur :</label>
            <select class="form-control" id="user_type" v-model="modelValue.user_type" required>
              <option value=""></option>
              <option value="F">parent</option>
            </select>
          </div>
          <div class="form-group">
            <label for="CNE">CNI</label>
            <input type="text" class="form-control" id="CNE" v-model="modelValue.CNI" required>
          </div>
          <div class="form-group">
            <label for="tel">Téléphone</label>
            <input type="text" class="form-control" id="tel" v-model="modelValue.tel" required>
          </div>
          <!-- <div class="form-group"> -->
           
            <!-- <select id="eleve_id" v-model="selectedEleves" multiple required>
              <option value="">Select Élève</option>
              <option v-for="eleve in eleves" :key="eleve.id" :value="eleve.id">{{ eleve.id }}</option>
            </select> -->
          
            <div class="form-group">
  <label for="eleve_id">Élèves :</label>
  <select id="eleve_id" v-model="modelValue.eleve_ids" multiple required>
    <option value="">Select Élève</option>
    <option v-for="eleve in eleves" :key="eleve.id" v-bind:value="eleve.id">
      <!-- <span v-for="user in eleve.users" :key="user.id" class="spanseelct">{{ user.nom_francais }} {{ user.prenom_francais }}</span> -->
      {{ eleve.id }}
    </option>
  </select>
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
        user_type: "",
        adresse: "",
        CNI: "",
        tel: "",
        eleve_ids: [], // Update property name to eleve_ids
      },
      eleves: [],
      selectedEleves: [],
      successMessage: "",
    };
  },
  mounted() {
    this.fetchEleves();
  },
  methods: {
    fetchEleves() {
      axios
        .get("/eleves")
        .then((response) => {
          this.eleves = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    addUser() {
      axios
        .post("/users", this.modelValue)
        .then((response) => {
          const userId = response.data.user_id;
          this.modelValue.user_id = userId;
          this.addParent();
        })
        .catch((error) => {
          console.log(error.response.data);
          this.errors = error.response.data.errors;
        });
    },
    addParent() {
      this.modelValue.eleve_ids = this.selectedEleves.map((eleve) => eleve.id);
      axios
        .post("/parents", this.modelValue)
        .then((response) => {
          const parentId = response.data.parent_id;
          this.modelValue.parent_id = parentId;
          this.addAssociations();
        })
        .catch((error) => {
          console.log(error.response.data);
          this.errors = error.response.data.errors;
        });
    },
   
    async addAssociations() {
  try {
    for (const eleveId of this.modelValue.eleve_ids) {
      await axios.post("/parents/eleves", {
        eleve_ids: eleveId,
        parent_id: this.modelValue.parent_id,
      });
      console.log({
        eleve_ids: [eleveId],
        parent_id: this.modelValue.parent_id
      });
    }
    this.successMessage = "Parents and élèves associated successfully";
    // this.clearForm();
  } catch (error) {
    console.error(error);
  }
},



    // clearForm() {
    //   this.modelValue = {
    //     nom_francais: "",
    //     nom_arabe: "",
    //     prenom_francais: "",
    //     prenom_arabe: "",
    //     date_naissance: "",
    //     lieu_naissance: "",
    //     sex: "",
    //     email: "",
    //     password: "",
    //     username: "",
    //     user_type: "",
    //     adresse: "",
    //     CNI: "",
    //     tel: "",

    //     eleve_ids: [], // Reset the eleve_ids array
    //   };
    // },
  },
};
</script>

<style scoped>
.content-header {
  margin-top: 20px;
}
.spanseelct{
  color:black ;
}
</style>

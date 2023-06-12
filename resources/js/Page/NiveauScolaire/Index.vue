<template>
  <MainLayout>
    <!-- Content body -->
    <div>
      <div>
        <div>
          <div>
            <div>
              <div>
                <button class="button" @click="toggleForm('niveauScolaire')">
                  <i :class="showNiveauForm ? 'fa fa-minus-circle' : 'fa fa-plus-circle'"></i>
                  {{ showNiveauForm ? 'Cancel' : ' NiveauScolaire' }}
                </button>
                <form v-if="showNiveauForm" @submit.prevent="addNiveauScolaire">
                      <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" v-model="nom" class="input">
                  </div>
                  <div class="form-group">
                    <label for="anne">Année scolaire</label>
                    <input type="text" id="anne" v-model="année_scolaire" class="input">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" v-model="description" class="input">
                  </div>
                  <button class="button-primary">Save</button>
                </form>
                <form v-if="showForm1" @submit.prevent="saveUpdatedNiveauScolaire">
                  <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" v-model="niveau_scolaire.nom" class="input">
                  </div>
                  <div class="form-group">
                    <label for="année_scolaire">Année scolaire</label>
                    <input type="text" id="année_scolaire" v-model="niveau_scolaire.année_scolaire" class="input">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" v-model="niveau_scolaire.description" class="input">
                  </div>
                  <button class="button-primary">Save</button>
                </form>
              </div>

              <div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Niveau Scolaire</th>
                      <th>Description</th>
                      <th>Groupes</th> <!-- Nouvelle colonne pour afficher les groupes -->
                      <th style="width: 150px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(niveau_scolaire) in niveau_scolaires" :key="niveau_scolaire.id" :id="'div' + niveau_scolaire.id">
                      <td>{{ niveau_scolaire.nom }}</td>
                      <td>{{ niveau_scolaire.description }}</td>
                      <td>
                        <tr>
                        <th>nom</th>
                        <th>salle</th>
                        <th>capacité</th>
                      </tr>
                      <tr>
                        <td> <ul>
                          <li v-for="groupe in niveau_scolaire.groupes" :key="groupe.id">{{ groupe.nom }} </li>
                        </ul></td>
                        <td> <ul>
                          <li v-for="groupe in niveau_scolaire.groupes" :key="groupe.id">   {{ groupe.salle }}  </li>
                        </ul></td>
                        <td> <ul>
                          <li v-for="groupe in niveau_scolaire.groupes" :key="groupe.id">  {{ groupe.capacity}}</li>
                        </ul></td>
                      </tr>
                       
                      </td>
                      <td>
                        <div class="button-group">
                          <button class="button-info" @click="updateNiveauScolaire(niveau_scolaire)">
                            <i class="fas fa-pen fa-beat"></i>
                          </button>
                          <button class="button-danger" @click="deleteNiveauScolaire(niveau_scolaire.id)">
                            <i class="fas fa-solid fa-trash fa-beat fa-xl"></i>
                          </button>
                          <button class="button-primary" @click="toggleGroupeForm(niveau_scolaire.id)">
                              {{ niveau_scolaire.id === activeNiveauId && showForm2 ? 'Cancel' : '+Groupe' }}
                              </button>

                        </div>
                        <!-- Formulaire pour ajouter un groupe au niveau scolaire -->
                        <form  v-if="niveau_scolaire.id === activeNiveauId  && showForm2" @submit.prevent="addGroupe">
                          <div class="form-group">
                            <label for="groupe-nom">Nom du groupe</label>
                            <input type="text" id="groupe-nom" v-model="groupe.nom" class="input">
                          </div>
                          <div class="form-group">
                            <label for="groupe-capacite">Capacité</label>
                            <input type="text" id="groupe-capacite" v-model="groupe.capacite" class="input">
                          </div>
                          <div class="form-group">
                            <label for="groupe-salle">Salle</label>
                            <input type="text" id="groupe-salle" v-model="groupe.salle" class="input">
                          </div>
                          <button class="button-primary">Save</button>
                        </form>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<style>
  .button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 8px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
  }

  .button-primary {
    background-color: #04855a;
    
  }

  .button-info {
    background-color: #17A2B8;
    

  }

  .button-danger {
    background-color: #DC3545;
  }

  .form-group {
    margin-bottom: 16px;
  }

  .input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
  }

  .table {
    width: 100%;
    border-collapse: collapse;
  }

  .table th,
  .table td {
    padding: 8px;
    border: 1px solid #ccc;
  }

  .button-group {
    display: flex;
    justify-content: space-between;
  }
</style>

<script>
import MainLayout from '../../Layouts/MainLayout.vue';
import axios from 'axios';

export default {
  components: {
    MainLayout
  },
  data() {
    return {
      showNiveauForm: false,
      showGroupeForm1: false,
      showForm1: false,
      showForm2: false,
      nom: '',
      id: '',
      année_scolaire:'',
      description: '',
      niveau_scolaires: [],
      niveau_scolaire: {},
      activeNiveauId: null,
      groupe: {
        nom: '',
        capacite: '',
        niveau_scolaire_id: null
      },
  }},
  mounted() {
this.affichera();
  },
  methods: {
    affichera(){
      try {
      console.log('on mounted');
      axios.get('/niveau_scolires').then((response) => {
        console.log(response.data);
        this.niveau_scolaires = response.data;
      });
    } catch (error) {
      console.error(error);
    }
    },
    async addNiveauScolaire() {
      const newNiveauScolaire = {
        nom: this.nom,
        description: this.description,
        année_scolaire: this.année_scolaire,
      };
      try {
        const response = await axios.post('/niveau_scolires', newNiveauScolaire);
        // handle the response as needed
        this.nom = '';
    this.description = ''; 
    this.année_scolaire = ''; 
    this.niveau_scolaires = response.data;
        this.showForm = false;
        this.affichera();
      } catch (error) {
        console.error(error);
      }
    },
    


    async deleteNiveauScolaire(id) {
      try {
        const response = await axios.delete(`/niveau_scolires/${id}`);
        this.niveau_scolaires = this.niveau_scolaires.filter(niveau_scolaire => niveau_scolaire.id !== id);
      } catch (error) {
        console.log(error);
      }
    },

    async updateNiveauScolaire(niveau_scolaire) {
      // Set the selected niveauScolaire in the data
      this.niveau_scolaire = { ...niveau_scolaire };
      this.showForm1 = true; // Show the form for updating
    },

    async saveUpdatedNiveauScolaire() {
      try {
    const response = await axios.put(`/niveau_scolires/${this.niveau_scolaire.id}`, {
      nom: this.niveau_scolaire.nom,
      description: this.niveau_scolaire.description,
      année_scolaire: this.niveau_scolaire.année_scolaire
    });
    console.log(response.data.message);
    try {
      console.log('on mounted');
      axios.get('/niveau_scolires').then((response) => {
        console.log(response.data);
        this.niveau_scolaires = response.data;
        this.affichera();

      });
      // this.affichera();
    } catch (error) {
      console.error(error);
    }
    this.showForm1 = false; // Hide the form after successful update
  } catch (error) {
    console.log(error.response.data.message);
  }
    }
  }
};
</script>
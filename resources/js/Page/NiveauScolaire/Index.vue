<template>
  <MainLayout>
    <!-- Content body -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
                <!-- <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                  </ul>
                </div> -->
                <button class="btn btn-success" @click="showForm = !showForm">
                  <i :class="showForm ? 'fa fa-minus-circle' : 'fa fa-plus-circle'"></i>
                  {{ showForm ? 'Cancel' : 'Add NiveauScolaire' }}
                </button>
                <form v-if="showForm" @submit.prevent="addNiveauScolaire">
                  <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" v-model="nom">
                  </div>
                  <div class="form-group">
                    <label for="anne">Année scolaire</label>
                    <input type="text" class="form-control" id="anne" v-model="année_scolaire">
                  </div>
                  <div class="form-group">
                    <label for="description">Discription</label>
                    <input type="text" class="form-control" id="description" v-model="description">
                  </div>
                  <button class="btn btn-primary" >Save</button>
                </form>
                <form v-if="showForm1" @submit.prevent="saveUpdatedNiveauScolaire">
                  <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" v-model="niveau_scolaire.nom">
                  </div>
                  <div class="form-group">
                    <label for="année_scolaire">Année scolaire</label>
                    <input type="text" class="form-control" id="année_scolaire" v-model="niveau_scolaire.année_scolaire">
                  </div>
                  <div class="form-group">
                    <label for="description">Discription</label>
                    <input type="text" class="form-control" id="description" v-model="niveau_scolaire.description">
                  </div>
                  
                  <button class="btn btn-primary" >Save</button>
                </form>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Niveau Scolaire</th>
                      <th style="width: 100px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(niveau_scolaire) in niveau_scolaires" :key="niveau_scolaire.id" :id="'div' + niveau_scolaire.id">
                      <td>{{ niveau_scolaire.nom }}</td>
                      <td>{{ niveau_scolaire.description }}</td>
                      <td>
                        <div class="d-flex justify-items-center">
                          <button class="btn btn-info mr-2" @click="updateNiveauScolaire(niveau_scolaire)">
                            <i class="fas fa-pen fa-beat"></i>
                          </button>
                          <button class="btn btn-danger" @click="deleteNiveauScolaire(niveau_scolaire.id)">
                            <i class="fas fa-solid fa-trash fa-beat fa-xl"></i>
                          </button>
                        </div>
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

<script>
import MainLayout from '../../Layouts/MainLayout.vue';
import axios from 'axios';

export default {
  components: {
    MainLayout
  },
  data() {
    return {
      showForm: false,
      showForm1: false,
      nom: '',
      id: '',
      année_scolaire:'',
      description: '',
      niveau_scolaires: [],
      niveau_scolaire: {}
    };
  },
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
      });
      this.affichera();
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

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
                <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                  </ul>
                </div>
                <button class="btn btn-success" @click="showForm = !showForm">
                  <i :class="showForm ? 'fa fa-minus-circle' : 'fa fa-plus-circle'"></i>
                  {{ showForm ? 'Cancel' : 'Add NiveauScolaire' }}
                </button>
                <form v-if="showForm">
                  <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" v-model="nom">
                  </div>
                  <button class="btn btn-primary" @click="addNiveauScolaire">Save</button>
                </form>
                <form v-if="showForm1">
                  <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" v-model="niveauScolaire.nom">
                  </div>
                  <button class="btn btn-primary" @click="saveUpdatedNiveauScolaire">Save</button>
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
                    <tr v-for="(niveauScolaire) in niveauScolaires" :key="niveauScolaire.id" :id="'div' + niveauScolaire.id">
                      <td>{{ niveauScolaire.nom }}</td>
                      <td>
                        <div class="d-flex justify-items-center">
                          <button class="btn btn-info mr-2" @click="updateNiveauScolaire(niveauScolaire)">
                            <i class="fas fa-pen fa-beat"></i>
                          </button>
                          <button class="btn btn-danger" @click="deleteNiveauScolaire(niveauScolaire.id)">
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
      niveauScolaires: [],
      niveauScolaire: {}
    };
  },
  mounted() {
    try {
      console.log('on mounted');
      axios.get('adminn/nivScolairListe').then((response) => {
        console.log(response.data);
        this.niveauScolaires = response.data;
      });
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async addNiveauScolaire() {
      const newNiveauScolaire = {
        nom: this.nom
      };
      try {
        const response = await axios.post('adminn/nivScolaircreate', newNiveauScolaire);
        // handle the response as needed
        this.showForm = false;
      } catch (error) {
        console.error(error);
      }
    },

    async deleteNiveauScolaire(id) {
      try {
        const response = await axios.delete(`/api/adminn/nivScolairdelete/${id}`);
        this.niveauScolaires = this.niveauScolaires.filter(niveauScolaire => niveauScolaire.id !== id);
      } catch (error) {
        console.log(error);
      }
    },

    async updateNiveauScolaire(niveauScolaire) {
      // Set the selected niveauScolaire in the data
      this.niveauScolaire = { ...niveauScolaire };
      this.showForm1 = true; // Show the form for updating
    },

    async saveUpdatedNiveauScolaire() {
      try {
        const response = await axios.put(`/adminn/nivScolairupdate/${this.niveauScolaire.id}`, {
          nom: this.niveauScolaire.nom
        });
        console.log(response.data.message);
        this.showForm1 = false; // Hide the form after successful update
      } catch (error) {
        console.log(error.response.data.message);
      }
    }
  }
};
</script>

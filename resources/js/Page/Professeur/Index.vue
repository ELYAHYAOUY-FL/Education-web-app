<template>
  <MainLayout>
    <!-- Content header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">La liste des niveaux scolaires</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Content body -->
    <div class="content">
      <div class="">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Etudiants</h1>
                <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                  </ul>
                </div>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
              
                      <th>Photo</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Email</th>
                      <th>Age</th>
                      <th>Phone</th>
                      <th>Salaire</th>
                      <th>Diplome </th>
                      <th>Niveau Scolaire</th>
                      <th> Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr v-for="etudiant in etudiants" :key="etudiant.id"> -->
                      <tr v-for="(professuer, index) in professuers" :key="index">
                      
                      <td>{{ professuer. photo}}</td>
                      <td>{{ professuer.first_name }}</td>
                      <td>{{ professuer.last_name }}</td>
                      <td>{{ professuer.email }}</td>
                      <td>{{ professuer.age}}</td>
                      <td>{{professuer.phone_number}}</td>
                      <td>{{professuer.salaire}}</td>
                      <td>{{ professuer.diplome}}</td>
                      <td>{{ professuer.niveau_scolaire ? professuer.niveau_scolaire.nom : 'N/A' }}</td>

                      <td>
                        <div class="d-flex justify-items-center">
                          <button class="btn btn-info mr-2"><i class="fas fa-pen fa-beat"></i></button>
                          <button class="btn btn-danger"><i class="fas fa-solid fa-trash fa-beat fa-xl" @click="deleteProfesseur(professuer.id)"></i></button>
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
        components : { MainLayout},
        data() {
          return {
            professuers: [],
            showForm: false,
            first_name : '',
        last_name : '',
        email : '',
        age : '',
        phone_number : '',
       address : '',
       photo : '',
        salaire : '',
        diplome : '',
        niveau_scolaires: ''
        
           
            
          };
        },
     
mounted() {
    try {
      console.log('on mounted');
      axios.get('api/professuers').then((response) => {
        console.log(response.data);
        this.professuers = response.data;
      });
    } catch (error) {
      console.error(error);
    }
  }, 
  methods: {
    async deleteProfesseur(id) {
  try {
    const response = await axios.delete(`/api/admin/profdelete/${id}`);
    this.professuers = this.professuers.filter(professuer => professuer.id !== id);
  } catch (error) {
    console.log(error);
  }
},

  } 
      };
      </script>
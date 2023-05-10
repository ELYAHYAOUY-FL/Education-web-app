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
                    <tr v-for="niveauScolaire in niveauScolaires" :key="niveauScolaire.id">
                      <td>{{ niveauScolaire.nom }}</td>
                      <td>
                        <div class="d-flex justify-items-center">
                          <button class="btn btn-info mr-2"><i class="fas fa-pen fa-beat"></i></button>
                          <button class="btn btn-danger"><i class="fas fa-solid fa-trash fa-beat fa-xl"></i></button>
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
      niveauScolaires: [{

        'nom':'1émé'
      },
      {

        'nom':'1émé'
      }
      
      ]
    };
  },
  mounted(){
    try {console.log('on mounted');
   axios.get('adminn/nivScolairListe').then((response) => {
    console.log(response.data)
    this.niveauScolaires= response.data
})
  }  catch (error) {
    
    console.error(error);
  }
  
}
};
</script>


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
                    <!-- <tr  v-for="(niveauScolaire,index) in niveauScolaires" :id="'div'+niveauScolaire.id"></tr> -->
                    <tr v-for="(niveauScolaire ) in niveauScolaires" :key="niveauScolaire.id" :id="'div'+niveauScolaire.id">
                      <td>{{ niveauScolaire.nom }}</td>
                      <td>
                        <div class="d-flex justify-items-center">
                          <button class="btn btn-info mr-2"><i class="fas fa-pen fa-beat"></i></button>
                          <button class="btn btn-danger"><i class="fas fa-solid fa-trash fa-beat fa-xl" @click="deleteNiveauScolaire(niveauScolaire.id)"></i></button>
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
      showForm: false,
      nom: '',
      id :'',
      niveauScolaires: []
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
  
},
methods: {
  async addNiveauScolaire() {
    const newNiveauScolaire = {
       nom: this.nom };
    try {
      const response = await axios.post('adminn/nivScolaircreate', newNiveauScolaire);
      // handle the response as needed
      this.showForm = false;
    } catch (error) {
      console.error(error);
    }
  },
  async deleteNiveauScolaire(id){
  
    let instance = this;
    axios.delete('/api/adminn/nivScolairdelete/' + id)
                .then (resp => {
                  this.niveauScolaires = this.niveauScolaires.filter(niveauScolaire => niveauScolaire.id !== id);

    })
                    // .then(function (response) {
                    //    $('#div'+this.id).fadeOut(300, function() {
                    //         console.log("deleted");
                    //     })
 
                    .catch(function (error) {
                        console.log(error);
                    });
 
}
}


};
</script>


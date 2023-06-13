<template>
  <MainLayout>
    <h1 class="text-center">Liste des parents</h1>
    <div class="container row">
      <div  v-for="(professuer, index) in professuers" :key="index" class="col-md-4 mb-4 fade-in">
        <div class="card-header">
          <h5 class="card-title" v-if="professuer.user">{{ professuer.user.nom_francais }}</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <!-- <div class="col-md-3">
              <img :src="'/photos/' + professuer.photo" alt="Photo" class="professuer-photo img-fluid rounded-circle">
            </div> -->
            <div class="col-md-9">
              <p class="card-text"  @click="toggleDetails(professuer)" style="padding: 20px;" v-if="professuer.user">
                Prénom: {{professuer.user.prenom_francais }}
              </p>
              <p class="card-text"  @click="toggleDetails(professuer)" v-if="professuer.user" >
                Nom: {{professuer.user.nom_francais }}
              </p>
              <transition name="fade">
                <div v-if="professuer.detailsVisible">
                  <p class="card-text">telephone :  {{ professuer.tel }}</p>
                  <p class="card-text"> CNI:  {{ professuer.CNI }}</p>
                 

    </div>
              </transition>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn" style="color: rgb(15, 189, 160);"    @click="deleteProfesseur(professuer.id)">
            <i class="fa fa-trash"></i>
          </button>
          <button class="btn btn" style="color: rgb(40, 112, 100);"  >
            <i class="fa fa-pencil"></i>
          </button>
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
            photo: null,
            
            nom : '',
            prenom : '',
            tel : '',
            diplom : '',
        salaire : '',
        diplome : '',
        virement: '',
        matiere: '',
        groupes: [],
        classe_matiere :'',
        salaire : '',
        classe_id : '',
        titre : ''
            };
        },
     
mounted() {
  this.fetchProfesseur();
  this.fetchGroupes();

  }, 
  methods: {
    fetchProfesseur(){
      axios.get('/parents')
        .then(response => {
          this.professuers = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    fetchGroupes(){
      axios.get('/groupes')
        .then(response => {
          this.groupes = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    async deleteProfesseur(id) {
  try {
    const response = await axios.delete(`/parents/${id}`);
    this.professuers = this.professuers.filter(professuer => professuer.id !== id);
  } catch (error) {
    console.log(error);
  }
},
toggleDetails(professuer) {
      professuer.detailsVisible = !professuer.detailsVisible;
    },

  } 
      };
      </script>
      

      <style scoped>
.fade-in {
  animation: fadeIn 0.5s ease-in-out;
  transition: all 0.4s ease-in-out;

}

@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: translateY(10px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}
.fade-in:hover {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.card-header {
  background-color: rgb(62, 148, 148);
  padding: 10px;
  text-align: center;
}

.card-title {
  margin-bottom: 0;
}

.professuer-photo {
  
  width: 100px;
  height: 90px;
  object-fit: cover;
}

.card-text {
  margin-bottom: 0;
  cursor: pointer;
}
</style>
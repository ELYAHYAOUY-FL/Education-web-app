
<template>
  <MainLayout>
    <div class="content-header">
      <span class="user-name">{{ user.nom_francais }}</span>
      <ul v-for="groupe in professeur.groupes" :key="groupe.id">
        <li class="group-item">
          <div class="group-name">{{ groupe.nom }}</div>
          <table class="student-table">
            <thead>
              <tr>
                <th class="table-header">Eleve</th>
                <th class="table-header">First Exam</th>
                <th class="table-header">Second Exam</th>
                <th class="table-header">Third Exam</th>
                <th class="table-header">Prof Note</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="eleve in groupe.eleves" :key="eleve.id" class="student-row">
                <td class="student-name">
                  {{ eleve.user.nom_francais }} {{ eleve.user.prenom_francais }}
                </td>
                <td class="exam-cell" @click="showform1">
                  <!-- Display first exam here -->
                  <form  @submit.prevent="addNote" enctype="multipart/form-data"  :class="showForm ? 'afficher' : 'nonee'" >
                    <div class="form-group">
                      <label for="note">Note</label>
            <input type="text" class="form-control" id="note" v-model="modelValue.valeur" required>
          </div>
                    <div class="form-group">
                      <label for="date">date d'exam</label>
            <input type="text" class="form-control" id="date" v-model="modelValue.date" required>
          </div>
          <button class="btn btn-primary" >Save</button>
                    <!-- <div class="form-group">
                      <label for="nom_francais">Note</label>
            <input type="text" class="form-control" id="fisrt-exam" v-model="modelValue.valeur" required>
          </div> -->
                  </form>
                </td>
                <td class="exam-cell">
                  <!-- Display second exam here -->
                </td>
                <td class="exam-cell">
                  <!-- Display third exam here -->
                </td>
                <td class="prof-note">
                  <!-- Display professor note here -->
                </td>
              </tr>
            </tbody>
          </table>
        </li>
      </ul>
    </div>
  </MainLayout>
</template>
  
  
  <script>
  import MainLayout from "../../Layouts/MainLayoutProf.vue";
  import { mapGetters } from 'vuex';
  
  export default {
    components: { MainLayout },
    computed: {
      ...mapGetters({
        user: 'auth/user',
      }),
    
    },
    data() {
      return {
        groupes: [],
        matieres: [],
        eleves:[],

        professeur: {
            groupes: [{
                eleves:[]
            }],
        },
        modelValue: {
        date: "",
        valeur: "",
        nom : "",
       

      },
      showForm: false,
      };
    },
    mounted() {
  this.fetchProfesseur();
  this.fetchGroupes();
  this.fetchMatieres();
  this.fetchEleves(); // Call the fetchEleves method
},

    methods: {
      fetchProfesseur() {
        axios
          .get('/professeurs/user/' + this.user.id)
          .then(response => {
            const { data } = response;
      this.professeur.groupes = data.groupes;
           
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchGroupes() {
        axios
          .get('/groupes/')
          .then(response => {
            this.groupes = response.data;
            console.log(this.groupes)
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchEleves() {
        axios
          .get('/eleves')
          .then(response => {
            this.eleves = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchMatieres() {
        axios
          .get('/matieres')
          .then(response => {
            this.matieres = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
     
      addnote() {
    axios.post('/notes', this.modelValue).then(response => {
     
          const noteId = response.data.id;
          this.modelValue.note_id = noteId;
          this.addExamsNote();

    })
        .catch(error => {
          console.log(error.response.data);
          this.errors = error.response.data.errors;
        });
    },

    addExamsNote(){
      
      const newNiveauScolaire = {
        date: this.modelValue.date,
        matiere_id: this.professeur.matiere.id,
        note_id:  this.modelValue.note_id ,
        // nom : 
          };
      try {
        const response =  axios.post('/notes', this.modelValue);
        // handle the response as needed
      this.addExamsNote();
      } catch (error) {
        console.error(error);
      }

    },
      showform1(){
       this.showForm=true
      }
    
    },
  };
  </script>
  
  <style>
  
  .nonee{
    display:none
  }
  .content-header {
    padding: 20px;
    background-color: #f5f5f5;
  }
  
  .user-name {
    font-size: 24px;
    font-weight: bold;
  }
  
  .group-item {
    margin-bottom: 20px;
  }
  
  .group-name {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
  }
  
  .student-table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .table-header {
    font-weight: bold;
    padding: 10px;
    text-align: left;
    background-color: #f0f0f0;
  }
  
  .student-row {
    border-bottom: 1px solid #ccc;
  }
  
  .student-name {
    padding: 10px;
  }
  
  .exam-cell,
  .prof-note {
    padding: 10px;
  }
  
  /* Add additional styles as needed */
  </style>
  
<template>
  <MainLayout>
    <div class="content-header">
      <span class="user-name">{{ user.nom_francais }}</span>
      <ul v-for="(groupe, groupeIndex) in professeur.groupes" :key="groupe.id">
        <li class="group-item">
          <div class="group-name">{{ groupe.nom }}</div>
          <table class="student-table">
            <thead>
              <tr>
                <th class="table-header">Eleve</th>
                <th class="table-header"> First Exam </th>
                <th class="table-header"> Second Exam </th>
                <th class="table-header"> Third Exam </th>
                <th class="table-header"> Prof Note </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(eleve, eleveIndex) in groupe.eleves" :key="eleve.id" class="student-row" >
                <td class="student-name">
                  {{ eleve.user.nom_francais }} {{ eleve.user.prenom_francais }}
                </td>
                <td class="exam-cell" @click="handleExamClick(groupeIndex, eleveIndex, eleve.id, 0)">
                  <!-- Display first exam here -->
                  <div v-if="isActiveForm(groupeIndex, eleveIndex, 0)">
                    <template v-if="!currentNote">
                      <!-- Display the input form when no note is saved -->
                      <form @submit.prevent="addnote" enctype="multipart/form-data" class="afficher">
                        <div class="form-group">
                          <label for="note">Note</label>
                          <input type="text" class="form-control" id="note" v-model="modelValue.valeur" required>
                        </div>
                        <div class="form-group">
                          <label for="date">Date d'exam</label>
                          <input type="date" class="form-control" id="date" v-model="modelValue.date" required>
                        </div>
                        <button class="btn btn-primary">Save</button>
                      </form>
                    </template>
                    <template v-else>
                      <!-- Display the saved note -->
                      {{ currentNote }}
                    </template>
                  </div>
                </td>
                
                
                <!-- Repeat the same structure for other exams (1, 2, 3) -->
                
                <td class="exam-cell" @click="handleExamClick(groupeIndex, eleveIndex, eleve.id, 1)">
  <!-- Display first exam here -->
  <div v-if="isActiveForm(groupeIndex, eleveIndex, 1)">
    <template v-if="!currentNote">
      <!-- Display the input form when no note is saved -->
      <form @submit.prevent="addnote" enctype="multipart/form-data" class="afficher">
        <div class="form-group">
          <label for="note">Note</label>
          <input type="text" class="form-control" id="note" v-model="modelValue.valeur" required>
        </div>
        <div class="form-group">
          <label for="date">Date d'exam</label>
          <input type="date" class="form-control" id="date" v-model="modelValue.date" required>
        </div>
        <button class="btn btn-primary">Save</button>
      </form>
    </template>
    <template v-else>
      <!-- Display the saved note -->
      {{ currentNote }}
    </template>
  </div>
</td>

<!-- Repeat the same structure for other exams (1, 2, 3) -->


<td class="exam-cell" @click="handleExamClick(groupeIndex, eleveIndex, eleve.id, 2)">
  <!-- Display first exam here -->
  <div v-if="isActiveForm(groupeIndex, eleveIndex, 2)">
    <template v-if="!currentNote">
      <!-- Display the input form when no note is saved -->
      <form @submit.prevent="addnote" enctype="multipart/form-data" class="afficher">
        <div class="form-group">
          <label for="note">Note</label>
          <input type="text" class="form-control" id="note" v-model="modelValue.valeur" required>
        </div>
        <div class="form-group">
          <label for="date">Date d'exam</label>
          <input type="date" class="form-control" id="date" v-model="modelValue.date" required>
        </div>
        <button class="btn btn-primary">Save</button>
      </form>
    </template>
    <template v-else>
      <!-- Display the saved note -->
      {{ currentNote }}
    </template>
  </div>
</td>

<!-- Repeat the same structure for other exams (1, 2, 3) -->


<td class="exam-cell" @click="handleExamClick(groupeIndex, eleveIndex, eleve.id, 3)">
  <!-- Display first exam here -->
  <div v-if="isActiveForm(groupeIndex, eleveIndex, 3)">
    <template v-if="!currentNote">
      <!-- Display the input form when no note is saved -->
      <form @submit.prevent="addnote" enctype="multipart/form-data" class="afficher">
        <div class="form-group">
          <label for="note">Note</label>
          <input type="text" class="form-control" id="note" v-model="modelValue.valeur" required>
        </div>
        <div class="form-group">
          <label for="date">Date d'exam</label>
          <input type="date" class="form-control" id="date" v-model="modelValue.date" required>
        </div>
        <button class="btn btn-primary">Save</button>
      </form>
    </template>
    <template v-else>
      <!-- Display the saved note -->
      {{ currentNote }}
    </template>
  </div>
</td>

<!-- Repeat the same structure for other exams (1, 2, 3) -->


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
import axios from 'axios';
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
      currentNote: null,
      groupes: [],
      matieres: [],
      eleves: [],
      exams: {
        matiere_id: '',
        note_id: '',
        date: '',
        
      },
      relationExamEleve:{
        eleve_id:'',
        exame_id:'',
      },
      professeur: {
        groupes: [{
          eleves: []
        }],
        matiere: ''
      },
      modelValue: {
        date: "",
        valeur: "",
        nom: "",
        exame_id:""   
        },
      activeForms: [], // Nested array to store active form indices
    };
  },

  mounted() {
    this.fetchProfesseur();
    this.fetchGroupes();
    this.fetchMatieres();
    this.fetchEleves();
  },
  methods: {
    handleExamClick(groupeIndex, eleveIndex, eleveId, examIndex) {
    this.showForm(groupeIndex, eleveIndex, examIndex);
    this.affectEleveId(eleveId);
  },
    showForm(groupeIndex, eleveIndex, examIndex) {
      if (!this.isActiveForm(groupeIndex, eleveIndex, examIndex)) {
        this.activeForms = [[groupeIndex, eleveIndex, examIndex]]; // Set the active forms for the specific group and student
      }
    },
    isActiveForm(groupeIndex, eleveIndex, examIndex) {
      return (
        this.activeForms.length > 0 &&
        this.activeForms[0][0] === groupeIndex &&
        this.activeForms[0][1] === eleveIndex &&
        this.activeForms[0][2] === examIndex
      );
    },
    fetchProfesseur() {
      axios
        .get('/professeurs/user/' + this.user.id)
        .then(response => {
          const { data } = response;
          this.professeur.groupes = data.groupes;
          this.professeur.matiere = data.matiere.id;
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
      axios.post('/notes', this.modelValue)
        .then(response => {
          const noteId = response.data.id;
          console.log(noteId)
          this.modelValue.note_id = noteId;
          console.log(this.modelValue.note_id);
          this.currentNote = response.data.valeur; 
          // this.addExamsNote();
          this.addExamsNote(this.relationExamEleve.eleve_id); //    
            })
        .catch(error => {
          console.error(error);
        });
    },
    addExamsNote(eleveId) {
  this.exams.date = this.modelValue.date;
  this.exams.matiere_id = this.professeur.matiere;
  this.exams.note_id = this.modelValue.note_id;
  const columnHeaders = ['First Exam', 'Second Exam', 'Third Exam', 'Prof Note'];
  const columnIndex = this.activeForms[0][2]; // Get the column index of the active form

  if (columnIndex < columnHeaders.length) {
    this.exams.nom = columnHeaders[columnIndex]; // Assign the corresponding column header
  } else {
    this.exams.nom = ''; // Default value if the column index is out of bounds
  }

  axios
    .post('/exams', this.exams)
    .then(response => {
      const examId = response.data;
      this.modelValue.exame_id = examId;
      this.relationExamEleve.exame_id = this.modelValue.exame_id ;
      console.log(this.modelValue.exame_id );
      console.log(this.relationExamEleve.exame_id  );
      this.showForm = false;
  
      this.affectEleveId(eleveId); // Pass the eleveId argument here
      this.addRelationExamEleve(eleveId);
    })
    .catch(error => {
      console.log(error);
    });
},

    affectEleveId(eleveId){
      this.relationExamEleve.eleve_id = eleveId;
      this.relationExamEleve.exame_id = this.modelValue.exame_id ;
      console.log(this.relationExamEleve.eleve_id)
      console.log(this.relationExamEleve.exame_id)
    },
  
    addRelationExamEleve(eleveId) {
      this.relationExamEleve.exame_id = this.modelValue.exame_id ;
  this.relationExamEleve.eleve_id = eleveId;
  // Assign the saved note data to currentNote property
      // Clear the form or reset necessary values
      this.modelValue = {
        date: "",
        valeur: "",
        nom: "",
        exame_id: ""
      };
console.log(  this.relationExamEleve.exame_id )
  axios
    .post('/relation-exam-eleve', this.relationExamEleve)
    .then(response => {
      // Handle the successful response
      this.relationExamEleve.exame_id = this.modelValue.exame_id;
    this.relationExamEleve.eleve_id = eleveId;
    console.log(this.relationExamEleve.exame_id);
    })
    .catch(error => {
      // Handle the error
    });
},


    
    
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
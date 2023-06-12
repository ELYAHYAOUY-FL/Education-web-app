<template>
  <MainLayout>
    <div class="content-header">
      <span class="user-name"> bienvenue notre professeur {{ user.nom_francais }}</span>
      <ul v-for="(groupe, groupeIndex) in professeur.groupes" :key="groupe.id">
        <li class="group-item">
          <div class="group-name"> groupe : {{ groupe.nom }}</div>
          <table class="student-table">
            <thead>
              <tr>
                <th class="table-header">Eleve</th>
                <th class="table-header">Exam 1</th>
                <th class="table-header">Exam 2</th>
                <th class="table-header">Exam 3</th>
                <th class="table-header">la note du professeur</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(eleve, eleveIndex) in groupe.eleves" :key="eleve.id" class="student-row" >
                <td class="student-name">
                  {{ eleve.user.nom_francais }} {{ eleve.user.prenom_francais }}
                </td>

                <td class="exam-cell" @click="handleExamClick(groupeIndex, eleveIndex, eleve.id, 0 , exam)">
                  <div v-if="eleve.eleve_exams.length > 0">
                        <div v-for="exam in eleve.eleve_exams" :key="exam.id">
                          <div v-if="'Exam 1' === exam.nom">
                            <!-- Display the note if the exam name is 'Prof Note' -->
                            {{ exam.note.valeur }} 
                           {{ customF(groupeIndex,eleveIndex) }}
                          </div>
                        </div>
                        </div>
                        <template v-if="first[2]==false || (first[1]!=eleveIndex || first[0]!=groupeIndex)">
                            <div v-if="isActiveForm(groupeIndex, eleveIndex, 0)">
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
                             </div>
                        </template>
                  </td>

                <td class="exam-cell" @click="handleExamClick(groupeIndex, eleveIndex, eleve.id, 1 , exam)">
                  <div v-if="eleve.eleve_exams.length > 0">
                        <div v-for="exam in eleve.eleve_exams" :key="exam.id">
                          <div v-if="'Exam 2' === exam.nom">
                            <!-- Display the note if the exam name is 'Prof Note' -->
                            {{ exam.note.valeur }} 
                           {{ customS(groupeIndex,eleveIndex) }}
                          </div>
                        </div>
                        </div>
                        <template v-if="second[2]==false || (second[1]!=eleveIndex || second[0]!=groupeIndex)">
                            <div v-if="isActiveForm(groupeIndex, eleveIndex, 1)">
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
                             </div>
                        </template>
                  </td>

                <td class="exam-cell" @click="handleExamClick(groupeIndex, eleveIndex, eleve.id, 2 , exam)">
                  <div v-if="eleve.eleve_exams.length > 0">
                        <div v-for="exam in eleve.eleve_exams" :key="exam.id">
                          <div v-if="'Exam 3' === exam.nom">
                            <!-- Display the note if the exam name is 'Prof Note' -->
                            {{ exam.note.valeur }} 
                           {{ customT(groupeIndex,eleveIndex) }}
                          </div>
                        </div>
                        </div>
                        <template v-if="third[2]==false || (third[1]!=eleveIndex || third[0]!=groupeIndex)">
                            <div v-if="isActiveForm(groupeIndex, eleveIndex, 2)">
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
                             </div>
                        </template>
                  </td>

                <td class="exam-cell" @click="handleExamClick(groupeIndex, eleveIndex, eleve.id, 3 , exam)">
                  <div v-if="eleve.eleve_exams.length > 0">
                        <div v-for="exam in eleve.eleve_exams" :key="exam.id">
                          <div v-if="'la note du professeur' === exam.nom">
                            <!-- Display the note if the exam name is 'Prof Note' -->
                            {{ exam.note.valeur }} 
                           {{ customP(groupeIndex,eleveIndex) }}
                          </div>
                        </div>
                        </div>
                        <template v-if="profNote[2]==false || (profNote[1]!=eleveIndex || profNote[0]!=groupeIndex)">
                            <div v-if="isActiveForm(groupeIndex, eleveIndex, 3)">
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
                             </div>
                        </template>
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
      first:[-1,-1,false],
      second:[-1,-1,false],
      third:[-1,-1,false],
      profNote:[-1,-1,false],
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
  },
  methods: {
    customF(groupeIndex,eleveIndex){
      this.first=[groupeIndex,eleveIndex,true];
    },
    customS(groupeIndex,eleveIndex){
      this.second=[groupeIndex,eleveIndex,true];
    },
    customT(groupeIndex,eleveIndex){
      this.third=[groupeIndex,eleveIndex,true];
    },
    customP(groupeIndex,eleveIndex){
      this.profNote=[groupeIndex,eleveIndex,true];
    },
    handleExamClick(groupeIndex, eleveIndex, eleveId, examIndex, examId) {
  this.showForm(groupeIndex, eleveIndex, examIndex);
  this.affectEleveId(eleveId);
  // this.
  this.modelValue.exame_id = examId; // Set the exam ID
},
showForm(groupeIndex, eleveIndex, examIndex, exam) {
  if (!this.isActiveForm(groupeIndex, eleveIndex, examIndex)) {
    this.activeForms = [[groupeIndex, eleveIndex, examIndex, exam]]; // Store the selected exam in activeForms
  }
},

isActiveForm(groupeIndex, eleveIndex, examIndex, exam) {
  return (
    this.activeForms.length > 0 &&
    this.activeForms[0][0] === groupeIndex &&
    this.activeForms[0][1] === eleveIndex &&
    this.activeForms[0][2] === examIndex &&
    this.activeForms[0][3] === exam // Check if the selected exam matches the active form
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
    addnote() {
      axios.post('/notes', this.modelValue)
        .then(response => {
          this.modelValue.note_id =  response.data.id;
          this.currentNote = response.data.valeur; 
          this.modelValue.exame_id = this.modelValue.exame_id; // Set the exam ID

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
  const columnHeaders = ['Exam 1', 'Exam 2', 'Exam 3', 'la note du professeur'];
  const columnIndex = this.activeForms[0][2]; // Get the column index of the active form
if (columnIndex < columnHeaders.length) {
    this.exams.nom = columnHeaders[columnIndex]; // Assign the corresponding column header
  } else {
    this.exams.nom = ''; // Default value if the column index is out of bounds
  }

  axios
    .post('/exams', this.exams)
    .then(response => {
      this.relationExamEleve.exame_id = response.data;
      this.affectEleveId(eleveId); // Pass the eleveId argument here
      this.addRelationExamEleve(eleveId);
    })
    .catch(error => {
      console.log(error);
    });
},

    affectEleveId(eleveId){
      this.relationExamEleve.eleve_id = eleveId;
    },
  
    addRelationExamEleve(eleveId) {
  axios
    .post('/relation-exam-eleve', this.relationExamEleve)
    .then(response => {
      // Handle the successful response
      this.relationExamEleve.exame_id = this.modelValue.exame_id;
      this.relationExamEleve.eleve_id = eleveId;
      console.log(this.relationExamEleve.exame_id);
      this.fetchProfesseur();

      // Find the index of the active form in the activeForms array
      const activeFormIndex = this.activeForms.findIndex(
        form => form[0] === this.activeForms[0][0] && form[1] === this.activeForms[0][1] && form[2] === this.activeForms[0][2]
      );

      // Remove the active form from the activeForms array
      if (activeFormIndex > -1) {
        this.activeForms.splice(activeFormIndex, 1);
      }

      // Check if there are any remaining active forms
      if (this.activeForms.length > 0) {
        // Set the new active form using the first form in the activeForms array
        const [groupeIndex, eleveIndex, examIndex] = this.activeForms[0];
        this.showForm(groupeIndex, eleveIndex, examIndex);
      } else {
        // Reset currentNote to null
        this.currentNote = null;
      }
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
  color:#121212;

}

.student-table {
  width: 100%;
  border-collapse: collapse;
  color:#121212;

  
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
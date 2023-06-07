<template>
    <div>
      <h2>Averages</h2>
      <table>
        <thead>
          <tr>
            <th>Student</th>
            <th v-for="subject in subjects" :key="subject.id">{{ subject.title }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in students" :key="student.id">
            <td>{{ student.name }}</td>
            <td v-for="subject in subjects" :key="subject.id">
              {{ getAverage(student.id, subject.id) }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        students: [],
        subjects: [],
        averages: {},
      };
    },
    mounted() {
      this.fetchStudents();
      this.fetchSubjects();
      this.calculateAverages();
    },
    methods: {
      fetchStudents() {
        axios.get('/eleves')
          .then(response => {
            this.students = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchSubjects() {
        axios.get('/matieres')
          .then(response => {
            this.subjects = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      calculateAverages() {
        axios.get('/averages')
          .then(response => {
            this.averages = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      getAverage(studentId, subjectId) {
        if (this.averages[studentId] && this.averages[studentId][subjectId]) {
          return this.averages[studentId][subjectId];
        }
        return 'N/A';
      },
    },
  };
  </script>
  
<template>
  <MainLayout>
    <h1 class="text-center">Liste des étudiants</h1>
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4 fade-in">
          <div class="ag-format-container" v-for="niveau_scolaire in niveau_scolaires" :key="niveau_scolaire.id">
            <div class="ag-courses_box">
              <div
                class="ag-courses_item"
                :class="{ active: niveau_scolaire === selectedLevel }"
                @click="showGroups(niveau_scolaire)"
              >
                <a href="#" class="ag-courses-item_link">
                  <div class="ag-courses-item_bg"></div>
                  <div class="ag-courses-item_title">{{ niveau_scolaire.nom }}</div>
                  <div class="ag-courses-item_date-box">{{ niveau_scolaire.description }}</div>
                </a>
              </div>
            </div>
            <div v-if="selectedLevel === niveau_scolaire">
              <div class="listgroupe">
                <ol class="gradient-list groupe-list">
                  <li v-for="groupe in selectedGroups" :key="groupe.id" >
                    <div @click="groupe.showStudents = !groupe.showStudents" class="groupe-name">{{ groupe.nom }}
                     
                    </div>
                    <div  v-if="groupe.showStudents">
                   
                    <table class="eleves-table" >
                      <thead>
                        <tr>
                          <th>Prénom</th>
                          <th>Nom</th>
                          <th>Nom Arabe</th>
                          <th>CNE</th>
                          <th>Photo</th>
                          <th>Email</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="eleve in groupe.eleves" :key="eleve.id" class="eleve">
                          <td>{{ eleve.user.prenom_francais }}</td>
                          <td>{{ eleve.user.nom_francais }}</td>
                          <td>{{ eleve.user.nom_arabe }}</td>
                          <td>{{ eleve.CNE }}</td>
                          <td>                          <img :src="'/photos/' + eleve.photo" alt="Photo" class="eleve_photo"/></td>
                          <td>{{ eleve.user.email }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>


<script>
import axios from 'axios';
import MainLayout from '../../Layouts/MainLayout.vue';

export default {
  components: { MainLayout },
  data() {
    return {
      eleves: [],
      photo: null,
      classes: [],
      niveau_scolaires: [],
      nouvellePhoto: null,
      selectedLevel: null,
      selectedGroups: [],
      selectedGroup: null,
    };
  },

  mounted() {
    this.fetchEtudiants();
    this.fetchClasses();
    this.affichera();
  },
  methods: {
    fetchClasses() {
      axios
        .get('/groupes')
        .then((response) => {
          this.classes = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    showGroups(niveau_scolaire) {
      if (this.selectedLevel === niveau_scolaire) {
        this.selectedLevel = null;
        this.selectedGroups = [];
      } else {
        this.selectedLevel = niveau_scolaire;
        this.selectedGroups = niveau_scolaire.groupes;
        this.selectedGroups.forEach((groupe) => {
          groupe.showStudents = false; // Add a new property to track student visibility
        });
      }
    },

    affichera() {
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
    fetchEtudiants() {
      axios
        .get('/eleves')
        .then((response) => {
          this.eleves = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    async deleteEleve(id) {
      try {
        const response = await axios.delete(`/api/eleves/${id}`);
        this.eleves = this.eleves.filter((eleve) => eleve.id !== id);
      } catch (error) {
        console.log(error);
      }
    },
    showStudents(groupe) {
      if (this.selectedGroup === groupe) {
        this.selectedGroup = null;
      } else {
        this.selectedGroup = groupe;
        this.fetchStudents(groupe.id);
      }
    },
    fetchStudents(groupId) {
      axios
        .get(`/groupes/${groupId}/eleves`)
        .then((response) => {
          this.selectedGroup = { ...this.selectedGroup, eleves: response.data };
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>

<style scoped>

@import url(https://fonts.googleapis.com/css?family=Montserrat:900|Raleway:400,400i,700,700i);

/*** STYLE ***/
.groupe-list{
  
}


*,
*:before,
*:after {
  box-sizing: border-box;
}
.eleves-table {
  width: 80%;
  border-collapse: collapse;
}

.eleves-table thead {
  background-color: #f5f5f5;
}

.eleves-table th,
.eleves-table td {
  padding: 10px;
  text-align: left;
  color:#121212;
  border-bottom: 1px solid #ddd;
}

.eleves-table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.eleves-table tbody tr:hover {
  background-color: #f0f0f0;
}

.eleves-table img {
  max-width: 50px;
  max-height: 50px;
  border-radius: 50%;
}

html,
body {
  margin: 0;
  padding: 0;
}

body {
  background-color: #fafafa;
  color: #1d1f20;
  font-family: 'Raleway', sans-serif;
}

main {
  display: block;
  margin: 0 auto;
  max-width: 40rem;
  padding: 1rem;
}

.listgroupe {
  margin: 1.75rem 0;
  padding-left: 1rem;
}

.listgroupe > ol.gradient-list {
  counter-reset: gradient-counter;
  list-style: none;
}

.listgroupe > ol.gradient-list > li {
  background: white;
  border-radius: 0 0.5rem 0.5rem 0.5rem;
  box-shadow: 0.25rem 0.25rem 0.6rem rgba(0, 0, 0, 0.05), 0 0.5rem 1.125rem rgba(75, 0, 0, 0.05);
  counter-increment: gradient-counter;
  margin-top: 1rem;
  min-height: 3rem;
  padding: 1rem 1rem 1rem 3rem;
  position: relative;
}

.listgroupe > ol.gradient-list > li::before,
.listgroupe > ol.gradient-list > li::after {
  background:  rgb(76, 158, 158) ;
  border-radius: 1rem 1rem 0 1rem;
  content: '';
  height: 3rem;
  left: -1rem;
  overflow: hidden;
  position: absolute;
  top: -1rem;
  width: 3rem;
}

.listgroupe > ol.gradient-list > li::before {
  align-items: flex-end;
  background-color: #fafafa;
  box-shadow: 0.25rem 0.25rem 0.6rem rgba(0, 0, 0, 0.05), 0 0.5rem 1.125rem rgba(75, 0, 0, 0.05);
  content: counter(gradient-counter);
  color: #1d1f20;
  display: flex;
  font: 900 1.5em/1 'Montserrat';
  justify-content: flex-end;
  padding: 0.125em 0.25em;
  z-index: 1;
}

.listgroupe > ol.gradient-list > li:nth-child(10n + 1)::before,
.listgroupe > ol.gradient-list > li:nth-child(10n + 2)::before,
.listgroupe > ol.gradient-list > li:nth-child(10n + 3)::before,
.listgroupe > ol.gradient-list > li:nth-child(10n + 4)::before,
.listgroupe > ol.gradient-list > li:nth-child(10n + 5)::before {
  background:  rgb(76, 158, 158) ;
}

.listgroupe > ol.gradient-list > li:nth-child(10n + 6)::before,
.listgroupe > ol.gradient-list > li:nth-child(10n + 7)::before,
.listgroupe > ol.gradient-list > li:nth-child(10n + 8)::before,
.listgroupe > ol.gradient-list > li:nth-child(10n + 9)::before,
.listgroupe > ol.gradient-list > li:nth-child(10n + 10)::before {
  background:  rgb(76, 158, 158) ;
}

.listgroupe > ol.gradient-list > li + li {
  margin-top: 2rem;
}

.listgroupe > ol.gradient-list > li .groupe-name {
  cursor: pointer;
}

.listgroupe > ol.gradient-list > li .eleves-list {
  margin-top: 1rem;
  padding-left: 1rem;
}

.listgroupe > ol.gradient-list > li .eleve {
  cursor: pointer;
}



.ag-format-container {
  width: 1142px;
  margin: 0 auto;
}

.ag-courses_box {
  display: flex;
  align-items: flex-start;
  flex-wrap: wrap;
  padding: 20px 0;
}

.ag-courses_item {
  flex-basis: calc(33.33333% - 30px);
  margin: 0 15px 30px;
  overflow: hidden;
  border-radius: 28px;
}

.ag-courses-item_link {
  display: block;
  padding: 30px 20px;
  background-color: #121212;
  overflow: hidden;
  position: relative;
}

.ag-courses-item_link:hover,
.ag-courses-item_link:hover .ag-courses-item_date {
  text-decoration: none;
  color: #fff;
}

.ag-courses-item_link:hover .ag-courses-item_bg {
  transform: scale(10);
}

.ag-courses-item_title {
  min-height: 20px;
  margin: 0 0 25px;
  overflow: hidden;
  font-weight: bold;
  font-size: 30px;
  color: #fff;
  z-index: 2;
  position: relative;
}

.ag-courses-item_date-box {
  font-size: 18px;
  color: #fff;
  z-index: 2;
  position: relative;
}

.ag-courses-item_date {
  font-weight: bold;
  color: #f9b234;
  transition: color 0.5s ease;
}

.ag-courses-item_bg {
  height: 128px;
  width: 128px;
  background-color: #4c9e9e;
  z-index: 1;
  position: absolute;
  top: -75px;
  right: -75px;
  border-radius: 50%;
  transition: all 0.5s ease;
}

.ag-courses_item.active {
  background-color: #4c9e9e;
}

@media only screen and (max-width: 979px) {
  .ag-courses_item {
    flex-basis: calc(50% - 30px);
  }
  .ag-courses-item_title {
    font-size: 24px;
  }
}

@media only screen and (max-width: 767px) {
  .ag-format-container {
    width: 96%;
  }
}

@media only screen and (max-width: 639px) {
  .ag-courses_item {
    flex-basis: 100%;
  }
  .ag-courses-item_title {
    min-height: 72px;
    line-height: 1;
    font-size: 24px;
  }
  .ag-courses-item_link {
    padding: 22px 40px;
  }
  .ag-courses-item_date-box {
    font-size: 16px;
  }
}

/* Additional Styles */
.listgroupe {
  margin-bottom: 20px;
}

.listgroupe li {
  cursor: pointer;
}

.listgroupe ul {
  margin-left: 20px;
}
</style>

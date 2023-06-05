<template>
  <MainLayout>
    <h1 class="text-center">Liste des étudiants</h1>
    <div class="container row">
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
  <div class="listgroupe" v-for="groupe in selectedGroups" :key="groupe.id">
    <ul class="ls">
      <li @click="groupe.showStudents = !groupe.showStudents">
        {{ groupe.nom }}
      </li>
      <ul v-if="groupe.showStudents">
        <li v-for="eleve in groupe.eleves" :key="eleve.id">
          {{ eleve.user.prenom_francais }} {{ eleve.user.nom_francais }}
        </li>
      </ul>
    </ul>
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
    this.selectedGroups.forEach(groupe => {
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
/* Your CSS styles here */
</style>

 
<style scoped>
.ag-format-container {
  width: 1142px;
  margin: 0 auto;
}

.ag-courses_box {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: start;
  -ms-flex-align: start;
  align-items: flex-start;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;

  padding: 20px 0;
}
.ag-courses_item {
  -ms-flex-preferred-size: calc(33.33333% - 30px);
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
  color: #FFF;
}
.ag-courses-item_link:hover .ag-courses-item_bg {
  -webkit-transform: scale(10);
  -ms-transform: scale(10);
  transform: scale(10);
}
.ag-courses-item_title {
  min-height: 20px;
  margin: 0 0 25px;

  overflow: hidden;

  font-weight: bold;
  font-size: 30px;
  color: #FFF;

  z-index: 2;
  position: relative;
}
.ag-courses-item_date-box {
  font-size: 18px;
  color: #FFF;

  z-index: 2;
  position: relative;
}
.ag-courses-item_date {
  font-weight: bold;
  color: #f9b234;

  -webkit-transition: color .5s ease;
  -o-transition: color .5s ease;
  transition: color .5s ease
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
 -webkit-transition: all .5s ease;
  -o-transition: all .5s ease;
  transition: all .5s ease;
}
.ag-courses_item.active {
  background-color: #4c9e9e;
}




@media only screen and (max-width: 979px) {
  .ag-courses_item {
    -ms-flex-preferred-size: calc(50% - 30px);
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
    -ms-flex-preferred-size: 100%;
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
</style>
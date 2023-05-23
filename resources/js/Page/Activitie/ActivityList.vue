<template>
  <MainLayout>
    <div class="activity-list">
      <h2>Liste des activités</h2>
      <ul class="list-group">
        <li v-for="activity in activities" :key="activity.id" class="list-group-item activity-item">
          <div class="d-flex align-items-center">
            <img :src="'/photos/' + activity.photo" alt="Photo" class="activity-photo mr-3">
            <div style="color: black; font-style: italic; font-size: 20px;" class="activitie">
              <h3 class="activity-title">{{ activity.nom }}</h3>
              <p class="activity-description">{{ activity.description }}</p>
              <p>Date: {{ activity.date }}</p>
              <p>Heure: {{ activity.heure }}</p>
            </div>
          </div>
          <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-danger mr-2" @click="supprimerActivity(activity.id)">Supprimer</button>
            <!-- <button class="btn btn-primary" @click="editActivity(activity)">Modifier</button> -->
          </div>
          <!-- <div v-if="activity.id === editingId">
            <h4>Modifier l'activité</h4>
            <form @submit.prevent="submitForm">
              <div>
                <label>Nom:</label>
                <input v-model="nom" name="nom" required>
              </div>
              <div>
                <label>Description:</label>
                <textarea id="description" v-model="description" required></textarea>
              </div>
              <div>
                <label>Date:</label>
                <input id="date" type="date" v-model="date" required>
              </div>
              <div>
                <label>Heure:</label>
                <input id="heure" type="time" v-model="heure" required>
              </div>
              <div>
                <label for="photo">Photo:</label>
                <input :key="inputKey" type="file" id="photo" accept="image/*" @change="onFileChange">
              </div>
              <div v-if="photo">
                <img :src="imagePreview" alt="Aperçu de l'image" id="image-preview" style="width:30%; height:30%; border-radius:15px;">
              </div>
              <button type="submit">Enregistrer</button>
            </form>
          </div> -->
        </li>
      </ul>
    </div>
  </MainLayout>
</template>

<script>
import MainLayout from '../../Layouts/MainLayout.vue';
import axios from 'axios';

export default {
  components: {
    MainLayout
  },
  data() {
    return {
      activities:[],
      editingId: null,
        nom: '',
        description: '',
        date: '',
        heure: '',
        photo: null,
    
      inputKey: Date.now(), // Clé pour réinitialiser l'élément input file
      imagePreview: ''
    };
  },
  mounted() {
    this.fetchActivities();
  },
  methods: {
    fetchActivities() {
      axios.get('/activities')
        .then(response => {
          console.log('valid');
          this.activities = response.data;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des activités:', error);
        });
    },
    // editActivity(activity) {
    //   this.nom = activity.nom;
    // this.description = activity.description;
    // this.date = activity.date;
    // this.heure = activity.heure;
    // this.photo = null; // Clear the photo field
    // this.inputKey = Date.now();
    // this.imagePreview = activity.photo;

    // // Set the editingId to the ID of the activity being edited
    // this.editingId = activity.id;
    // },

      // Pré-remplir la propriété "photo" si l'activité a une photo existante
      // if (activity.photo) {
      //   this.photo = activity.photo;
      //   this.imagePreview = '/photos/' + activity.photo;
      // } else {
      //   this.photo = null;
      //   this.imagePreview = '';
      // }
      // console.log('valid11');
    // },
    // submitForm() {
    //   const formData = new FormData();
    //   formData.append('nom', this.nom);
    //   formData.append('description', this.description);
    //   formData.append('date', this.date);
    //   formData.append('heure', this.heure);
    //   if (this.photo) {
    //     formData.append('photo', this.photo);
    //   }
    //   console.log('valid2222');
    //   console.log(formData); 
    //   axios.put(`/activities/${this.editingId}`, formData)
    // .then(response => {
    //     console.log(response.data.message);
    //     this.resetForm();
    //     this.editingId = null; 
    //     this.fetchActivities(); // Mettre à jour la liste des activités après la modification réussie
    // })
    // .catch(error => {
    //     if (error.response && error.response.data.errors) {
    //         const errors = error.response.data.errors;
    //         // Afficher les erreurs dans la console ou les traiter d'une autre manière
    //         console.log(errors);
    //     } else {
    //         console.error('Erreur lors de la modification de l\'activité:', error);
    //     }
    // });

    // },
  //   submitForm() {
  //   // Create FormData object
  //   const formData = new FormData();
  //   formData.append('nom', this.nom);
  //   formData.append('description', this.description);
  //   formData.append('date', this.date);
  //   formData.append('heure', this.heure);

  //   if (this.photo) {
  //     formData.append('photo', this.photo);
  //   }

  //   // Make a POST request to save the edited activity
  //   axios.post(`/api/activities/${this.editingId}`, formData)
  //     .then(response => {
  //       console.log('Activité modifiée avec succès:', response.data);
  //       // Reset form values and variables
  //       this.nom = '';
  //       this.description = '';
  //       this.date = '';
  //       this.heure = '';
  //       this.photo = null;
  //       this.inputKey = Date.now();
  //       this.imagePreview = '';

  //       // Reset editingId to null to exit editing mode
  //       this.editingId = null;

  //       // Fetch updated activities list
  //       this.fetchActivities();
  //     })
  //     .catch(error => {
  //       console.error('Erreur lors de la modification de l\'activité:', error);
  //     });
  // },
    onFileChange(event) {
      const file = event.target.files[0];
      this.form.photo = file;

      // Afficher l'aperçu de l'image
      const reader = new FileReader();
      reader.onload = (e) => {
        this.imagePreview = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    supprimerActivity(activityId) {
      axios.delete(`/api/activities/${activityId}`)
        .then(response => {
          console.log(response.data.message);
          this.fetchActivities(); // Mettre à jour la liste des activités après la suppression
        })
        .catch(error => {
          console.error(error);
        });
    },
    resetForm() {
      this.nom = '';
      this.description = '';
      this.date = '';
      this.heure = '';
      this.photo = null;
      this.imagePreview = '';
    }
  }
};
</script>

 
<style>
.activity-list {
  padding: 20px;
}

.activity-item {
  margin-bottom: 20px;
  border-radius: 4px;
}

.activity-title {
  color: #333;
  font-size: 18px;
  margin-bottom: 5px;
}
.activitie p {
  color: #666;
}

.activity-description {
  color: #666;
}

.activity-photo {
  width: 100px;
  height: auto;
  border-radius: 4px;
}
</style>
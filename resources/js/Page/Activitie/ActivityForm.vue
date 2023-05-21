<template>
  <MainLayout>
    <form class="activity-form" @submit.prevent="saveActivity">
      <h2>{{ isEditing ? 'Modifier' : 'Ajouter' }} une activité</h2>
      <div>
        <label>Nom :</label>
        <input type="text" v-model="nom" required>
      </div>
      <div>
        <label>Description :</label>
        <textarea v-model="description" required></textarea>
      </div>
      <div>
        <label>Date :</label>
        <input type="date" v-model="date" required>
      </div>
      <div>
        <label>Heure :</label>
        <input type="time" v-model="heure" required>
      </div>
      <div>
        <label>Photo :</label>
        <input type="file" accept="image/*" @change="handlePhotoUpload" />
      </div>
      <div>
        <img src="" alt="" id="image-preview" style="width:30%; height:30% ;border-radius:15px; display:none;" >
      </div>
      <div>
        <button type="submit">{{ isEditing ? 'Modifier' : 'Ajouter' }}</button>
        <button type="button" @click="cancelEdit" v-if="isEditing">Annuler</button>
      </div>
    </form>
  </MainLayout>
</template>

<script>
import axios from 'axios';
import MainLayout from '../../Layouts/MainLayout.vue';

export default {
  components: { MainLayout },
  props: {
    activity: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      nom: '',
      description: '',
      date: '',
      heure: '',
      photo: null,
      isEditing: false,
    };
  },
  watch: {
    activity: {
      handler(newActivity) {
        if (newActivity) {
          // Mettre à jour les propriétés du formulaire avec les valeurs de l'activité
          this.nom = newActivity.nom;
          this.description = newActivity.description;
          this.date = newActivity.date;
          this.heure = newActivity.heure;
          this.isEditing = true;
        } else {
          this.resetForm();
        }
      },
      immediate: true
    }
  },
  methods: {
    saveActivity() {
      const formData = new FormData();
      formData.append('nom', this.nom);
      formData.append('description', this.description);
      formData.append('date', this.date);
      formData.append('heure', this.heure);
      formData.append('photo', this.photo);

      if (this.isEditing) {
        axios.put(`/activities/${this.activity.id}`, formData)
          .then(response => {
            this.$emit('activity-updated');
            this.resetForm();
          })
          .catch(error => {
            console.log(error);
          });
      } else {
        axios.post('/activities', formData)
          .then(response => {
            this.$emit('activity-created');
            this.resetForm();
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    cancelEdit() {
      this.$emit('activity-updated', null);
    },
    resetForm() {
      this.nom = '';
      this.description = '';
      this.date = '';
      this.heure = '';
      this.photo = '';
      this.isEditing = false;
    },
    handlePhotoUpload(event) {
      this.photo = event.target.files[0];
      this.previewImage(event);
    },

    previewImage(event) {
      const file = event.target.files[0];
      if (!file) {
        return;
      }

      const reader = new FileReader();

      reader.onload = (event) => {
        const img = document.getElementById('image-preview');
        img.src = event.target.result;
        img.style.display = 'block';
      };

      reader.readAsDataURL(file);
    }
  }
};
</script>

<style>
/* Ajoutez le style CSS ici */
form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 5px;
}

h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

div {
  margin-bottom: 15px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"],
textarea,
input[type="date"],
input[type="time"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  padding: 8px 15px;
  background-color: #44a28f;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button[type="submit"] {
  background-color: #44a28f;
  margin-right: 10px;
}

button[type="button"] {
  background-color: #ccc;
}

button:hover {
  background-color: #3d8b77;
}

button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}
</style>

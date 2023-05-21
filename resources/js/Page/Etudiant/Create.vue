<template>
  <MainLayout>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter un étudiant</h3>
              </div>
              <div class="card-body">
                <form @submit.prevent="submitForm" id="formulaire"> 
                  <div class="form-group">
                    <label for="">Nom :</label>
                    <input required type="text" :class="{'is-invalid': form.errors.nom}" class="form-control" v-model="form.nom" />
                    <span v-if="form.errors.nom" class="invalid-feedback error">{{ form.errors.nom }}</span>
                  </div>
                  <div class="form-group">
                    <label for="">Prénom :</label>
                    <input
                      required
                      type="text"
                      :class="{'is-invalid': form.errors.prenom}"
                      class="form-control"
                      v-model="form.prenom"
                    />
                    <span v-if="form.errors.prenom" class="invalid-feedback error">{{ form.errors.prenom }}</span>
                  </div>
                  <div class="form-group">
                    <label for="">Age :</label>
                    <input
                      required
                      type="number"
                      :class="{'is-invalid': form.errors.age}"
                      class="form-control"
                      v-model="form.age"
                    />
                    <span v-if="form.errors.age" class="invalid-feedback error">{{ form.errors.age }}</span>
                  </div>
                  <div class="form-group">
                    <label for="">Date de naissance :</label>
                    <input
                      required
                      type="date"
                      :class="{'is-invalid': form.errors.date_naissance}"
                      class="form-control"
                      v-model="form.date_naissance"
                    />
                    <span v-if="form.errors.date_naissance" class="invalid-feedback error">{{ form.errors.date_naissance }}</span>
                  </div>
                  <div class="form-group">
                    <label for="">Sexe :</label>
                    <select :class="{'is-invalid': form.errors.sexe}" class="form-control" v-model="form.sexe">
                      <option value=""></option>
                      <option value="M">Masculin</option>
                     

                      <option value="F">Féminin</option>
                    </select>
                    <span v-if="form.errors.sexe" class="invalid-feedback error">{{ form.errors.sexe }}</span>
                  </div>
                  <div class="form-group">
                    <label for="">Niveau scolaire :</label>
                    <select :class="{'is-invalid': form.errors.niveau_scolaire}" class="form-control" v-model="form.niveau_scolaire">
                      <option value=""></option>
                      <option :value="niveau_scolaire.id" v-for="niveau_scolaire in niveau_scolaires" :key="niveau_scolaire.id">{{ niveau_scolaire.nom }}</option>
                    </select>
                    <span v-if="form.errors.niveau_scolaire" class="invalid-feedback error">{{ form.errors.niveau_scolaire }}</span>
                  </div>

                  <div class="d-flex justify-content-between">
                    <div class="form-group">
                      <label for="">Photo :</label>
                      <input :key="inputKey" type="file" accept="image/*" class="form-control" @input="previewImage($event, form)" />
                    </div>
                    <div>
                      <img src="" alt="" id="image-preview" style="width:35px;height:35;border-radius:15px;display:none;" />
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-success" form="formulaire">Soumettre</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
      
<script>
import MainLayout from "../../Layouts/MainLayout.vue";
import axios from 'axios';
import { useForm } from '@inertiajs/vue3';
import { defineComponent, ref } from 'vue';
import { post } from '@inertiajs/inertia';

export default defineComponent({
  components: { MainLayout },
  setup() {
    const form = useForm({
      nom: '',
      prenom: '',
      age: '',
      date_naissance: '',
      sexe: '',
      niveau_scolaire: '',
      photo: '',
      errors: {}
    });

    const inputKey = ref(0);
    const niveau_scolaires = ref([]);

    const previewImage = (event, form) => {
      const file = event.target.files[0];
      if (!file) {
        return;
      }

      const reader = new FileReader();

      reader.onload = (event) => {
        const img = document.getElementById('image-preview');
        img.src = event.target.result;
        img.style.display = 'block';

        form.photo = file;
      };

      reader.readAsDataURL(file);
    };

    const mounted = async () => {
      try {
        console.log('on mounted');
        const response = await axios.get('adminn/nivScolairListe');
        niveau_scolaires.value = response.data;
      } catch (error) {
        console.log('error', error);
      }
    };

    mounted();

    return {
      form,
      inputKey,
      previewImage,
      niveau_scolaires
    };
  },
  
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('admin/etudiantcreate', this.form);
        if (response.status === 201) {
          // Succès de l'ajout de l'étudiant
          // Réinitialiser le formulaire ou effectuer d'autres actions nécessaires
          this.form = {
            nom: '',
            prenom: '',
            age: '',
            date_naissance: '',
            sexe: '',
            niveau_scolaire: '',
            photo: '',
            errors: {}
          };
          console.log('Étudiant ajouté avec succès !');
        } else {
          // Erreur lors de l'ajout de l'étudiant
          console.log('Une erreur est survenue lors de l\'ajout de l\'étudiant');
        }
      } catch (error) {
        // Erreur lors de la requête
        console.log('Erreur lors de la requête', error);
      }
    }
  }
});
</script>
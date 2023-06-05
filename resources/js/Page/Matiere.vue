<template>
  
    <MainLayout>
       
    <h2>Matieres</h2>

    <!-- <div>
    <ul>
      <li v-for="Matiere in Matieres" :key="Matiere.id">
        {{ Matiere.titre }}
        <button @click="showDetails(Matiere.id)">Details</button>
      </li>
    </ul>
    <div v-if="selectedMatiere">
    <h3>{{ selectedMatiere.titre }}</h3>
    <h3>{{ selectedMatiere.coefficient }}</h3>
    <p>{{ selectedMatiere.description }}</p>
    <a :href="selectedMatiere.pdf_url" download="document.pdf">Télécharger le PDF</a>
</div> -->

   
  <ul>
            <li v-for="matiere in matieres" :key="matiere.id">
                <h3>{{ matiere.titre }}</h3>
                <p>{{ matiere.coefficient }}</p>
                <p>{{ matiere.description }}</p>
                 
                <!-- <div>{{ pdfContent }}</div> -->

<div>
 
  <a :href="`/matieres/${matiere.id}/download`">{{ matiere.pdf}}</a>
</div>

            </li>
        </ul>
    

  <!-- ************************   formulaire   ajoute   ************************** -->
  <div>
    <h2>Ajouter une Matière</h2>
    <form @submit.prevent="addMatiere" enctype="multipart/form-data">
      <div>
        <label for="titre">Titre</label>
        <input type="text" id="titre" v-model="matiere.titre">
      </div>
      <div>
        <label for="coefficient">Coefficient</label>
        <input type="text" id="coefficient" v-model="matiere.coefficient">
      </div>
      <div>
        <label for="description">Description</label>
        <textarea id="description" v-model="matiere.description"></textarea>
      </div>
      <div>
        <label for="pdf">Fichiers PDF</label>
        <input type="file" id="pdf" name="pdf[]" multiple @change="onFileChange">
      </div>
      <button type="submit">Enregistrer</button>
    </form>
  </div>
</MainLayout>
      </template>
      
<script>
import jsPDF from 'jspdf';
import MainLayout from "../Layouts/MainLayout.vue";
    
       export default{
        
        name: "Admin",
        components: { MainLayout },
        data() {
    return {
      // matiere: null,
      matieres: [],
        Matieres: [],
      selectedMatiere: null,
      pdfContent: '' ,
      matiere: {
        titre: '',
        coefficient: '',
        description: '',
        pdfFiles: [],
      },
    };
  },
  mounted() {
  //   this.getMatieres();
  const matiereId = this.$route.params.id;
  this.fetchMatiere(matiereId);
    

    
   },
  methods: {
    fetchMatiere(id) {
      axios.get(`/matieres/${id}`)
        .then(response => {
          this.matieres = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
//     downloadPdf(filename) {
//     const url = this.getPdfUrl(filename);
//     window.open(url, '_blank');
//   },
//   getPdfUrl(filename) {
//     if (!filename) {
//     // Si filename est null ou non défini, retourner une chaîne vide ou une valeur par défaut
//     return 'faute';
//   }
//   return `/storage/pdf/${filename}`;
// },
    getPdfURL(pdfFiles) {
  if (pdfFiles && pdfFiles.length > 0) {
    const pdfBlob = new Blob([pdfFiles[0]], { type: 'application/pdf' });
    return URL.createObjectURL(pdfBlob);
  }
  return '';
},


    // getMatieres() {
    //   // Appel à l'API pour récupérer les matières
    //   // Utilisez ici axios ou un autre moyen pour effectuer une requête GET à votre endpoint API Laravel
    //   axios.get('/matieres')
    //     .then(response => {
    //       this.Matieres = response.data;
    //     })
    //     .catch(error => {
    //       console.error(error);
    //     });
    // },
    // showDetails(MatiereId) {
    //   // Appel à l'API pour récupérer les détails d'une matière spécifique
    //   axios.get(`/matieres/${MatiereId}`)
    //     .then(response => {
    //       this.selectedMatiere = response.data;
          
    //     })
    //     .catch(error => {
    //       console.error(error);
    //     });
    // },
    addMatiere() {
      // Créer un objet FormData pour envoyer les données et les fichiers
      const formData = new FormData();
      formData.append('titre', this.matiere.titre);
      formData.append('coefficient', this.matiere.coefficient);
      formData.append('description', this.matiere.description);
      
      // Ajouter les fichiers PDF à l'objet FormData
      for (let i = 0; i < this.matiere.pdfFiles.length; i++) {
        formData.append('pdf[]', this.matiere.pdfFiles[i]);
      }

      // Envoyer la requête POST à l'API Laravel
      axios.post('/matieres', formData)
        .then(response => {
          // Traiter la réponse de l'API en cas de succès
          console.log(response.data);
          
        })
        .catch(error => {
          // Traiter les erreurs de la requête en cas d'échec
          console.error(error);
        });
    },
    onFileChange(event) {
      // Mettre à jour la liste des fichiers PDF sélectionnés
      this.matiere.pdfFiles = event.target.files;
    },
  },
 
  // mounted() {
  //       axios.get('/matieres')
  //           .then(response => {
  //               this.matieres = response.data;
  //           })
  //           .catch(error => {
  //               console.log(error);
  //           });
  //   },
};
</script>
   
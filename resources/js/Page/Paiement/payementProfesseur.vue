<template>
  <MainLayout>
    <div class="container">
      <h2 class="title">Liste des paiements</h2>
      <div class="month-selector">
        <select v-model="selectedMonth" @change="fetchPaymentDetails" >
          <option v-for="month in months" :value="month">{{ month }}</option>
        </select>
      </div>
      <div class="payment-table">
        <div class="payment-row">
          <div class="payment-cell">Nom du professeur</div>
          <div class="payment-cell">Numéro de compte</div>
          <div class="payment-cell">Type de banque</div>
          <div class="payment-cell">Montant</div>
          <div class="payment-cell">Mois</div>
          <div class="payment-cell">Date</div>
          <div class="payment-cell">Statut</div>
        </div>
        <div v-for="payment in selectedPayments" :key="payment.id" class="payment-row">
          <div class="payment-cell">{{ payment.bank_information_prof.professeur.user.prenom_francais }}</div>
          <div class="payment-cell">{{ payment.bank_information_prof.numero_compte }}</div>
          <div class="payment-cell">{{ payment.bank_information_prof.type_bank }}</div>
          <div class="payment-cell">{{ payment.montant }}</div>
          <div class="payment-cell">{{ payment.mois }}</div>
          <div class="payment-cell">{{ payment.date }}</div>
          <div class="payment-cell">
            <input type="checkbox" v-model="payment.est_paye" :disabled="isPaymentDisabled(payment)" />
            <span v-if="payment.est_paye" class="paid">Payé</span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-container">
      <h2 class="title">Formulaire de paiement</h2>
      <button @click="toggleForm">{{ showForm ? 'Cacher le formulaire' : 'Afficher le formulaire' }}</button>

<form v-if="showForm" @submit.prevent="submitPayment">
        <div class="form-row">
          <label for="parent">Nom du parent:</label>
          <select id="parent" v-model="selectedParent" >
            <option v-for="professeur in professeurs" :value="professeur.id">{{ professeur.user.nom_francais }} {{ professeur.user.prenom_francais }}</option>
          </select>
        </div>

        <div>
          <label for="montant">Montant:</label>
          <input type="number" v-model="newPayment.montant" id="montant" required>
        </div>
        <div>
          <label for="mois">Mois:</label>
          <select v-model="newPayment.mois" id="mois">
            <option v-for="month in months" :value="month">{{ month }}</option>
          </select>
        </div>
        <div>
          <label for="date">Date:</label>
          <input type="date" v-model="newPayment.date" id="date" required>
        </div>
        <!-- <div class="form-row">
          <label for="est_paye">Est payé:</label>
          <input type="checkbox" v-model="newPayment.est_paye" id="est_paye">
        </div> -->
        <div  class="flexCHEK">
  <label for="est_paye">Est payé:</label>
  <input type="radio" v-model="newPayment.est_paye" value="1" id="est_paye">
  <label for="est_paye">Oui</label>
  <input type="radio" v-model="newPayment.est_paye" value="0" id="non_paye">
  <label for="non_paye">Non</label>
</div>


        <div class="form-row">
          <button type="submit">Valider</button>
        </div>
      </form>
    </div>
  </MainLayout>
</template>

<script>
import MainLayout from "../../Layouts/MainLayout.vue";
import axios from 'axios';

export default {
  components: { MainLayout },
  data() {
    return {
      showForm: false, 
      payments: [],
      selectedMonth: '',
      months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
      professeurs: [],
      selectedParent: '',
      selectedParentDetails: {
        numero_compte: '',
        type_bank: ''
      },
      newPayment: {
        professeur_id: '',
        montant: '',
        mois: '',
        date: '',
          est_paye: 0,
      }
    };
  },
  mounted() {
    const now = new Date();
    const currentMonth = now.toLocaleString('default', { month: 'long' });
    this.selectedMonth = currentMonth;
    this.fetchPaymentDetails();
    this.fetchParents();
  },
  watch: {
  'newPayment.est_paye': function (value) {
    this.newPayment.est_paye = value; // No need to convert to 1 or 0, as the radio buttons will provide the correct value
  }
},
  computed: {
    selectedPayments() {
      return this.payments.filter(payment => payment.mois === this.selectedMonth);
    },
   
  },

  methods: {
    toggleForm() {
      this.showForm = !this.showForm; // Toggle the value of showForm
    },
    fetchPaymentDetails() {
      axios.get(`/salaire/details?month=${this.selectedMonth}`)
        .then(response => {
          this.payments = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
 
    fetchParents() {
      axios.get('/professeurs')
        .then(response => {
          this.professeurs = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
  
    
    async getBankInfoParentId(professeurId) {
  try {
    const response = await axios.get(`/professeurs/${professeurId}/bankinfo_prof`);
    const banckId= response.data;
    // console.log(banckId) 
    return banckId
    
    // Supposons que l'ID de bankinfo_parent est renvoyé dans la propriété 'id'
  } catch (error) {
    console.error(error);
    return null;
  }
},

async submitPayment() {
  try {
    if (!this.selectedParent) {
      return   console.log("hii");
    }
    else {
      console.log(this.selectedParent)
    }

    const bankInfoParentId = await this.getBankInfoParentId(this.selectedParent);
    if  (!bankInfoParentId) {
      return console.log("hi");
    }
    else {
      console.log(bankInfoParentId)
    }


    const paymentData = {
      bankinfo_prof_id: bankInfoParentId, // Modifier le nom de la propriété
      montant: this.newPayment.montant,
      mois: this.newPayment.mois,
      date: this.newPayment.date,
      est_paye: this.newPayment.est_paye
    };

    const response = await axios.post('/salaires', paymentData);

    this.newPayment = {
      montant: '',
      mois: '',
      date: '',
      est_paye: false
    };

    this.fetchPaymentDetails();
    console.log('hey');
    this.showForm = false;
    if (response.data.hasOwnProperty('error')) {
      console.error(response.data.error);
    } else {
      console.log('Paiement créé avec succès');
    }
  } catch (error) {
    console.error(error);
  }
},

// fillBankDetails() {
//     // Récupérez les détails bancaires du parent sélectionné
//     const selectedParent = this.parents.find(parent => parent.id === this.selectedParent);
//     this.newPayment.id_bankinformation = selectedParent.bankInformation.bankinformation_parent_id;
//   },

    isPaymentDisabled(payment) {
      const now = new Date();
      const paymentDate = new Date(payment.date);
      return paymentDate > now;
    },
  },
}
;
</script>

<style>
.title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}
.flexCHEK{
  display: flex;
  gap: 2%;
}
.month-selector {
  margin-bottom: 10px;
}

.payment-table {
  display: table;
  width: 100%;
  border-collapse: collapse;
}

.payment-row {
  display: table-row;
}

.payment-cell {
  display: table-cell;
  padding: 10px;
  border-bottom: 1px solid #ccc;
}

.payment-cell:first-child {
  font-weight: bold;
}

.payment-cell input[type="checkbox"] {
  cursor: pointer;
}

.payment-cell .paid {
  text-decoration: line-through;
  color: #999;
}

.form-container {
  margin-top: 30px;
}
</style>

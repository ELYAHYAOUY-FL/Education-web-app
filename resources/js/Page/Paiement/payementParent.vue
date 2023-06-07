<template>
  <MainLayout>
    <div class="container">
      <h2 class="title">Liste des paiements</h2>
      <div v-if="payments">
        <div v-for="payment in payments" :key="payment.id" class="card mb-3">
          <div class="card-body">
            <div class="payment-info">
              <div class="payment-status" :class="{ 'paid': payment.est_paye }">
                {{ payment.est_paye ? 'Payé' : 'Non payé' }}
              </div>
              <div class="payment-details">
                <p class="payment-date">{{ payment.date }}</p>
                <p class="payment-month">{{ payment.mois }}</p>
              </div>
            </div>
            <div class="payment-parent">
              <div class="payment-checkbox">
                <input type="checkbox" v-model="payment.est_paye" :disabled="payment.showDetails" />
              </div>
              <p class="parent-name">
                <span class="clickable" @click="showDetails(payment)">
                  {{ payment.bank_information_parent.parent.user.nom_arabe }}
                </span>
              </p>
            </div>
            <transition name="fade">
              <div v-if="payment.showDetails" class="payment-details-expanded">
                <div class="payment-extra-details">
                  <p class="parent-firstname">Prénom: {{ payment.bank_information_parent.parent.user.prenom_arabe }}</p>
                  <p class="parent-email">Email: {{ payment.bank_information_parent.parent.user.email }}</p>
                  <p class="payment-amount">Montant: {{ payment.montant }}</p>
                  <p class="payment-year">Année: {{ payment.anne }}</p>
                  <div class="bank-info">
                    <p class="bank-account">Numéro de compte: {{ payment.bank_information_parent.numero_compte }}</p>
                    <p class="bank-type">Type de banque: {{ payment.bank_information_parent.type_bank }}</p>
                  </div>
                </div>
              </div>
            </transition>
          </div>
        </div>
      </div>
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
      payments: [],
      parents:[],
      users:[],
    };
  },
  mounted() {
    this.fetchPaymentDetails();
    this.fetchParents();
      this.fetchUsers();
      this.fetchBankInfoParents();
  },
  methods: {
    fetchPaymentDetails() {
      axios.get('/payment/details')
        .then(response => {
          this.payments = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    showDetails(payment) {
      payment.showDetails = !payment.showDetails;
    },
    fetchBankInfoParents() {
        // Faites une requête HTTP pour obtenir la liste des parents depuis votre backend
        // Remplacez la logique de cette méthode par votre propre logique de récupération des parents
        axios.get('/payment/bank_information_parent')
          .then(response => {
            this.bank_information_parents = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchParents() {
        // Faites une requête HTTP pour obtenir la liste des parents depuis votre backend
        // Remplacez la logique de cette méthode par votre propre logique de récupération des parents
        axios.get('/payment/parent')
          .then(response => {
            this.parents = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      fetchUsers() {
        // Faites une requête HTTP pour obtenir la liste des parents depuis votre backend
        // Remplacez la logique de cette méthode par votre propre logique de récupération des parents
        axios.get('/payment/user')
          .then(response => {
            this.users = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
  },
};
</script>

<style>
.title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.card {
  background-color: #9ea7a6;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  width: 70%;
}

.card-body {
  padding: 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.payment-info {
  display: flex;
  align-items: center;
}

.payment-status {
  font-weight: bold;
  text-transform: uppercase;
  padding: 6px 12px;
  border-radius: 4px;
  color: #c7c3c3;
}

.paid {
  background-color: #19726e;
}

.payment-details {
  flex: 1;
  padding-left: 10px;
}

.payment-date,
.payment-month {
  margin: 0;
  color: #333;
}

.payment-checkbox {
  margin-left: 5px;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.payment-details-expanded {
  margin-top: 10px;
}

.parent-name {
  font-weight: bold;
  cursor: pointer;
  margin-bottom: 5px;
  color: #333;
  text-decoration: underline;
}

.payment-extra-details {
  margin-top: 10px;
}

.parent-firstname,
.parent-email,
.payment-amount,
.payment-year,
.bank-info {
  margin-bottom: 5px;
  color: #575656;
}

.bank-info {
  margin-top: 10px;
}

.bank-account,
.bank-type {
  margin-bottom: 5px;
  font-size: 14px;
  color: #555;
}

.clickable {
  cursor: pointer;
  text-decoration: underline;
}
</style>

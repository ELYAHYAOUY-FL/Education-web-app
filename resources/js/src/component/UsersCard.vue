<template>
  <div class="card-carousel-wrapper">
    <div class="card-carousel-cards">
      <div class="card-carousel--card" v-for="item in items" :key="item.name">
        <router-link :to="item.url" class="flexCardsImage">
          <img :src="item.image" />
          <div class="card-carousel--card--footer">
            <p class="para">{{ item.name }}</p>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import studentImag from '../assest/images/student1.png'
import parentImg from '../assest/images/parent1.png'
import profImg from '../assest/images/professeur1.png'
import administrationImg from '../assest/images/administration1.png'

export default {
  data() {
    return {
      name: "CardUser",
      items: [
        { name: 'espace eleve', url: '/Student', image: studentImag },
        { name: 'espace parent', url: '/parent', image: parentImg },
        { name: 'espace ensegnent', url: '/professeur', image: profImg },
        { name: 'espace administration', url: '/Administration', image: administrationImg },
      ],
    }
  },
}
</script>

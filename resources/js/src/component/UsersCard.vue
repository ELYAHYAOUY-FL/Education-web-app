<template>
  <div class="card-carousel-wrapper">
    <div class="card-carousel-cards">
      <div class="card-carousel--card" v-for="item in items" :key="item.name">
        <router-link :to="item.url">
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
import studentImag from '../assest/images/student.png'
import parentImg from '../assest/images/student.png'
import profImg from '../assest/images/professeur.jpg'
import administrationImg from '../assest/images/administration.png'

export default {
  data() {
    return {
      name: "CardUser",
      items: [
        { name: 'espaces eleve', url: '/Student', image: studentImag },
        { name: 'parent', url: '/parent', image: parentImg },
        { name: 'ensegnent', url: '/professeur', image: profImg },
        { name: 'administration', url: '/Administration', image: administrationImg },
      ],
    }
  },
}
</script>

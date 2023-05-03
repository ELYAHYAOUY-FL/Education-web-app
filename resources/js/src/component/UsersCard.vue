<template>
    <div class="card-carousel-wrapper">
      <div class="card-carousel--nav__left" @click="moveCarousel(-1)" :disabled="atHeadOfList"></div>
      <div class="card-carousel">
        <div class="card-carousel--overflow-container">
          <div class="card-carousel-cards" :style="{ transform: 'translateX(' + currentOffset + 'px)' }">
            <div class="card-carousel--card" v-for="item in items" :key="item.name">
               <a  :href="item.url">
              <img :src="item.image" />
              <div class="card-carousel--card--footer">
                <p class="para">{{ item.name }}</p> 
                <!-- <div class="tag" v-for="(tag, index) in item.tag" :key="index" :class="{ 'secondary': index > 0 }">{{ tag }}</div> -->
               </div> 
           </a> 
            </div>
          </div>
        </div>
      </div>
      <div class="card-carousel--nav__right" @click="moveCarousel(1)" :disabled="atEndOfList"></div>
    </div> 
  </template>
  
  <script>
  import studentImag from '../assest/images/student.png'
  import parentImg  from '../assest/images/student.png'
  import profImg from '../assest/images/professeur.jpg'
  import administrationImg from '../assest/images/administration.png'

  import AdministrationPage from '../pages/AdministrationPage.vue'
  import studentPage from '../pages/ElevePage.vue'
  import professeurPage from '../pages/ParentsPage.vue'
  import parentPage from '../pages/ProfesserPage.vue'

  

const routes = {
  '/Administration': AdministrationPage,
  '/Student':studentPage ,
  '/professeur':  professeurPage,
  '/parent':  parentPage
}


  export default {
    data() {
      return {
        currentPath: window.location.hash,
        

        name : "CardUser",
        currentOffset: 0,
        windowSize:3,
        paginationFactor: 220,
        items: [
          { name: 'espaces eleve',
          url:'/Student',
          image: studentImag
           },
          { name: 'parent',
          url:'/parent',
           image: parentImg
            },
          { name: 'ensegnent ',
          url:'/professeur',
           image: profImg
            },
          { name: 'administration ',
          url:'/Administration',
           image: administrationImg
           },
         
      
        ]
      }
    }, 
    computed: {
      atEndOfList() {
        return this.currentOffset <= (this.paginationFactor * -1) * (this.items.length - this.windowSize)
      },
      
      atHeadOfList() {
        return this.currentOffset === 0
      },
      currentView() {
      return routes[this.currentPath.slice(1) || '/'] || NotFound
    }
    },
    methods: {
      moveCarousel(direction) {
        if (direction === 1 && !this.atEndOfList) {
          this.currentOffset -= this.paginationFactor
        } else if (direction === -1 && !this.atHeadOfList) {
          this.currentOffset += this.paginationFactor
        }
      }
    },
     currentView() {
      return routes[this.currentPath.slice(1) || '/'] || NotFound
    }

  }
  </script>
  
  <style scoped>
  /* Add your custom styles here */
  </style>
  
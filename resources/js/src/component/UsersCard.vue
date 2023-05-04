<template>
    <div class="card-carousel-wrapper">
      <div class="card-carousel--nav__left" @click="moveCarousel(-1)" :disabled="atHeadOfList"></div>
      <div class="card-carousel">
        <div class="card-carousel--overflow-container">
          <div class="card-carousel-cards" :style="{ transform: 'translateX(' + currentOffset + 'px)' }">
            <div class="card-carousel--card" v-for="item in items" :key="item.name">
               <router-link :to="item.url">
              <img :src="item.image" />
              <div class="card-carousel--card--footer">
                <p class="para">{{ item.name }}</p> 
                <!-- <div class="tag" v-for="(tag, index) in item.tag" :key="index" :class="{ 'secondary': index > 0 }">{{ tag }}</div> -->
               </div> 
           </router-link> 
           
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




  export default {
    data() {
      return {
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
    

  }
  </script>

  
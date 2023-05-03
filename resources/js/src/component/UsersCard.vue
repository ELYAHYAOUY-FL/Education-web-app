<template>
    <div class="card-carousel-wrapper">
      <div class="card-carousel--nav__left" @click="moveCarousel(-1)" :disabled="atHeadOfList"></div>
      <div class="card-carousel">
        <div class="card-carousel--overflow-container">
          <div class="card-carousel-cards" :style="{ transform: 'translateX(' + currentOffset + 'px)' }">
            <div class="card-carousel--card" v-for="item in items" :key="item.name">
              <img :src="item.image" />
              <div class="card-carousel--card--footer">
                <p>{{ item.name }}</p>
                <!-- <div class="tag" v-for="(tag, index) in item.tag" :key="index" :class="{ 'secondary': index > 0 }">{{ tag }}</div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-carousel--nav__right" @click="moveCarousel(1)" :disabled="atEndOfList"></div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name : "CardUser",
        currentOffset: 0,
        windowSize: 2,
        paginationFactor: 220,
        items: [
          { name: 'espaces eleve',
          image: '../assest/images/student.png'
           },
          { name: 'parent',
           image: '../assest/images/student.png'
            },
          { name: 'ensegnent ',
           image: '../assest/images/student.png'
            },
          { name: 'administration ',
           image: '../assest/images/student.png' 
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
    }
  }
  </script>
  
  <style scoped>
  /* Add your custom styles here */
  </style>
  
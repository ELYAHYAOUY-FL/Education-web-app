
  import { prefixUrl } from './index'
  import axios from 'axios'
export default {
  // login and setup user state
  login({ commit }, payload) {
    console.log(payload)
    return new Promise((resolve, reject) => {
      axios.post(`${prefixUrl}login`, {
        email: payload.email,
        password: payload.password,
      }).then(({ data }) => {
        if (data.status) {
          commit('setUserData', data.user)
          resolve({ status: true })
        }
        reject({ message: 'Check your credentials and try again' })
      }).catch(error => {
        reject({ message: error.message })
      })
    })
  },
  // logout
  logout({ commit }) {
    return new Promise(resolve => {
      axios.post(`${prefixUrl}logout`)
        .catch(() => {

        })
        .finally(() => {
          commit('clearUserData')
          resolve()
        })
    })
  },
  // clear user data
  clear({ commit }) {
    return new Promise(resolve => {
      commit('clearUserData')
      resolve()
    })
  },
  // user info
  user({ commit }) {
    return new Promise((resolve, reject) => {
      this.$http.get(`${prefixUrl}user`).then(({ data }) => {
        commit('setUserData', data)
        resolve()
      }).catch(() => {
        reject()
      })
    })
  },
}
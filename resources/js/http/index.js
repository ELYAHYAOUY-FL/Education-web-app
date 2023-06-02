import axios from 'axios'
import store from '@/store'

axios.defaults.baseURL = '/api' // default base api url
axios.defaults.withCredentials = true

axios.interceptors.request.use(config => config)

axios.interceptors.response.use(
  response => response,
  error => {
    if (error.response.status === 419) {
      window.location = '/login'
    }
    if (error.response.status === 401) {
      store.dispatch('auth/clear')
      window.location = '/login'
      return Promise.reject({ response: { data: { error: 'Unauthorised' } } })
    }
    if (error.response.status === 402) {
      return Promise.reject({ response: { data: { error: error.response.data } } })
    }
    if (error.response.status === 429) {
      return Promise.reject({ response: { data: { error: 'Slow down, to many requests' } } })
    }
    return Promise.reject(error)
  },
)

export default axios
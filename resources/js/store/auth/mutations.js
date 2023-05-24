export default {
    // set user data
    setUserData(state, payload) {
      state.user = payload
      localStorage.setItem('user', JSON.stringify(payload))
    },
    // remove user data
    clearUserData(state) {
      state.user = null
      localStorage.removeItem('user')
    },
  }
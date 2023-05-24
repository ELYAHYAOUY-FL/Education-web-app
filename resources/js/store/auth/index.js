import state from './state'
import mutations from './mutations'
import actions from './actions'
import getters from './getters'

const prefixUrl = '/api/v1/auth/'

export { prefixUrl }
export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters,
}
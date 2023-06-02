export default {
    isLogged: state => !!state.user,
    user: state => state.user,
    user_type: state=>state.user?.user_type,
  }
import { createStore } from 'vuex';
import { createApp } from 'vue';
import axios from '@/http';

// Modules
import auth from './auth';

const store = createStore({
  modules: {
    auth,
  },
  strict: import.meta.env.DEV,
});

export function setupStore(app) {
  app.config.globalProperties.$http = axios;
  app.use(store);
}

export default store;
import './bootstrap';

import App from "./src/App.vue";
import router from "./router.js";
 
//import { createApp } from "vue";
// import routerAdmin from "./routerAdmin";
// import { RouteLocationNormalizedLoaded } from 'vue-router';
import { createApp, h } from 'vue';


import { setupStore } from './store';

const app = createApp(App);
app.use(router);

setupStore(app);

app.mount('#app');
  


import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
render: () =>
        h(InertiaApp, {
           
            resolveComponent: (name) => {
                let parts = name.split('::')
                let type = false
                if (parts.length > 1) type = parts[0]
                if(type) {
                    let nameVue = parts[1].split('.')[0]
                    return require("../../Modules/" + parts[0] + "/Resources/js/Pages/" + nameVue + ".vue").default
                }else {
                    return require(`./Pages/${name}`).default
                }
            },
        })
 


 
// createInertiaApp({
  
//   resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')).defa,
//   setup({ el, App, props, plugin }) {
//     return createApp({ render: () => h(App, props) })
//       .use(plugin)
//       .mount(el)
//   },
// });
// const app = document.getElementById('app');

// new Vue({
//     render: (h) =>
//         h(InertiaApp, {
//             props: {
//                 initialPage: JSON.parse(app.dataset.page),
//                 resolveComponent: (name) => require(`./Pages/${name}`).default,
//             },
//         }),
// }).$mount(app);
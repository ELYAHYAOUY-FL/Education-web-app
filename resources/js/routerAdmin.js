import { createWebHistory , createRouter} from "vue-router";

import EtudiantListAdmin from './Page/NiveauScolaire/index.vue'

const routes =[ 

{
    path : '/StudentPageadmin',
   name :'ElevePageadmin',
   component : EtudiantListAdmin
}
];

const router  =createRouter({
    history : createWebHistory(),
    routes
});

export default router;


import {route} from 'quasar/wrappers'
import routes from './routes'
import {createMemoryHistory, createRouter, createWebHashHistory, createWebHistory} from 'vue-router';

/*
 * If not building with SSR mode, you can
 * directly export the Router instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Router instance.
 */
export default route(function ({store, ssrContext}) {
  const createHistory = process.env.SERVER
    ? createMemoryHistory
    : (process.env.VUE_ROUTER_MODE === 'history' ? createWebHistory : createWebHashHistory);

  const router = createRouter({
    scrollBehavior: (to, from, savedPosition) => {
      if (to.hash) {
        return {
          el: to.hash,
          behavior: 'smooth',
        }
      } else {
        return {x: 0, y: 0}
      }
    },

    routes,

    // Leave this as is and make changes in quasar.conf.js instead!
    // quasar.conf.js -> build -> vueRouterMode
    // quasar.conf.js -> build -> publicPath
    history: createHistory(process.env.MODE === 'ssr' ? void 0 : process.env.VUE_ROUTER_BASE)
  });

  router.beforeEach((to, from) => {
     to.meta.isAuthorized = store.getters['auth/isAuthorized'];
  });

  return router;
});

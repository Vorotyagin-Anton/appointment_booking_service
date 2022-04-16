import {store} from 'quasar/wrappers'
import {createStore} from 'vuex'

import masters from "./modules/masters";
import master from "./modules/master";
import services from "src/store/modules/services";
import order from "src/store/modules/order";
import navigation from "src/store/modules/navigation";
import authAlert from "src/store/modules/auth/alert";
/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */

export default store(function (/* { ssrContext } */) {
  return createStore({
    modules: {
      masters,
      master,
      services,
      order,
      navigation,
      authAlert,
    },

    // enable strict mode (adds overhead!)
    // for dev mode and --debug builds only
    strict: process.env.DEBUGGING
  })
})

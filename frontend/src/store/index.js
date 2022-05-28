import {store} from 'quasar/wrappers'
import {createStore} from 'vuex'

import alert from "src/store/modules/alert";
import auth from "src/store/modules/auth";
import masters from "src/store/modules/masters";
import master from "src/store/modules/master";
import services from "src/store/modules/services";
import order from "src/store/modules/order";
import navigation from "src/store/modules/navigation";
import breadcrumbs from "src/store/modules/breadcrumbs";
import categories from "src/store/modules/categories";
import schedule from "src/store/modules/schedule"

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
      alert,
      auth,
      masters,
      master,
      services,
      order,
      navigation,
      breadcrumbs,
      categories,
      schedule,
    },

    // enable strict mode (adds overhead!)
    // for dev mode and --debug builds only
    strict: process.env.DEBUGGING
  })
})

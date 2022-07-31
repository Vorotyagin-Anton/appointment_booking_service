import {boot} from "quasar/wrappers";
import logger from "src/logger";

export default boot(({app}) => {
  app.config.errorHandler = logger;
});

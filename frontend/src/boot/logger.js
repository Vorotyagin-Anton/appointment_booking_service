import {boot} from "quasar/wrappers";
import {api} from "boot/api";

export default boot(({app}) => {
  app.config.errorHandler = (error) => {
    if (process.env.DEV) {
      console.error(error);
      return;
    }

    const stack = error.stack.split("\n").map(i => i.trim());
    stack.shift();

    api.log.send(error.message, stack);
  };
});

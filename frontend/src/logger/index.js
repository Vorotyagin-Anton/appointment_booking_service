import {api} from "boot/api";

export default function logger(error) {
  if (process.env.DEV) {
    throw error;
  }

  const stack = error.stack.split("\n").map(i => i.trim());
  stack.shift();

  api.log.send(error.message, stack);
};

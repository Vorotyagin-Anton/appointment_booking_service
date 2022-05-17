export default function logger(error) {
  if (process.env.DEV) {
    console.dir(error);
  }
};

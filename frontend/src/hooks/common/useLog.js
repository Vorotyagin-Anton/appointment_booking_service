export default function useLog() {
  return (message) => {
    console.dir(message);
  };
}

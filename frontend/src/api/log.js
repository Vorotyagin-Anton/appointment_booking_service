export default function (axios) {
  return  {
    async send(message, context) {
      return await axios.post('/api/telegram-log', {
        message,
        context,
      });
    },
  };
}

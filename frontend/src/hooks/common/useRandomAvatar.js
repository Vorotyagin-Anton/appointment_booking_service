export default function useRandomAvatar() {
  const URL = 'https://i.pravatar.cc/700';

  const generateUuid = () => Math.floor(Math.random() * 70) + 1;

  const generateSourceUrl = () => URL + '?img=' + generateUuid();

  return {
    generateSourceUrl,
  }
}

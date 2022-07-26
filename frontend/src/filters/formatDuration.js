import {SERVICE_DURATION} from "src/constants";

export default function formatDuration(value) {
  const duration = parseInt(value) * SERVICE_DURATION;

  if (duration < 60) {
    return `${duration} min`;
  }

  const hours = Math.trunc(duration / 60);
  const minutes = duration % 60;
  return hours + 'h. ' + minutes + 'm.';
}

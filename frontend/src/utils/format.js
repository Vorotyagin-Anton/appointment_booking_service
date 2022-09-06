import moment from "moment/moment";

export function formatSlotTime(date, minutes) {
  return moment(date).add(minutes, 'minutes').format("YYYY-MM-DD HH:mm");
}

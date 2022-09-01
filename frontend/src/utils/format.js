import moment from "moment/moment";

export function formatSlotTime(date, minutes) {
  return moment(date).add(minutes, 'minutes').format("HH:mm DD-MM-YYYY");
}

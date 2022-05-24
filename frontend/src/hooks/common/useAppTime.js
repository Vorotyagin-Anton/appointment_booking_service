import {computed, ref} from 'vue';

export default function useAppTime() {
  const createdYear = 2022;
  const currentYear = ref((new Date).getFullYear());

  setInterval(() => {
    currentYear.value = (new Date).getFullYear();
  }, 1000 * 3600);

  const currentDate = computed(() => createdYear !== currentYear.value
    ? `${createdYear} - ${currentYear.value}`
    : createdYear
  );

  const timezone = ref(null);

  return {
    timezone,
    timezoneMap,
    currentDate,
  }
}

const timezoneMap = [
  {value: 1, label: "Pacific/Majuro (UTC-12:00)"},
  {value: 2, label: "Pacific/Marquesas (UTC-09:30)"},
  {value: 3, label: "America/Caracas (UTC-04:30)"},
  {value: 4, label: "America/Halifax (UTC-04:00)"},
  {value: 5, label: "America/Puerto Rico (UTC-04:00)"},
  {value: 6, label: "America/St Johns (UTC-03:30)"},
  {value: 7, label: "America/Buenos Aires (UTC-03:00)"},
  {value: 8, label: "America/Noronha (UTC-02:00)"},
  {value: 9, label: "Atlantic/Cape Verde (UTC-01:00)"},
  {value: 10, label: "Europe/London (UTC+00:00)"},
  {value: 11, label: "Europe/Berlin (UTC+01:00)"},
  {value: 12, label: "Asia/Beirut (UTC+02:00)"},
  {value: 13, label: "Europe/Moscow (UTC+03:00)"},
  {value: 14, label: "Asia/Tehran (UTC+03:30)"},
  {value: 15, label: "Asia/Dubai (UTC+04:00)"},
  {value: 16, label: "Asia/Kabul (UTC+04:30)"},
  {value: 17, label: "Asia/Karachi (UTC+05:00)"},
  {value: 18, label: "Asia/Kolkata (UTC+05:30)"},
  {value: 19, label: "Asia/Kathmandu (UTC+05:45)"},
  {value: 20, label: "Asia/Omsk (UTC+06:00)"},
  {value: 21, label: "Asia/Rangoon (UTC+06:30)"},
  {value: 22, label: "Asia/Jakarta (UTC+07:00)"},
  {value: 23, label: "Asia/Irkutsk (UTC+08:00)"},
  {value: 24, label: "Australia/Eucla (UTC+08:45)"},
  {value: 25, label: "Asia/Tokyo (UTC+09:00)"},
  {value: 26, label: "Australia/Darwin (UTC+09:30)"},
  {value: 27, label: "Australia/Brisbane (UTC+10:00)"},
  {value: 28, label: "Australia/Lord Howe (UTC+10:30)"},
  {value: 29, label: "Pacific/Noumea (UTC+11:00)"},
  {value: 30, label: "Pacific/Norfolk (UTC+11:30)"},
  {value: 31, label: "Pacific/Auckland (UTC+12:00)"},
  {value: 32, label: "Pacific/Chatham (UTC+12:45)"},
  {value: 33, label: "Pacific/Apia (UTC+13:00)"},
  {value: 34, label: "Pacific/Kiritimati (UTC+14:00)"},
];



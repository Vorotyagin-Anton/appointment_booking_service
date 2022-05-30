export default function (axios) {
  return {
    async getByUserId(id) {
      return Promise.resolve(schedule);
    },

    async updateSchedule(userId, payload) {
      const response = await axios.patch(`/api/users/workers/${userId}/worker-available-time`, payload);

      return JSON.parse(response.data);
    }
  };
}

const schedule = [
  {
    exact_date: '2022/05/25',
    slots: [
      {id: 1, exact_time_in_minutes: 540},
      {id: 2, exact_time_in_minutes: 600},
      {id: 3, exact_time_in_minutes: 660},
      {id: 4, exact_time_in_minutes: 720},
      {id: 5, exact_time_in_minutes: 780},
      {id: 6, exact_time_in_minutes: 840},
      {id: 7, exact_time_in_minutes: 900},
      {id: 8, exact_time_in_minutes: 960},
    ],
  },
  {
    exact_date: '2022/05/26',
    slots: [
      {id: 9, exact_time_in_minutes: 540},
      {id: 10, exact_time_in_minutes: 600},
      {id: 11, exact_time_in_minutes: 660},
      {id: 12, exact_time_in_minutes: 900},
      {id: 13, exact_time_in_minutes: 960},
    ],
  },
  {
    exact_date: '2022/05/29',
    slots: [
      {id: 14, exact_time_in_minutes: 780},
      {id: 15, exact_time_in_minutes: 840},
      {id: 16, exact_time_in_minutes: 960},
    ],
  },
];

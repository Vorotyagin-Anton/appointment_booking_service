const master = {
  name: 'John',
  surname: 'Doe',
  rating: {
    max: 5,
    score: 4.2,
    voices: 551,
  },
  image: 'https://i.pravatar.cc/700',
  speciality: 'General Practitioner MRCGP MRCOG',
  info: 'Dr Baker began her training ai Middlesex Hospital, choosing to specialise in Obstetrics and Gynecology before moving over to primary care.',
  services: ['Physiotherapy', 'Massage', 'Therapeutic exercise', 'Laboratory tests: clinical, biochemical, hematologic, immunological'],
  career: [
    {
      dates: [2012, 2018],
      speciality: 'Head Physician',
      place: 'Medical Center \"Ultima Ratio\"',
    },
    {
      dates: [2007, 2012],
      speciality: 'Surgeon',
      place: 'City Health Center',
    },
  ],
  reviews: [
    {
      id: 1,
      user: {
        name: 'Mick',
        surname: 'Jagger',
        image: 'https://i.pravatar.cc/700',
      },
      max: 5,
      score: 5,
      text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, nesciunt.',
      date: '2021-11-13',
    },
    {
      id: 2,
      user: {
        name: 'Alan',
        surname: 'Smith',
        image: 'https://i.pravatar.cc/700',
      },
      max: 5,
      score: 3,
      text: 'Lorem ipsum dolor.',
      date: '2022-01-27',
    },
    {
      id: 3,
      user: {
        name: 'Jane',
        surname: 'Foster',
        image: 'https://i.pravatar.cc/700',
      },
      max: 5,
      score: 4,
      text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusamus adipisci architecto asperiores assumenda atque debitis distinctio in modi obcaecati quaerat, quam quas quisquam repellendus suscipit vel?',
      date: '2022-01-29',
    },
  ],
};

export default function (axios) {
  return {
    async get(options) {
      const response = await axios.get('/api/users/workers', {params: options});
      return JSON.parse(response.data);
    },

    getById(id) {
      return new Promise((resolve) => {
        setTimeout(() => resolve(master), 500);
      });
    },

    getByName(name) {
      return new Promise((resolve) => {
        setTimeout(() => resolve({
          items: [master],
          totalPages: 1,
          currentPage: 1,
        }), 500);
      });
    },
  };
}

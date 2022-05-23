// const master = {
//   name: 'John',
//   surname: 'Doe',
//   rating: {
//     max: 5,
//     score: 4.2,
//     voices: 551,
//   },
//   image: 'https://i.pravatar.cc/700',
//   speciality: 'General Practitioner MRCGP MRCOG',
//   info: 'Dr Baker began her training ai Middlesex Hospital, choosing to specialise in Obstetrics and Gynecology before moving over to primary care.',
//   services: ['Physiotherapy', 'Massage', 'Therapeutic exercise', 'Laboratory tests: clinical, biochemical, hematologic, immunological'],
//   career: [
//     {
//       dates: [2012, 2018],
//       speciality: 'Head Physician',
//       place: 'Medical Center \"Ultima Ratio\"',
//     },
//     {
//       dates: [2007, 2012],
//       speciality: 'Surgeon',
//       place: 'City Health Center',
//     },
//   ],
//   reviews: [
//     {
//       id: 1,
//       user: {
//         name: 'Mick',
//         surname: 'Jagger',
//         image: 'https://i.pravatar.cc/700',
//       },
//       max: 5,
//       score: 5,
//       text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, nesciunt.',
//       date: '2021-11-13',
//     },
//     {
//       id: 2,
//       user: {
//         name: 'Alan',
//         surname: 'Smith',
//         image: 'https://i.pravatar.cc/700',
//       },
//       max: 5,
//       score: 3,
//       text: 'Lorem ipsum dolor.',
//       date: '2022-01-27',
//     },
//     {
//       id: 3,
//       user: {
//         name: 'Jane',
//         surname: 'Foster',
//         image: 'https://i.pravatar.cc/700',
//       },
//       max: 5,
//       score: 4,
//       text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusamus adipisci architecto asperiores assumenda atque debitis distinctio in modi obcaecati quaerat, quam quas quisquam repellendus suscipit vel?',
//       date: '2022-01-29',
//     },
//   ],
// };

// const master = {
//   id: 52,
//   name: "Presley",
//   surname: 'Doe',
//   middlename: "Pat",
//   pathToPhoto: "/uploads/photo/fake_image/041.jpeg",
//   story: "Dr Baker began her training ai Middlesex Hospital, choosing to specialise in Obstetrics and Gynecology before moving over to primary care.",
//   mobilePhoneNumber: null,
//   email: "lind.bella@gmail.com",
//   isClient: false,
//   isWorker: true,
//   services: [{id: 53, name: "Port Myrtiechester", pathToPhoto: "/uploads/photo/dummy.jpg"}],
//   rating: { //изменить
//     score: 4,
//     voices: 551,
//   },
//   career: [ //нет
//     {
//       id: 1,
//       yearFrom: 2012,
//       yearTo: 2018,
//       speciality: 'Head Physician',
//       place: 'Medical Center \"Ultima Ratio\"',
//     },
//   ],
//   categories: [{id: 1, name: 'category 1', pathToPhoto: "/uploads/photo/dummy.jpg"}], //нет
//   reviews: [ //нет
//     {
//       id: 1,
//       user: {
//         id: 1,
//         name: 'Mick',
//         surname: 'Jagger',
//         pathToPhoto: 'https://i.pravatar.cc/700',
//       },
//       score: 5,
//       text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, nesciunt.',
//       date: '2021-11-13',
//     },
//   ],
// };

export default function (axios) {
  return {
    async get(options) {
      const response = await axios.get('/api/users/workers', {params: options});
      return JSON.parse(response.data);
    },

    async getById(id) {
      const response = await axios.get(`/api/users/workers/${id}`);
      const masterData = JSON.parse(response.data.worker);
      masterData.workerFreeTime = JSON.parse(response.data.workerFreeTime);
      //console.log('master', master);
      //console.log('masterData', masterData);

      return masterData;
      //return {...master, ...masterData}; // todo костыль
    },

    getByName(name) {
      return new Promise((resolve) => {
        setTimeout(() => resolve({
          items: [],
          totalPages: 1,
          currentPage: 1,
        }), 500);
      });
    },
  };
}

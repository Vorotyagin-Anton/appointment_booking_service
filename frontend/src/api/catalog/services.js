const services = [
  {
    id: 1,
    name: 'Demo Service 01',
    content: 'Lorem ipsum dolor sit amet'
  },
  {
    id: 2,
    name: 'Demo Service 02',
    content: 'Lorem ipsum dolor sit amet'
  },
  {
    id: 3,
    name: 'Demo Service 03',
    content: 'Lorem ipsum dolor sit amet'
  },
  {
    id: 4,
    name: 'Demo Service 04',
    content: 'Lorem ipsum dolor sit amet'
  },
  {
    id: 5,
    name: 'Demo Service 05',
    content: 'Lorem ipsum dolor sit amet'
  },
  {
    id: 6,
    name: 'Demo Service 06',
    content: 'Lorem ipsum dolor sit amet'
  },
];

export default function (axios) {
  return  {
    get() {
      return new Promise((resolve) => setTimeout(() => resolve(services), 1000));
    },
  };
}

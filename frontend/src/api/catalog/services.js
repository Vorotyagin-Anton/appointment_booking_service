const services = [
  {
    id: 1,
    title: 'Demo Service 01',
    content: 'Lorem ipsum dolor sit amet'
  },
  {
    id: 2,
    title: 'Demo Service 02',
    content: 'Lorem ipsum dolor sit amet'
  },
  {
    id: 3,
    title: 'Demo Service 03',
    content: 'Lorem ipsum dolor sit amet'
  },
  {
    id: 4,
    title: 'Demo Service 04',
    content: 'Lorem ipsum dolor sit amet'
  },
  {
    id: 5,
    title: 'Demo Service 05',
    content: 'Lorem ipsum dolor sit amet'
  },
  {
    id: 6,
    title: 'Demo Service 06',
    content: 'Lorem ipsum dolor sit amet'
  },
];

export default function (axios) {
  return  {
    get() {
      return new Promise((resolve) => setTimeout(() => resolve(services), 1500));
    },
  };
}

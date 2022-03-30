const masters = [
  {
    id: 1,
    name: 'Demo Masters 01',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at expedita hic provident temporibus tenetur?'
  },
  {
    id: 2,
    name: 'Demo Masters 02',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at expedita hic provident temporibus tenetur?'
  },
  {
    id: 3,
    name: 'Demo Masters 03',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at expedita hic provident temporibus tenetur?'
  },
  {
    id: 4,
    name: 'Demo Masters 04',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at expedita hic provident temporibus tenetur?'
  },
  {
    id: 5,
    name: 'Demo Masters 05',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at expedita hic provident temporibus tenetur?'
  },
  {
    id: 6,
    name: 'Demo Masters 06',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at expedita hic provident temporibus tenetur?'
  },
  {
    id: 7,
    name: 'Demo Masters 07',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at expedita hic provident temporibus tenetur?'
  },
  {
    id: 8,
    name: 'Demo Masters 08',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at expedita hic provident temporibus tenetur?'
  },
];

export default function (axios) {
  return  {
    get() {
      return new Promise((resolve) => setTimeout(() => resolve(masters), 1500));
    },

    getById(id) {
      return new Promise((resolve) => setTimeout(() => {
        const master = masters.find((item) => item.id === id);
        resolve(master);
      }, 1500));
    },
  };
}

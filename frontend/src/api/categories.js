const categories = [
  {id: 1, name: 'Hair salons'},
  {id: 2, name: 'Barbershops'},
  {id: 3, name: 'Spas and nail salons'},
  {id: 4, name: 'Personal training'},
  {id: 5, name: 'Health and wellness'},
  {id: 6, name: 'Personal services'},
  {id: 7, name: 'Home repair and cleaning'},
  {id: 8, name: 'Tutoring and music lessons'},
];

export default function (axios) {
  return {
    get() {
      return new Promise((resolve) => setTimeout(() => resolve(categories), 1000));
    },
  };
}

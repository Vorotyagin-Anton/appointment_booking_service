const categories = [
  {id: 1, name: 'Hair salons', img: 'hair_and_beauty.webp'},
  {id: 2, name: 'Barbershops', img: 'barbershop.webp'},
  {id: 3, name: 'Spas and nail salons', img: 'spas_nail_salons.webp'},
  {id: 4, name: 'Personal training', img: 'personal_training.webp'},
  {id: 5, name: 'Health and wellness', img: 'health_wellness.webp'},
  {id: 6, name: 'Personal services', img: 'professional.webp'},
  {id: 7, name: 'Home repair and cleaning', img: 'home_repair.webp'},
  {id: 8, name: 'Tutoring and music lessons', img: 'tutoring_music.webp'},
];

export default function (axios) {
  return {
    get() {
      return new Promise((resolve) => setTimeout(() => resolve(categories), 1000));
    },
  };
}

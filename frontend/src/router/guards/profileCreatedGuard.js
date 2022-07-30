export default function (to) {
  if (to.meta.isProfileCreated) {
    return {name: 'cabinet.profile'};
  }
}

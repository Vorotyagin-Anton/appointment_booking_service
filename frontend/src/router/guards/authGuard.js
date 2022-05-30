export default function (to) {
  if (!to.meta.isAuthorized) {
    return {name: 'auth.signin'}
  }
}

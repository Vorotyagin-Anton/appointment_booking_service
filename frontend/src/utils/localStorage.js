export function getItem(key) {
  const value = window.localStorage.getItem(key);

  if (value) {
    return JSON.parse(value);
  }

  return null;
}

export function hasItem(key) {
  const value = window.localStorage.getItem(key);
  return Boolean(value);
}

export function setItem(key, value) {
  window.localStorage.setItem(key, JSON.stringify(value));
}

export function removeItem(key) {
  window.localStorage.removeItem(key);
}

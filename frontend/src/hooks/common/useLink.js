import {toRef} from "vue";

export default function useLink(props) {
  const link = toRef(props, 'link');

  const label = link.value.label ?? link.value.title;

  const path = link.value.route
    ? {name: link.value.route}
    : link.value.path;

  return {
    label,
    path,
  }
}

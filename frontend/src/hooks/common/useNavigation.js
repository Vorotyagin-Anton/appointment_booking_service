import {useStore} from "vuex";

export default function useNavigation() {
  const store = useStore();

  const getGroup = (group) => {
    return store.getters['navigation/getGroup'](group);
  };

  const getGroups = (groups) => {
    return store
      .getters['navigation/groups']
      .filter((item) => groups.includes(item.name));
  };

  return {
    getGroup,
    getGroups,
  }
}

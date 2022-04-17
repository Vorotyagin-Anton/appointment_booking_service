import {useStore} from "vuex";
import {computed} from "vue";

export default function useNavigation() {
  const store = useStore();

  const navigation = computed(() => store.getters['navigation/all']);

  const getGroup = (group) => {
    return navigation.value.find((item) => item.group === group);
  };

  const getGroups = (...groups) => {
    return navigation.value.filter((item) => groups.includes(item.group));
  };

  return {
    getGroup,
    getGroups,
  }
}

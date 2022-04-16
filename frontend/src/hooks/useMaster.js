import {api} from "boot/api";
import {computed, onMounted} from "vue";
import {useStore} from "vuex";

export default function useMaster() {
  const store = useStore();

  const id = computed(() => store.getters['master/id']);
  const master = computed(() => store.getters['master/data']);

  const setMasterId = async (id) => {
    await store.dispatch('master/setId', id);
  };

  const setMaster = async (id) => {
    try {
      const payload = await api.masters.getBuId(id);
      await store.dispatch('master/setId', payload.id);
      await store.dispatch('master/setMaster', payload);
    } catch (error) {
      console.error(error)
    }
  };

  const mountMaster = async () => {
    onMounted(async () => {
      if (master.value === null || master.value.id !== id.value) {
        await setMaster(id.value)
      }
    });
  };

  return {
    master,
    setMasterId,
    setMaster,
    mountMaster,
  }
}

import {api} from "boot/api";
import {useStore} from "vuex";
import {computed, onMounted} from "vue";
import useOrderModal from "src/hooks/order/useOrderModal";

export default function useMaster() {
  const store = useStore();

  const id = computed(() => store.getters['master/id']);
  const master = computed(() => store.getters['master/data']);

  const setMasterId = async (id) => {
    await store.dispatch('master/setId', id);
  };

  const setMaster = async (id) => {
    try {
      const payload = await api.masters.getById(id);
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

  const selectMaster = (id) => {
    console.log('selected', id);
  };

  const {openOrderModal} = useOrderModal();

  const reserveMaster = async (id) => {
    console.log('reserved', id);

    await store.dispatch('master/setId', id)
    openOrderModal();
  }

  const orderInfo = computed(() => store.getters['order/getData']);

  const makeOrder = async (masterId,serviceId) => {
    await store.dispatch('order/setMaster', masterId)
    await store.dispatch('order/setService', serviceId)
  }

  const addTimeToOrder = async (date, timeId) =>{
    await store.dispatch('order/setDate', date)
    await store.dispatch('order/setTime', timeId)
  }

  return {
    master,
    setMasterId,
    setMaster,
    mountMaster,
    selectMaster,
    reserveMaster,
    makeOrder,
    orderInfo,
    addTimeToOrder
  }
}

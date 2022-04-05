import {computed} from "vue";
import {useStore} from "vuex";

export default function useOrderModal() {
    const store = useStore();

    const isOrderModalOpen = computed(() => store.getters['order/isModalOpen']);
    const openOrderModal = () => store.dispatch('order/setModalStatus', true);
    const closeOrderModal = () => store.dispatch('order/setModalStatus', false);
    const toggleOrderModal = () => store.dispatch('order/setModalStatus', !isOrderModalOpen.value);

    return {
      isOrderModalOpen,
      openOrderModal,
      closeOrderModal,
      toggleOrderModal,
    }
}

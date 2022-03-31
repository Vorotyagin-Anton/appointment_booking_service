import {computed} from "vue";
import {useStore} from "vuex";



export default function useOrderModal() {
    const store = useStore();

    const isOrderModalOpen = computed(() => store.getters['order/isModalOpen']);
    const openOrderModule = () => store.dispatch('order/setModalStatus', true);
    const closeOrderModule = () => store.dispatch('order/setModalStatus', false);
    const toggleOrderModule = () => store.dispatch('order/setModalStatus', !isOrderModalOpen.value);

    return {
      isOrderModalOpen,
      openOrderModule,
      closeOrderModule,
      toggleOrderModule,
    }
}

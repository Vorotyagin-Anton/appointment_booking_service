<template>

  <div class="q-pa-md">

        <q-btn-toggle
          push
          glossy
          v-model="selectedService"
          toggle-color="primary"
          :options="items"
        />

  </div>

</template>

<script>
import {ref, watch} from "vue"
import useMaster from "src/hooks/useMaster";

export default {
  name: "OrderStepperService",

  setup() {
    const {master, mountMaster, makeOrder, orderInfo} = useMaster();
    mountMaster();

    const items = []

    const makeItems = (services) => {
      services.forEach(service => {
        items.push({label: service.name, value: service.id})
        })
      }

    makeItems(master.value.services)

    const selectedService = ref(orderInfo.value.service);

    watch(selectedService, (selectedService, prevSelectedService) => {

      makeOrder(master.value.id, items.find(service => service.id === selectedService.value))
    })

    return {
      selectedService,
      items,
    }
  }
}
</script>

<style lang="scss">

</style>

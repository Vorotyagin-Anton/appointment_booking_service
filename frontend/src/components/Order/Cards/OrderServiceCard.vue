<template>

  <div class="q-pa-md">

        <q-btn-toggle
          push
          glossy
          v-model="service"
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
        console.log('service.name', service.name)
        items.push({label: service.service.name, value: service.id, id: service.id})
        })
      }

    makeItems(master.value.services)

    const service = ref();

    if (orderInfo.value.service !== null){
      //console.log('orderInfo.value.service', orderInfo.value.service)
      service.value = orderInfo.value.service.id
    }

    watch(service, (service, prevService) => {
      const selectedService = service
      makeOrder(master.value.id, master.value.services.find(item => item.id === selectedService))
    })

    return {
      service,
      items,
    }
  }
}
</script>

<style lang="scss">

</style>

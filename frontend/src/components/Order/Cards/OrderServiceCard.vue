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
    const selectedService = ref();
    const {master, mountMaster} = useMaster();

    mountMaster();

    const items =[]

    const makeItems = (services) => {
      services.forEach(service => {
        items.push({label: service.name, value: service.id})
        })
      }

    makeItems(master.value.services)

    watch(selectedService, (selectedService, prevSelectedService) => {
      console.log('записать в сторедж ид сервиса', selectedService)
      console.log('записать в сторедж объект сервиса', master.value.services.find(item => item.id === selectedService))
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

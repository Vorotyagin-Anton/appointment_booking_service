<template>
  <q-input filled v-model="name" label="Name" stack-label />
  <q-input filled v-model="phone" label="phone" stack-label  />
  <q-input filled v-model="email" label="phone" stack-label  />

  <q-chip
    color="primary"
    text-color="white"
    icon="watch_later">
    service
  </q-chip>

  <q-chip
    color="primary"
    text-color="white"
    icon="watch_later">
    date
  </q-chip>

  <q-chip
          color="primary"
          text-color="white"
          icon="watch_later">
          time
  </q-chip>
  <q-btn>confirm</q-btn>
</template>

<script>
import {ref} from "vue"
export default {
  name: "OrderStepperConfirm",

  setup(){
    const name = ref()
    const phone = ref()
    const email = ref()

    return{
      name,
      phone,
      email
    }
  }
}
</script>

<style lang="scss">

</style>

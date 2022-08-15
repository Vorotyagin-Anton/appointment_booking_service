<template>

  <q-dialog v-model="dialogLocal"
            persistent
            transition-show="scale"
            transition-hide="scale">
    <q-card class="bg-teal text-white" style="width: 300px">

      <div class="text-h5 text-center">
        {{ title }}
      </div>

      <q-card-section class="q-pt-none">
        <slot/>
      </q-card-section>

      <q-card-actions align="center" class="bg-white text-teal">
        <q-btn flat
               label="OK"
               v-close-popup
               @click="$emit('closeModal')"
        />
      </q-card-actions>
    </q-card>
  </q-dialog>

</template>

<script setup>

import {ref} from "vue";

const props = defineProps({
  dialog: {
    type: Boolean,
    default: false
  },
  title: {
    type: String,
    default: 'Default title'
  }
})

const emits = defineEmits([

])

const dialogLocal = ref(props.dialog)

</script>

<style scoped>

</style>

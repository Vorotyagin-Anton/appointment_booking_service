<template>

  <q-dialog v-model="showModalLocal" persistent transition-show="scale" transition-hide="scale">
    <q-card class="bg-teal text-white" style="width: 300px">

      <div class="text-h6">
        <slot name="header"/>
      </div>

      <q-card-section class="q-pt-none">
        <slot name="body"/>
      </q-card-section>

      <q-card-actions align="center" class="bg-white text-teal">
        <slot name="footer"/>
      </q-card-actions>
    </q-card>
  </q-dialog>

</template>

<script>
import {ref} from 'vue'
export default {
  name: "ModalDefault",

  props: {
    showModal: {
      type: Boolean,
      default: false
    }
  },

  setup(props){
    const showModalLocal = ref(props.showModal)

    return {
      showModalLocal,
    }
  }
}
</script>

<style scoped>

</style>

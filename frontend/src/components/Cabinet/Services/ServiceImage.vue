<script setup>
import {ref} from "vue";

const props = defineProps({
  modalValue: {
    type: String,
    default: null,
  },
});

const emit = defineEmits([
  'update:modal-value',
]);

const image = ref(props.modalValue);

const setImage = () => {
  emit('update:modal-value', image);
};
</script>

<template>
  <div class="service-image">
    <q-img
      class="service-image__img"
      :src="image"
    >
      <div v-if="image" class="absolute-bottom text-body1 text-center">
        {{ image.name }}
      </div>
    </q-img>

    <q-file
      class="service-image__file"
      v-model="image"
      @update:model-value="setImage"
    />

    <div class="service-image__descr">
      <span class="material-icons service-image__icon">add_a_photo</span>
      <span class="services-modal__span service-image__title">Upload photo</span>
    </div>
  </div>
</template>

<style lang="scss">
.service-image {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;

  &__file {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1000;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
  }

  &__descr {
    position: absolute;
    z-index: 500;
    display: flex;
    flex-direction: column;
    opacity: 85%;
    font-size: 60px;
    color: $white;
  }
}
</style>

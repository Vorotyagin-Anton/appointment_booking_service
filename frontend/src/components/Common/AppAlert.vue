<script setup>
const props = defineProps({
  visible: {type: Boolean, required: true},
  message: {type: String, required: true},
  type: {type: String, required: true},
});

const emit = defineEmits(['hide']);
const hide = () => emit('hide');
</script>

<template>
  <div
    class="container app-alert"
    :class="['app-alert__' + type, {'app-alert_active': visible}]"
  >
    <div class="app-alert__content">
      <div class="app-alert__message">{{ message }}</div>

      <span class="material-icons app-alert__close" @click="hide">
        close
      </span>
    </div>
  </div>
</template>

<style lang="scss">
.app-alert {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 80px;
  display: flex;
  justify-content: center;
  transition: transform 300ms, background-color 300ms;
  transform: translateY(-100%);
  z-index: 5000;

  &_active {
    transform: translateY(0);
  }

  &__content {
    position: relative;
    width: 900px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  &__message {
    width: 100%;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
    color: $white
  }

  &__close {
    position: absolute;
    right: 0;
    margin-left: 50px;
    font-size: 26px;
    font-weight: 500;
    color: $white;
    cursor: pointer;
  }

  &__success {
    background-color: $green-8;
  }

  &__info {
    background-color: $blue-8;
  }

  &__error {
    background-color: $deep-orange-14;
  }
}
</style>

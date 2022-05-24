<template>
  <div class="profile-account-textarea">
      <div class="profile-account-textarea__label">
        {{ label }}
      </div>

      <textarea
        class="profile-account-textarea__input"
        v-model="model"
      ></textarea>
  </div>

</template>

<script>
import {ref, watch} from "vue";

export default {
  name: "ProfileAccountTextarea",

  props: {
    label: {
      type: String,
      required: true,
    },

    modelValue: {
      type: [String, null],
      required: true,
    },

    value: {
      type: String,
      default: '',
    },
  },

  emits: [
    'update:modelValue',
  ],

  setup(props, {emit}) {
    const model = ref(props.modelValue);

    watch(model, () => {
      emit('update:modelValue', model.value);
    });

    return {
      model,
    }
  }
}
</script>

<style lang="scss">
.profile-account-textarea {
  display: flex;
  border: 1px solid $grey-4;
  min-height: 180px;
  width: 100%;

  &__label {
    flex: 2;
    padding: 15px;
    display: flex;
    align-items: flex-start;
    background-color: $grey-3;
    font-size: 14px;
    font-weight: 500;
  }

  &__input {
    flex: 5;
    width: 100%;
    padding: 15px;
    outline: none;
    border: none;
  }
}
</style>

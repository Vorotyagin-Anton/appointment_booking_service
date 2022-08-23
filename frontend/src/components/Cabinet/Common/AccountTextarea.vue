<template>
  <div class="account-textarea">
      <div class="account-textarea__label">
        {{ label }}
      </div>

      <textarea
        class="account-textarea__input"
        v-model="model"
        :placeholder="placeholder"
      ></textarea>
  </div>

</template>

<script>
import {ref, toRef, watch} from "vue";

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

    placeholder: {
      type: String,
      default: '',
    }
  },

  emits: [
    'update:modelValue',
  ],

  setup(props, {emit}) {
    const model = ref(props.modelValue);
    const modelRef = toRef(props, 'modelValue');
    watch(model, () => emit('update:modelValue', model.value));
    watch(modelRef, () => model.value = props.modelValue);

    return {
      model,
    }
  }
}
</script>

<style lang="scss">
.account-textarea {
  display: flex;
  border: 1px solid $grey-4;
  min-height: 180px;
  width: 100%;

  &__label {
    width: 130px;
    padding: 15px;
    display: flex;
    align-items: flex-start;
    background-color: $grey-3;
    font-size: 12px;
    font-weight: 500;
  }

  &__input {
    width: calc(100% - 130px);
    padding: 15px;
    outline: none;
    border: none;

    &::placeholder {
      color: $grey-6;
      font-size: 12px;
    }
  }
}
</style>

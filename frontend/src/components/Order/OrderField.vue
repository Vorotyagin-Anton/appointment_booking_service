<template>
  <div
    class="order-field"
    :class="{'order-field_focused': isFocused}"
  >
    <div
      class="order-field__label"
      :class="{'order-field__label_focused': isFocused}"
    >
      {{ label }}
    </div>

    <q-input
      class="order-field__input"
      v-model="model"
      :type="type"
      :placeholder="placeholder"
      square
      @focus="focus"
      @blur="blur"
      @update:model-value="updateModel"
    />
  </div>
</template>

<script>
import {ref} from "vue";

export default {
  name: "OrderField",

  props: {
    label: {
      type: String,
      required: true,
    },

    modelValue: {
      type: [String, null],
      default: null
    },

    type: {
      type: String,
      default: 'text',
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
    const isFocused = ref(false);
    const focus = () => isFocused.value = true;
    const blur = () => isFocused.value = false;

    const model = ref(props.modelValue);

    const updateModel = (value) => emit('update:modelValue', value);

    return {
      model,
      isFocused,
      updateModel,
      focus,
      blur,
    }
  },
}
</script>

<style lang="scss">
.order-field {
  width: 100%;
  height: 50px;
  display: flex;
  border: 1px solid $grey-4;

  &_focused {
    border-bottom: 1px solid $primary;
  }

  &__label {
    width: 70px;
    height: 100%;
    padding: 0 15px;
    display: flex;
    align-items: center;
    background-color: $grey-3;
    font-size: 12px;
    font-weight: 500;

    &_focused {
      background-color: $blue-2;
    }
  }

  &__input {
    //width: calc(100% - 130px);
    font-size: 13px;

    .q-field__control {
      height: 49px;

      &:before {
        border-bottom: none;
      }

      &:hover:before {
        border-bottom: none
      }

      &:after {
        height: 0;
      }
    }

    .q-field__native {
      padding: 0 15px;
    }

    .q-field__native::placeholder {
      color: $grey-6;
      font-size: 12px;
    }
  }

  &__value {
    flex: 5;
    display: flex;
    align-items: center;
    padding: 0 15px;
  }

  &__btn {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 5px;
    color: $primary;
    cursor: pointer;
  }
}
</style>

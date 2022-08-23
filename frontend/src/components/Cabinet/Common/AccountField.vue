<template>
  <div
    class="account-field"
    :class="{'account-field_focused': isFocused}"
  >
    <div
      class="account-field__label"
      :class="{'account-field__label_focused': isFocused}"
    >
      {{ label }}
    </div>

    <q-input
      class="account-field__input"
      :class="{'account-field__input_disabled': disable}"
      v-model="model"
      :type="type"
      :placeholder="placeholder"
      :disable="disable"
      :min="min"
      :max="max"
      square
      @focus="focus"
      @blur="blur"
      @update:model-value="updateModel"
    />
  </div>
</template>

<script>
import {ref, toRef, watch} from "vue";

export default {
  name: "ProfileAccountField",

  props: {
    label: {
      type: String,
      required: true,
    },

    modelValue: {
      type: [String, Number, null],
      default: null
    },

    type: {
      type: String,
      default: 'text',
    },

    placeholder: {
      type: String,
      default: '',
    },

    disable: {
      type: Boolean,
      default: false,
    },

    min: {
      type: Number,
    },

    max: {
      type: Number,
    },
  },

  emits: [
    'update:modelValue',
  ],

  setup(props, {emit}) {
    const isFocused = ref(false);
    const focus = () => isFocused.value = true;
    const blur = () => isFocused.value = false;

    const model = ref(props.modelValue);
    const modelRef = toRef(props, 'modelValue');
    const updateModel = (value) => emit('update:modelValue', value);

    watch([modelRef], () => model.value = props.modelValue);

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
.account-field {
  width: 100%;
  height: 50px;
  display: flex;
  border: 1px solid $grey-4;

  &_focused {
    border-bottom: 1px solid $primary;
  }

  &__label {
    width: 130px;
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
    width: calc(100% - 130px);
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
      color: $grey-8;
      font-weight: 400;
      font-size: 12px;
    }

    &_disabled {
      background-color: #d9d9d9;
      background-image: repeating-linear-gradient(135deg, transparent, transparent 1px, #fff 1px, #fff 5px, transparent 5px, transparent 6px, #fff 6px, #fff 10px);
      background-size: 7px 7px;
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

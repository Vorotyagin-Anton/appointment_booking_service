<template>
  <div
    class="account-select"
    :class="{'account-select_focused': isFocused}"
  >
    <div
      class="account-select__label"
      :class="{'account-select__label_focused': isFocused}"
    >
      {{ label }}
    </div>

    <q-select
      class="account-select__input"
      v-model="model"
      :options="options"
      square
      dense
      options-dense
      @focus="focus"
      @blur="blur"
    />
  </div>
</template>

<script>
import {ref, watch} from "vue";

export default {
  name: "ProfileAccountSelect",

  props: {
    label: {
      type: String,
      required: true,
    },

    options: {
      type: Array,
      required: true,
    },

    modelValue: {
      type: [Object, null],
      required: true,
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

    watch(model, () => {
      emit('update:modelValue', model.value);
    });

    return {
      model,
      isFocused,
      focus,
      blur,
    }
  },
}
</script>

<style lang="scss">
.account-select {
  width: 100%;
  height: 50px;
  display: flex;
  border: 1px solid $grey-3;

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
    font-size: 13px;
    font-weight: 500;

    &_focused {
      background-color: $blue-2;
    }
  }

  &__input {
    flex: 5;

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
      padding: 0 10px;
      height: 50px;
      min-height: 50px;
      box-sizing: border-box;
    }

    .q-field__marginal {
      height: 100%;
    }
  }
}
</style>

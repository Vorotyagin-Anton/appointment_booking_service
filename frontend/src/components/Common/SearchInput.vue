<script setup>
import {computed, onMounted, onUnmounted, ref} from "vue";

const props = defineProps({
  modelValue: {
    type: String,
    default: '',
  },

  loading: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(['update:modelValue', 'search']);

const input = ref(props.modelValue);
const isFocused = ref(false);

const isEmpty = computed(() => input.value.length === 0);

const setFocus = (value) => isFocused.value = value;

const onUpdate = () => emit('update:modelValue', input.value);

const onSearch = () => emit('search', input.value);

const resetInput = () => {
  input.value = '';
  emit('search', '')
};

const handleEnterKeyDown = async (event) => {
  if (event.keyCode === 13) {
    await onSearch();
  }
};

onMounted(() => document.addEventListener('keydown', handleEnterKeyDown));

onUnmounted(() => document.removeEventListener('keydown', handleEnterKeyDown));
</script>

<template>
  <q-input
    class="search-input"
    outlined
    square
    dense
    label="Search"
    v-model="input"
    @focusin="setFocus(true)"
    @focusout="setFocus(false)"
    @update:model-value="onUpdate"
  >
    <template
      v-slot:append
      v-if="!loading"
    >
      <q-icon
        class="search-input__clear"
        name="close"
        v-if="!isEmpty"
        @click="resetInput"
      />

      <q-separator vertical/>

      <div class="search-input__btn">
        <q-icon
          class="search-input__search"
          name="search"
          @click="onSearch"
        />
      </div>
    </template>
  </q-input>
</template>

<style lang="scss">
.search-input {

  &__clear {
    right: 10px;
    cursor: pointer;
  }

  &__search {
    left: 5px;
  }

  &__btn {
    cursor: pointer;
  }
}
</style>

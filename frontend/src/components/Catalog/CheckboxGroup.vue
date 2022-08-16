<script setup>
import {computed, ref, watch} from "vue";

const props = defineProps({
  label: {
    type: String,
    required: true
  },

  select: {
    type: Array,
    required: true,
  },

  options: {
    type: Array,
    required: true,
  },

  filterFn: {
    type: Function,
  },

  fetchFn: {
    type: Function,
  },
});

const emit = defineEmits(['update:select']);

const input = ref('');
const optionsEl = ref(null);
const filteredOptions = ref([]);
const selectedOptions = ref([]);
const fetchError = ref(false);

const optionsMap = computed(() => {
  return filteredOptions.value.length > 0 ? filteredOptions.value : props.options;
});

const onUpdateSelection = () => emit('update:select', selectedOptions.value);

const onUpdateInput = () => filteredOptions.value = props.filterFn(input.value);

const setScrollTrigger = (optionsEl) => {
  const observer = new IntersectionObserver(([entry], observer) => {
    if (entry.isIntersecting && !fetchError.value) {
      props.fetchFn()
        .then(() => observer.observe(optionsEl.lastChild))
        .catch(() => fetchError.value = true);
    }
  });

  observer.observe(optionsEl.lastChild);
};

watch(() => props.select, () => {
  selectedOptions.value = props.select;
});

watch(() => optionsEl.value, () => {
  if (props.fetchFn && optionsEl.value) {
    setScrollTrigger(optionsEl.value.$el);
  }
});
</script>

<template>
  <div class="checkbox-group">
    <q-input
      class="checkbox-group__header02"
      dense
      :label="label"
      :disable="!filterFn"
      v-model="input"
      @update:model-value="onUpdateInput"
    />

    <q-option-group
      v-if="optionsMap.length > 0"
      ref="optionsEl"
      class="checkbox-group__items"
      type="checkbox"
      v-model="selectedOptions"
      :options="optionsMap"
      @update:model-value="onUpdateSelection"
    />
  </div>
</template>

<style lang="scss">
.checkbox-group {

  &__header02 {
    width: 290px;
    border-left: 5px solid $primary;

    .q-field__label {
      padding: 0 10px;
      font-size: 16px;
      font-weight: 500;
      color: $primary;
    }

    .q-field__native {
      padding-left: 10px;
    }

    .q-field__inner {
      cursor: default !important;
    }

    .q-field__control > div {
      opacity: 1 !important;
    }
  }

  &__header {
    width: 100%;
    height: 40px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    padding: 0 10px;
    border-left: 5px solid $primary;
    border-bottom: 1.5px solid $grey-5;
    font-size: 18px;
    font-weight: 500;
    color: $primary;
  }

  &__items {
    padding: 10px 5px;
    color: $grey-9;
    height: 300px;
    overflow: auto;
  }
}
</style>

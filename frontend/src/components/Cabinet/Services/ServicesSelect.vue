<script setup>
import {ref, toRef} from "vue";
import AccountSelect from "components/Cabinet/Common/AccountSelect";
import useSelect from "src/hooks/form/useSelect";

const props = defineProps({
  services: {
    type: Array,
    required: true,
  },
});

const emit = defineEmits(['update:modelValue']);

const servicesList = toRef(props, 'services');
const service = ref(null);

const handleSelect = () => emit('update:modelValue', service.value);

const {itemsList} = useSelect(servicesList);
</script>

<template>
  <account-select
    label="Services"
    :options="itemsList"
    v-model="service"
    @update:modelValue="handleSelect"
  />
</template>

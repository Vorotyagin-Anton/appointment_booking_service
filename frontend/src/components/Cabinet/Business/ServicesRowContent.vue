<script setup>
import {computed, ref} from "vue";
import formatPrice from "src/filters/formatPrice";
import formatDuration from "src/filters/formatDuration";
import ServicesRow from "components/Cabinet/Business/ServicesRow";
import ServicesRowPlaceholder from "components/Cabinet/Business/ServicesRowPlaceholder";

const props = defineProps({
  service: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits([
  'select', 'toggle', 'remove',
]);

const status = ref(props.service.active);
const duration = computed(() => formatDuration(props.service.duration ?? 1));
const price = computed(() => formatPrice(props.service.price ?? "0.00"));

const selectService = () => {
  emit('select', props.service);
};

const toggleService = (value) => {
  emit('toggle', {
    id: props.service.id,
    status: value,
  });
};

const removeService = () => {
  emit('remove', props.service.id);
};

</script>

<template>
  <services-row>
    <template v-slot:status>
      <q-checkbox
        class="service-table__checkbox"
        v-model="status"
        @update:model-value="toggleService"
      />
    </template>

    <template v-slot:name>
        <span class="services-table__col">
          {{ service.name }}
        </span>
    </template>

    <template v-slot:duration>
        <span class="services-table__col">
          {{ duration }}
        </span>
    </template>

    <template v-slot:price>
        <span class="services-table__col">
          $ {{ price }}
        </span>
    </template>

    <template v-slot:description>
        <span
          class="services-table__col services-table__description"
          v-if="service.description"
        >{{ service.description }}</span>

      <services-row-placeholder v-else content="No description"/>
    </template>

    <template v-slot:image>
      <q-img
        class="services-table__img"
        v-if="service.pathToPhoto"
        :src="service.pathToPhoto"
      />

      <services-row-placeholder v-else content="No photo"/>
    </template>

    <template v-slot:actions>
      <div class="services-table__col services-table__actions">
          <span
            class="material-icons services-table__icon services-table__edit"
            @click="selectService"
          >edit</span>
        <span
          class="material-icons services-table__icon services-table__delete"
          @click="removeService"
        >delete</span>
      </div>
    </template>
  </services-row>
</template>

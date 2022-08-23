<script setup>
import {computed, ref} from "vue";
import formatPrice from "src/filters/formatPrice";
import formatDuration from "src/filters/formatDuration";
import ServicesRow from "components/Cabinet/Services/ServicesRow";
import ServicesRowPlaceholder from "components/Cabinet/Services/ServicesRowPlaceholder";

const props = defineProps({
  service: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits([
  'select', 'toggle', 'remove',
]);

const status = ref(props.service.status);
const duration = computed(() => formatDuration(props.service.duration ?? 1));
const price = computed(() => formatPrice(props.service.price ?? "0.00"));

const selectService = () => emit('select', props.service);
const toggleService = () => emit('toggle', props.service);
const removeService = () => emit('remove', props.service.id);

const openImage = (url) => window.open(url);
</script>

<template>
  <services-row>
    <template v-slot:status>
      <q-checkbox
        class="services-row-content__checkbox"
        dense
        v-model="status"
        @update:model-value="toggleService"
      />
    </template>

    <template v-slot:name>
        <span class="services-row-content__name">
          {{ service.service.name }}
        </span>
    </template>

    <template v-slot:duration>
        <span class="services-row-content__duration">
          {{ duration }}
        </span>
    </template>

    <template v-slot:price>
        <span class="services-row-content__price">
          $ {{ price }}
        </span>
    </template>

    <template v-slot:description>
        <span
          class="services-row-content__description"
          v-if="service.description"
        >{{ service.description }}</span>

      <services-row-placeholder v-else content="No description"/>
    </template>

    <template v-slot:image>
      <q-img
        class="services-row-content__img"
        v-if="service.service.pathToPhoto"
        :src="service.service.pathToPhoto"
        @click="() => openImage(service.service.pathToPhoto)"
      />

      <services-row-placeholder v-else content="No photo"/>
    </template>

    <template v-slot:actions>
      <div class="services-row-content__col services-row-content__actions">
          <span
            class="material-icons services-row-content__icon services-row-content__edit"
            @click="selectService"
          >edit</span>
        <span
          class="material-icons services-row-content__icon services-row-content__delete"
          @click="removeService"
        >delete</span>
      </div>
    </template>
  </services-row>
</template>

<style lang="scss">
.services-row-content {
  &__checkbox {
    padding: 0 10px;
    .q-checkbox__inner:before {
      background: none!important;
    }
  }

  &__description {
    white-space: pre-line;
  }

  &__img {
    max-height: 70px;
    cursor: pointer;
  }

  &__actions {
    display: flex;
    justify-content: flex-end;
  }

  &__icon {
    margin: 0 5px;
    font-size: 22px;
    cursor: pointer;
    transition: all .3s;

    &:active {
      transform: scale(.8);
    }
  }

  &__edit {
    color: $primary;
  }

  &__delete {
    color: $red-7;
  }
}

</style>

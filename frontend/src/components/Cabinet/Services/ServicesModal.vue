<script setup>
import {onMounted, ref, toRef, watch} from "vue";
import AccountField from "components/Cabinet/Common/AccountField";
import AccountTextarea from "components/Cabinet/Common/AccountTextarea";
import ServicesSelect from "components/Cabinet/Services/ServicesSelect";

const props = defineProps({
  modelValue: {
    type: Boolean,
    required: true,
  },

  selectedService: Object,

  action: {
    validator: (value) => ['create', 'update'].includes(value),
    required: true,
  },

  onSubmit: {
    type: Function,
    required: true,
  }
});

const emit = defineEmits([
  'update:modelValue', 'hide',
]);

const modal = ref(props.modelValue);
const modalRef = toRef(props, 'modelValue');
watch([modalRef], () => modal.value = props.modelValue);

const initialValue = {
  duration: 1,
  price: 0,
  description: null,
  service: {},
};

const service = ref(Object.assign({}, initialValue));

onMounted(() => {
  if (props.selectedService) {
    service.value = Object.assign({}, props.selectedService);
  }
});

const handleServiceSelect = (selectedService) => {
  if (selectedService) {
    service.value.service = selectedService;
  }
};

const updateModel = (value) => {
  emit('update:modelValue', value);
};

const hideModal = () => {
  emit('hide');
  service.value = Object.assign({}, initialValue);
};

const submitChanges = () => {
  props.onSubmit(service.value);
};

const resetChanges = () => {
  service.value = Object.assign({}, props.selectedService);
};
</script>

<template>
  <q-dialog
    class="services-modal"
    v-model="modal"
    @update:model-value="updateModel"
    @hide="hideModal"
  >
    <q-card class="services-modal__card">
      <q-card-section class="row items-center q-pb-none">
        <div class="text-h6">Service options</div>
        <q-space/>
        <q-btn icon="close" flat round dense v-close-popup/>
      </q-card-section>

      <q-card-section v-if="action === 'create'" class="services-modal__section">
        <services-select @select="handleServiceSelect"/>
      </q-card-section>

      <q-card-section class="services-modal__section">
        <account-field
          class="services-modal__field"
          label="Name"
          v-model="service.service.name"
          disable
        />

        <div class="services-modal__duration">
          <span class="services-modal__note-icon" style="top: 13px; left: 64px">*</span>

          <account-field
            class="services-modal__field"
            type="number"
            :min="1"
            :max="48"
            label="Duration"
            v-model="service.duration"
          />
        </div>

        <account-field
          class="services-modal__field"
          type="number"
          :min="0"
          label="Price"
          v-model="service.price"
        />

        <account-textarea
          class="services-modal__field"
          label="Description"
          v-model="service.description"
          placeholder="Enter a brief about service. Short descriptions are the most effective."
        />

        <div class="text-caption text-grey services-modal__note">
          <span class="services-modal__note-icon" style="top: 0; left: 0;">*</span>
          The duration field specifies the duration of the service. The minimum duration is 30 minutes. By increasing
          the value by one, 30 minutes arrive at the service time.
        </div>
      </q-card-section>

      <q-card-actions align="right">
        <q-btn
          v-if="action === 'update'"
          class="services-modal__btn"
          outline
          label="Reset"
          @click="resetChanges"
        />

        <q-btn
          class="services-modal__btn"
          :label="action === 'update' ? 'Update' : 'Create'"
          color="primary"
          v-close-popup
          @click="submitChanges"
        />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<style lang="scss">
.services-modal {
  &__card {
    min-width: 400px !important;
    max-width: 600px !important;
    width: 100%;
  }

  &__section {
    width: 100%;
  }

  &__field {
    margin-bottom: 15px;
  }

  &__btn {
    width: 150px;
  }

  &__duration {
    position: relative;
  }

  &__note-icon {
    position: absolute;
    color: $red-7;
  }

  &__note {
    position: relative;
    padding-left: 10px;
  }
}
</style>

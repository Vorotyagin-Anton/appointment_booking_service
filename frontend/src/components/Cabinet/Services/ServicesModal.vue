<script setup>
import {computed, ref, toRef, watch} from "vue";
import AppAlert from "components/Common/AppAlert";
import AppLoading from "components/Common/AppLoading";
import AccountField from "components/Cabinet/Common/AccountField";
import AccountTextarea from "components/Cabinet/Common/AccountTextarea";
import useLoading from "src/hooks/common/useLoading";
import useMessage from "src/hooks/common/useMessage";
import logger from "src/helpers/logger";
import formatDuration from "src/filters/formatDuration";
import formatPrice from "src/filters/formatPrice";

const props = defineProps({
  modelValue: {type: Boolean, required: true},
  service: {type: Object},
});

// Modal window
const model = ref(props.modelValue);
const modelRef = toRef(props, 'modelValue');
const emit = defineEmits(['update:modelValue']);
const updateModel = (value) => emit('update:modelValue', value);

watch([modelRef], () => model.value = props.modelValue);

// Service data
const defDuration = computed(() => formatDuration(props.service.duration ?? 1));
const defPrice = computed(() => formatPrice(props.service.price ?? "0.00"));

const duration = ref(null);
const price = ref(null);
const description = ref(null);
const image = ref(null);

const updateImage = (file) => image.value = file;

const resetChanges = () => {
  duration.value = null;
  price.value = null;
  description.value = null;
  image.value = null;
}

const {loading, startLoading, finishLoading} = useLoading();
const {visible, type, message, showError, showSuccess, hide} = useMessage();

const submitChanges = async () => {
  try {
    startLoading();

    const payload = {
      id: props.service.id,
      duration: duration.value,
      price: price.value,
      description: description.value,
      image: image.value,
    };

    console.log(payload);

    showSuccess('Profile successfully updated.', 5000);
  } catch (error) {
    logger(error);
    showError('Something was wrong.', 5000);
  } finally {
    finishLoading();
  }
};
</script>

<template>
  <app-alert
    :visible="visible"
    :message="message"
    :type="type"
    @hide="hide"
  />

  <app-loading v-if="loading" title="Loading..."/>

  <q-dialog
    class="services-modal"
    v-model="model"
    @update:model-value="updateModel"
  >
    <q-card class="services-modal__card">
      <q-card-section>
        <div class="text-h6">Service options</div>
      </q-card-section>

      <q-card-section class="services-modal__section">
        <account-field
          class="services-modal__field"
          label="Name"
          :placeholder="service.name"
          :disable="true"
        />

        <account-field
          class="services-modal__field"
          type="number"
          :min="1"
          :max="48"
          label="Duration"
          v-model="duration"
          :placeholder="defDuration"
        />

        <account-field
          class="services-modal__field"
          type="number"
          :min="0"
          label="Price"
          v-model="price"
          :placeholder="'$ ' + defPrice"
        />

        <account-textarea
          class="services-modal__field"
          label="Description"
          v-model="description"
          :placeholder="service.description ?? 'Enter a brief about service. Short descriptions are the most effective.'"
        />

        <div class="services-modal__photo service-modal-photo">
          <q-img
            class="service-modal-photo__img"
            :src="service.pathToPhoto"
          >
            <div v-if="image" class="absolute-bottom text-body1 text-center">
              {{ image.name }}
            </div>
          </q-img>

          <q-file
            class="service-modal-photo__file"
            v-model="image"
            @update:model-value="updateImage"
          />

          <div class="service-modal-photo__descr">
            <span class="material-icons service-modal-photo__icon">add_a_photo</span>
            <span class="services-modal__span service-modal-photo__title">Upload photo</span>
          </div>
        </div>
      </q-card-section>

      <q-card-actions align="right">
        <q-btn
          class="services-modal__btn"
          outline
          label="Reset"
          @click="resetChanges"
        />

        <q-btn
          class="services-modal__btn"
          label="Submit"
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
}

.service-modal-photo {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;

  &__file {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1000;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
  }

  &__descr {
    position: absolute;
    z-index: 500;
    display: flex;
    flex-direction: column;
    opacity: 85%;
    font-size: 60px;
    color: $white;
  }
}
</style>

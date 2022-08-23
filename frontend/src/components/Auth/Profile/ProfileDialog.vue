<script setup>
import {ref, toRef, watch} from "vue";
import ProfileTypeItem from "components/Auth/Profile/ProfileTypeItem";

const types = [
  {
    id: 'client',
    title: 'Individual',
    promo: 'Creating orders, tracking reservations, contacts with masters and other customers.',
    icon: 'person_outline',
  },
  {
    id: 'worker',
    title: 'Business',
    promo: 'One-Person business, Sole proprietor, LLC, Corporation.',
    icon: 'business',
  },
];

const props = defineProps({
  modelValue: {
    type: [String, null],
    required: true,
  },
});

const emit = defineEmits(['update:modelValue']);

const modelValueRef = toRef(props, 'modelValue');

const id = ref(null);
const open = ref(true);

watch([modelValueRef], () => {
  if (!modelValueRef.value) {
    id.value = null;
    open.value = true;
  }
})

const handleSelect = (value) => id.value = value;
const handleSubmit = () => emit('update:modelValue', id.value);
</script>

<template>
  <q-dialog
    class="profile-dialog"
    v-model="open"
    persistent
  >
    <q-card class="profile-dialog__card">
      <div class="profile-type">
        <div class="profile-type__content">
          <h2 class="profile-type__h2">Which type of account best describes you?</h2>
          <p class="profile-type__p">No matter what type of account you are. We can help you sell anywhere.</p>

          <profile-type-item
            class="profile-type__item"
            v-for="type in types"
            :key="type.id"
            :type="type"
            :is-selected="type.id === id"
            @selected="handleSelect"
          />

          <div class="profile-type__bottom">
            <q-btn
              class="profile-type__btn"
              label="Continue"
              color="primary"
              no-caps
              v-close-popup
              :disable="!id"
              @click="handleSubmit"
            />
          </div>
        </div>
      </div>
    </q-card>
  </q-dialog>
</template>

<style lang="scss">
.profile-dialog {
  &__card {
    width: 700px;
    max-width: 80vw !important;
    padding: 35px;
  }
}

.profile-type {
  display: flex;
  justify-content: center;

  &__content {
    display: flex;
    flex-direction: column;
  }

  &__h2 {
    font-size: 36px;
    padding: 15px 0;
  }

  &__p {
    font-size: 18px;
    margin-bottom: 15px;
    font-weight: 200;
  }

  &__bottom {
    margin-top: 25px;
    width: 100%;
    display: flex;
    justify-content: flex-end;
    padding: 25px 0;
    border-top: 1px solid $grey-4;
  }

  &__btn {
    width: 200px;
    height: 40px;
  }
}
</style>

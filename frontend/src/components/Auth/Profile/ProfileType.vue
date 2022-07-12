<template>
  <div class="profile-type">
    <div class="profile-type__content">
      <h2 class="profile-type__h2">Which type of account best describes you?</h2>
      <p class="profile-type__p">No matter what type of account you are. We can help you sell anywhere.</p>

      <profile-type-item
        class="profile-type__item"
        v-for="type in types"
        :key="type.id"
        :type="type"
        :is-selected="selectedId === type.id"
        @selected="handleSelect"
      />

      <div class="profile-type__bottom">
        <q-btn
          class="profile-type__btn"
          label="Back"
          color="black"
          outline
          no-caps
          @click="prev"
        />

        <q-btn
          class="profile-type__btn"
          label="Continue"
          color="primary"
          no-caps
          @click="next"
        />
      </div>
    </div>
  </div>
</template>

<script>
import {ref} from "vue";
import ProfileTypeItem from "components/Auth/Profile/ProfileTypeItem";
import useMessage from "src/hooks/common/useMessage";

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

export default {
  name: "ProfileType",

  components: {
    ProfileTypeItem,
  },

  emits: [
    'next',
    'prev',
  ],

  setup(props, { emit }) {
    const selectedId = ref(null);

    const handleSelect = (id) => selectedId.value = id;

    const {showError, hide} = useMessage();

    const next = () => {
      if (selectedId.value === null) {
        showError('Please choose type of your account.', 3000);
        return;
      }

      emit('next', {
        // isClient: selectedId.value === 'client',
        // isWorker: selectedId.value === 'worker',
      });

      hide();
    }

    const prev = () => emit('prev');

    return {
      types,
      selectedId,
      handleSelect,
      next,
      prev,
    }
  }
}
</script>

<style lang="scss">
.profile-type {
  display: flex;
  justify-content: center;

  &__content {
    width: 750px;
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
    justify-content: space-between;
    padding: 25px 0;
    border-top: 1px solid $grey-4;
  }

  &__btn {
    width: 360px;
    height: 40px;
  }
}
</style>

<template>
  <div class="acccount-avatar">
    <div class="acccount-avatar__content">
      <q-avatar
        class="acccount-avatar__photo"
        size="250px"
      >
        <img
          v-if="photo"
          :src="avatar"
          alt="img"
        >
      </q-avatar>

      <div class="acccount-avatar__background"></div>

      <div
        class="acccount-avatar__btn"
      >
        <span class="material-icons acccount-avatar__icon-photo">add_a_photo</span>
        <span class="acccount-avatar__span">Upload photo</span>
      </div>

      <q-file
        class="acccount-avatar__uploader"
        v-model="model"
        @update:model-value="updateModel"
      />
    </div>

    <div
      class="acccount-avatar__file"
      v-if="model"
    >
      {{ model.name }}
      <span
        class="material-icons acccount-avatar__close-icon"
        @click="removeModel"
      >
        close
      </span>
    </div>
  </div>
</template>

<script>
import {ref} from "vue";

export default {
  name: "ProfileAccountAvatar",

  props: {
    photo: {
      type: String,
    },

    modelValue: {
      type: [File, null],
      required: true,
    },
  },

  emits: [
    'update:modelValue',
  ],

  setup(props, {emit}) {
    const model = ref(props.modelValue);

    const avatar = process.env.HOST + props.photo;

    const updateModel = (value) => {
      emit('update:modelValue', value);
    };

    const removeModel = () => {
      model.value = null;
    };

    return {
      model,
      avatar,
      updateModel,
      removeModel,
    }
  }
}
</script>

<style lang="scss">
.acccount-avatar {
  display: flex;

  &__file {
    margin-left: 35px;
    margin-top: 125px;
    font-size: 13px;
    color: $grey-6;
  }

  &__close-icon {
    cursor: pointer;
    font-size: 24px;
    margin-left: 5px;

    &:hover {
      color: $primary;
    }
  }

  &__content {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  &__photo {
    background-color: $grey-6;
  }

  &__background {
    position: absolute;
    height: 252px;
    width: 252px;
    border-radius: 50%;
    opacity: 40%;
    background-color: $white;
  }

  &__btn {
    position: absolute;
    height: 252px;
    width: 252px;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    opacity: 85%;
  }

  &__icon-photo {
    font-size: 60px;
    color: $white;
  }

  &__icon-profile {
    font-size: 120px;
    color: $grey-9;
  }

  &__span {
    font-size: 16px;
    font-weight: 600;
    color: $white;
  }

  &__uploader {
    position: absolute;
    height: 252px;
    width: 252px;
    border-radius: 50%;
    cursor: pointer;

    .q-field__control {
      display: none;
    }
  }
}
</style>

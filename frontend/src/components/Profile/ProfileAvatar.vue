<template>
  <q-avatar
    class="profile-avatar"
    :size="size + 'px'"
    color="grey-3"
  >
    <img
      v-if="isImageProvided"
      :src="image"
      alt="img"
      @click="showAvatar"
    >
    <span v-else>
      {{ firstLetterName }}
    </span>
  </q-avatar>
</template>

<script>
import {computed} from "vue";

export default {
  name: "ProfileAvatar",

  props: {
    name: {
      type: String,
      required: true,
    },

    image: {
      type: String,
      default: '',
    },

    size: {
      type: Number,
      default: 25,
    },
  },

  setup(props) {
    const isImageProvided = computed(() => props.image.length > 0);
    const firstLetterName = computed(() => props.name[0]);

    const showAvatar = () => window.open(props.image);

    return {
      isImageProvided,
      firstLetterName,
      showAvatar,
    }
  }
}
</script>

<style lang="scss">
.profile-avatar {
  cursor: pointer;
}
</style>

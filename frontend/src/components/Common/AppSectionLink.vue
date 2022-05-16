<template>
  <div class="app-section-link">
    <router-link
      class="app-section-link__a"
      :to="to"
    >
        <span
          @mouseenter="toggleArrow"
          @mouseleave="toggleArrow"
        >
          {{ label }}
        </span>

      <transition name="slide-fade">
          <span
            class="material-icons app-section-link__arrow"
            v-if="showArrow"
          >
            east
          </span>
      </transition>
    </router-link>

  </div>
</template>

<script>
import {ref} from "vue";

export default {
  name: "AppSectionLink",

  props: {
    label: {
      type: String,
      required: true,
    },

    to: {
      type: Object,
      required: true,
    },
  },

  setup() {
    const showArrow = ref(false);
    const toggleArrow = () => showArrow.value = !showArrow.value;

    return {
      showArrow,
      toggleArrow,
    }
  },
}
</script>

<style lang="scss">
.app-section-link {
  display: flex;
  justify-content: center;

  &__a {
    position: relative;
    display: flex;
    align-items: center;
    color: $primary;
    font-size: 16px;
  }

  &__arrow {
    position: absolute;
    right: -25px;
    font-size: 18px;
    color: $primary;
  }
}

.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all .4s;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
</style>

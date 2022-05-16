<template>
  <div
    class="offers-item"
    :class="{'offers-item_focused': selected === offer.id}"
  >
    <transition
      enter-active-class="animated fadeIn"
      leave-active-class="animated fadeOut"
      appear
    >
      <div
        class="offers-item__front"
        v-if="isFrontVisible"
        @click="showBack"
      >
        <h3 class="offers-item__h3">
          {{ offer.heading }}
        </h3>

        <p class="offers-item__promo">
          {{ offer.promo }}
        </p>

        <button class="offers-item__btn">
          See top features
          <span class="material-icons offers-item__right">arrow_right_alt</span>
        </button>

        <img class="offers-item__img" :src="offer.image" alt="img">
      </div>
    </transition>

    <transition
      appear
      enter-active-class="animated fadeIn"
      leave-active-class="animated fadeOut"
    >
      <div
        class="offers-item__back"
        v-if="isBackVisible"
      >
        <div>
          <h4 class="offers-item__h4">
            {{ offer.heading }}
          </h4>

          <div class="offers-item__list">
            <div
              class="offers-item__item"
              v-for="(item, key) in offer.list"
              :key="key"
            >
              <span class="material-icons offers-item__done">done</span>
              {{ item }}
            </div>
          </div>
        </div>

        <button
          class="offers-item__btn"
          @click="showFront"
        >
          <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
               xmlns="http://www.w3.org/2000/svg">
            <path
              class="offers-item__left"
              d="M13 18L9 14M9 14L13 10M9 14H13.25H16.5C18.4737 14 19.8676 14.2451 21 15C22.5 16 23 17.139 23 18.5C23 19.861 22 21.5 20.6023 22.3917C19.5 23 18.361 23 17 23M31 16C31 24.2843 24.2843 31 16 31C7.71573 31 1 24.2843 1 16C1 7.71573 7.71573 1 16 1C24.2843 1 31 7.71573 31 16Z"
              stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
              stroke-linejoin="round"></path>
          </svg>
        </button>

      </div>
    </transition>
  </div>
</template>

<script>
import {ref, toRef, watch} from "vue";

export default {
  name: "OffersSectionItem",

  props: {
    offer: {
      type: Object,
      required: true,
    },

    selected: {
      type: Number,
      default: null,
    },
  },

  emits: [
    'open',
    'close',
  ],

  setup(props, {emit}) {
    const isFrontVisible = ref(true);
    const isBackVisible = ref(false);

    const selected = toRef(props, 'selected');

    const showFront = () => {
      isFrontVisible.value = true;
      isBackVisible.value = false;

      emit('close', props.offer.id);
    }

    const showBack = () => {
      isFrontVisible.value = false;
      isBackVisible.value = true;

      emit('open', props.offer.id);
    }

    watch(selected, () => {
      if (selected.value && selected.value !== props.offer.id) {
        isFrontVisible.value = true;
        isBackVisible.value = false;
      }

      if (!selected.value) {
        isFrontVisible.value = true;
        isBackVisible.value = false;
      }
    })

    return {
      isFrontVisible,
      isBackVisible,
      showFront,
      showBack,
    }
  },
}
</script>

<style lang="scss">
.offers-item {
  position: relative;
  width: 500px;
  height: 650px;
  margin: 15px 10px;
  border: 1px solid $grey-3;
  border-radius: 5px;
  cursor: pointer;
  transition-property: box-shadow;
  transition-duration: .7s;

  &:hover {
    box-shadow: rgba(0, 0, 0, .1) 0 4px 12px;
  }

  &_focused {
    box-shadow: rgba(0, 0, 0, .1) 0 4px 12px;
  }

  &__front {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
  }

  &__h3 {
    font-size: 30px;
    font-weight: 500;
  }

  &__promo {
    padding: 5px 60px;
    font-size: 16px;
    text-align: center;
  }

  &__btn {
    border: none;
    outline: none;
    background-color: inherit;
    cursor: pointer;
    color: $primary;
    font-size: 16px;
  }

  &__img {
    width: 500px;
  }

  &__right {
    font-size: 22px;
  }

  &__back {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: space-between;
    padding: 65px 45px 45px;
  }

  &__h4 {
    font-size: 24px;
    font-weight: 500;
    margin-bottom: 35px;
  }

  &__list {
    display: flex;
    flex-direction: column;
  }

  &__item {
    display: flex;
    align-items: center;
    font-size: 14px;
    margin-bottom: 15px;
  }

  &__done {
    color: $primary;
    font-size: 22px;
    margin-right: 10px;
  }

  &__left {
    stroke: $primary;
  }
}
</style>

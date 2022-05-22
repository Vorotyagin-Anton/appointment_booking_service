<template>
  <div
    class="master-header"
    :class="className"
  >
    <h5 class="master-header__name">
      {{ name }}
    </h5>

    <div class="master-header__rating">
      <q-rating
        class="master-header__score"
        v-model="masterRating.score"
        :max="masterRating.max"
        :color="'warning'"
        readonly
      />

      <span class="master-header__voices">
        {{ masterRating.score }} ({{ masterRating.voices }})
      </span>
    </div>
  </div>
</template>

<script>
import {toRef} from "vue";

export default {
  name: "MasterHeader",

  props: {
    name: {
      type: String,
      required: true,
    },

    rating: {
      type: Object,
      default: function () {
        return {
          max: 5,
          score: Number((Math.random() * 4 + 1).toFixed(1)),
          voices: Math.floor(Math.random() * 200)
        }
      }
    },

    className: {
      type: String,
      default: '',
    }
  },

  setup(props) {
    const masterRating = toRef(props, 'rating');

    return {
      masterRating,
    }
  }
}
</script>

<style lang="scss">
.master-header {
  display: flex;
  flex-wrap: wrap;
  width: 100%;

  &__name {
    font-size: 15px;
    font-weight: 600;
    color: $grey-9;
    line-height: 15px;
  }

  &__rating {
    display: flex;
    align-items: center;
  }

  &__score {
    margin-right: 5px;
  }

  &__voices {
    font-size: 11px;
    color: $grey-8;
    font-weight: 400;
  }
}
</style>

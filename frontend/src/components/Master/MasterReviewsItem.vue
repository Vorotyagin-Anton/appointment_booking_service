<template>
  <div class="master-review">
    <div class="master-review__intro">
      <profile-avatar
        class="master-review__avatar"
        :size="50"
        :name="data.reviewer.name"
        :image="data.reviewer.pathToPhoto"
      />

      <div class="master-review__info">
        <div class="master-review__name">{{ data.reviewer.name }} {{ data.reviewer.surname }}</div>
        <q-rating
          class="master-review__score"
          v-model="data.score"
          :max="5"
          :color="'warning'"
          readonly
        />

        <div class="master-review__date">{{ data.date }}</div>
      </div>
    </div>

    <div class="master-review__content">
      {{ data.text }}
    </div>
  </div>
</template>

<script>
import {toRef} from "vue";
import ProfileAvatar from "components/Profile/ProfileAvatar";

export default {
  name: "MasterReviewsItem",

  components: {
    ProfileAvatar,
  },

  props: {
    review: {
      type: Object,
    },
  },

  setup(props) {
    const data = toRef(props, 'review');

    return {
      data,
    }
  },
}
</script>

<style lang="scss">
.master-review {
  margin-bottom: 25px;

  &__intro {
    display: flex;
    align-items: center;
  }

  &__avatar {
    margin-right: 15px;
  }

  &__name {
    font-size: 12px;
    font-weight: 500;
    color: $grey-8;
  }

  &__score {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  &__voices {
    margin-left: 5px;
    font-size: 10px;
    font-weight: 400;
    color: $grey-7;
  }

  &__date {
    font-size: 10px;
    font-weight: 400;
    color: $grey-7;
  }

  &__content {
    margin-top: 15px;
    font-size: 12px;
    font-weight: 400;
    color: $grey-8;
  }
}
</style>

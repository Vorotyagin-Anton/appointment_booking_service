<template>
  <div class="master-reviews">
    <master-reviews-item
      class="master-reviews__review"
      v-for="review in reviews"
      :key="review.id"
      :review="review"
    />
  </div>
</template>

<script>
import MasterReviewsItem from "components/Master/MasterReviewsItem";

export default {
  name: "MasterReviews",

  components: {
    MasterReviewsItem,
  },

  props: {
    reviews: {
      type: Array,
      required: true,
    },
  },
}
</script>

<style lang="scss">
.master-reviews {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  overflow: auto;
}
</style>

<template>
  <app-section class="featured-masters">
    <div class="featured-masters__content">

      <div class="featured-masters__header">
        <AppSectionHeader
          heading="Featured Masters"
          description="Choose specialists based on their popularity"
        />
      </div>

      <div class="featured-masters__list">
        <master-card
          class="featured-masters__item"
          v-for="item in items"
          :key="item.id"
          :master="item"
          @selected="selectMaster"
          @reserved="reserveMaster"
        />
      </div>
    </div>

    <app-section-link
      class="featured-masters__link"
      label="Browse all"
      :to="{name: 'masters'}"
    />
  </app-section>
</template>

<script>
import {ref} from "vue";
import useFeatured from "src/hooks/masters/useFeatured";
import useMaster from "src/hooks/useMaster";
import AppSection from "components/Common/AppSection";
import AppSectionHeader from "components/Common/AppSectionHeader";
import AppSectionLink from "components/Common/AppSectionLink";
import MasterCard from "components/Master/MasterCard";

export default {
  name: "FeaturedMasters",

  components: {
    AppSection,
    AppSectionHeader,
    AppSectionLink,
    MasterCard,
  },

  setup() {
    const {items, initOnMountedHandler} = useFeatured();

    initOnMountedHandler();

    const {selectMaster, reserveMaster} = useMaster();

    const showArrow = ref(false);
    const toggleArrow = () => showArrow.value = !showArrow.value;

    return {
      items,
      showArrow,
      selectMaster,
      reserveMaster,
      toggleArrow,
    }
  }
}
</script>

<style lang="scss">
.featured-masters {

  &__content {
    padding: 0 120px;
  }

  &__header {
    margin-bottom: 50px;
  }

  &__list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  &__item {
    margin: 0 10px 25px;
  }

  &__link {
    margin-top: 15px;
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

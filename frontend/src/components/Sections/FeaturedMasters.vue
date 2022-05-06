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
          @selected="selectMaster(item.id)"
        />
      </div>
    </div>

    <div class="featured-masters__link">
      <router-link
        class="featured-masters__a"
        :to="{name: 'masters'}"
      >
        <span
          @mouseenter="toggleArrow"
          @mouseleave="toggleArrow"
        >
          Browse all
        </span>

        <transition name="slide-fade">
          <span
            class="material-icons featured-masters__arrow"
            v-if="showArrow"
          >
            east
          </span>
        </transition>
      </router-link>


    </div>
  </app-section>
</template>

<script>
import {ref} from "vue";
import AppSection from "components/Common/AppSection";
import AppSectionHeader from "components/Common/AppSectionHeader";
import MasterCard from "components/Master/MasterCard";
import useFeatured from "src/hooks/masters/useFeatured";
import useOrderModal from "src/hooks/order/useOrderModal";

export default {
  name: "FeaturedMasters",

  components: {
    AppSection,
    AppSectionHeader,
    MasterCard,
  },

  setup() {
    const {items, initOnMountedHandler} = useFeatured();

    initOnMountedHandler();

    const {openOrderModal} = useOrderModal();
    const selectMaster = (id) => openOrderModal();

    const showArrow = ref(false);
    const toggleArrow = () => showArrow.value = !showArrow.value;

    return {
      items,
      showArrow,
      selectMaster,
      toggleArrow,
    }
  }
}
</script>

<style lang="scss">
.featured-masters {
  background-color: $grey-3;

  &__content {
    padding: 0 120px;
  }

  &__header {
    margin-bottom: 50px;
  }

  &__list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  &__link {
    margin-top: 15px;
    display: flex;
    justify-content: center;
  }

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

.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
</style>

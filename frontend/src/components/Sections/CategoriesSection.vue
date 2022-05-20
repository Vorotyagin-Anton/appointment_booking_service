<template>
  <app-section class="categories-section">
    <app-section-header
      heading="Made to match your craft"
      description="Select a business type to find out how Booking Service could work for you"
    />

    <div class="categories-section__content">
      <div
        class="categories-section__items"
        v-if="categoryList.length > 0"
      >
        <q-select
          class="categories-section__select"
          v-model="category"
          :options="categoryList"
          options-cover
          stack-label
          outlined
          options-dense
          dense
          :model-value="category"
          @update:model-value="updateCategory"
        />

        <Carousel
          class="categories-slider categories-section__slider"
          :items-to-show="1.9"
          :wrap-around="true"
          :model-value="slide"
          @update:model-value="updateSlide"
        >
          <Slide
            class="categories-slider__slide"
            v-for="slide in slideList"
            :key="slide.id"
          >
            <div
              class="carousel__item categories-slider__item"
              :class="{'carousel__item_grabbing': isMouseDown}"
              @mousedown="handleMousedown"
              @mouseup="handleMouseup"
            >
              <q-img
                class="categories-slider__img"
                :src="slide.img"
                alt="img"
              />

              <div class="categories-slider__title">
                <h3 class="categories-slider__heading">{{ slide.name }}</h3>
                <p class="categories-slider__promo">{{ slide.promo }}</p>
                <q-btn
                  class="categories-slider__btn"
                  color="primary"
                  icon="add_circle_outline"
                  label="Learn more"
                  no-caps
                  flat
                />
              </div>
            </div>
          </Slide>
        </Carousel>
      </div>

      <q-spinner
        class="categories-section__spinner"
        v-else
        color="primary"
        size="5em"
        :thickness="2"
      />
    </div>

  </app-section>
</template>

<script>
import {computed, ref, watch} from "vue";
import useList from "src/hooks/categories/useList";
import AppSection from "components/Common/AppSection";
import AppSectionHeader from "components/Common/AppSectionHeader";
import {Carousel, Slide} from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';

const categoryPromos = [
  'For people who work magic with hair care.',
  'For people who give haircuts and life advice.',
  'For people who believe we should treat ourselves.',
  'For people who push for one more rep.',
  'For people who specialize in health, healing, and self-care.',
  'For people who do what you can’t learn on the internet.',
  'For people who save homes from DIY disasters.',
  'For people who believe practice makes perfect.',
];

export default {
  name: "CategoriesSection",

  components: {
    AppSection,
    AppSectionHeader,
    Carousel,
    Slide,
  },

  setup() {
    const {categories} = useList();

    const categoryList = computed(() => {
      return categories.value.map((category, key) => ({
        label: category.name,
        value: key,
      }));
    });

    const slideList = computed(() => {
      return categories.value.map((category, key) => ({
        ...category,
        ...{img: process.env.API_HOST + category.pathToPhoto},
        promo: categoryPromos[key],
      }));
    });

    const category = ref(categoryList.value[0] ?? null);
    const slide = ref();

    const updateCategory = (category) => {
      slide.value = category.value;
      setTimeout(() => slide.value = undefined, 100);
    }

    const updateSlide = (newSlide) => {
      category.value = categoryList.value[newSlide];
    }

    const isMouseDown = ref(false);
    const handleMousedown = () => isMouseDown.value = true;
    const handleMouseup = () => isMouseDown.value = false;

    watch(categoryList, () => {
      if (categoryList.value.length > 0) {
        category.value = categoryList.value[0];
      }
    });

    return {
      category,
      categoryList,
      slide,
      slideList,
      isMouseDown,
      handleMousedown,
      handleMouseup,
      updateCategory,
      updateSlide,
    }
  },
}
</script>

<style lang="scss">
.categories-section {
  &__content {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 300px;
  }

  &__items {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
  }

  &__select {
    width: 400px;
    margin: 30px 0 50px;

    .q-field__native {
      display: flex;
      justify-content: center;
    }
  }

  &__slider {
    width: 100%;
  }
}

.categories-slider {
  &__img {
    margin-bottom: 25px;
  }

  &__heading {
    margin-bottom: 15px;
    font-size: 32px;
    line-height: 40px;

    &::first-letter {
      text-transform: uppercase;
    }
  }

  &__promo {
    font-size: 14px;
  }

  &__btn {
    .q-icon {
      font-size: 36px;
    }
  }

  .carousel {
    &__item {
      min-height: 200px;
      width: 100%;
      font-size: 20px;
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      cursor: grab;

      &_grabbing {
        cursor: grabbing;
      }
    }

    &__img {
      width: 100%;
    }

    &__slide {
      padding: 10px;
    }

    &__prev,
    &__next {
      box-sizing: content-box;
      border: 5px solid white;
    }

    &__slide--prev,
    &__slide--next {
      opacity: 0.5;
    }
  }
}
</style>

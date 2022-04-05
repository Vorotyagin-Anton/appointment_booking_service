<template>
  <div class="slider-overview">

    <q-carousel
      v-model="slide"
      swipeable
      animated
      infinite
      :autoplay="5000"
      :transition-duration="4000"
      height="800px"
    >
      <q-carousel-slide :name="1" img-src="~assets/img/S-Barbershop.png"/>
      <q-carousel-slide :name="2" img-src="~assets/img/S-Nail-Salon.png"/>
      <q-carousel-slide :name="3" img-src="~assets/img/S-Hair-Salon.png"/>
    </q-carousel>

    <div class="slider-overview__row">
      <div class="slider-overview__title">
        <h2 class="slider-overview__heading">Booking Service</h2>
        <p class="slider-overview__p">Scheduling that puts time in your hands.</p>
        <q-btn
          class="slider-overview__btn"
          color="primary"
          label="Sign up free"
          size="18px"
          padding="10px 35px"
          no-caps
        />
        <a class="slider-overview__btn" href="#">
          Connect with as
          <span class="material-icons">arrow_right_alt</span>
        </a>
      </div>

    </div>
  </div>
</template>

<script>
import {defineComponent, ref} from "vue";

export default defineComponent({
  name: "SliderPromo",

  setup() {
    const slide = ref(1);

    return {
      slide,
    }
  }
})
</script>

<style lang="scss">
  .slider-overview {
    position: relative;
    width: 100%;
    height: 800px;

    &__row {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      position: absolute;
      background: none;
      top: 0;
      bottom: 0;
    }

    &__title {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    &__heading {
      color: $white;
      font-size: 72px;
      font-weight: 500;
      margin-bottom: 15px;
    }

    &__p {
      color: $white;
      font-size: 32px;
      font-weight: 500;
      margin-bottom: 15px;
    }

    &__btn {
      margin-bottom: 15px;
      font-size: 16px;
    }
  }
</style>

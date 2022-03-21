<template>
  <div class="text-white main-footer container">
    <div class="main-footer__row">
      <div class="main-footer__col">
        <p class="main-footer__link">
          <a class="main-footer__a" href="#">feedback@bookingservice.ru</a> - оставить отзыв
        </p>
        <p class="main-footer__link">
          <a class="main-footer__a" href="#">Privacy Policy</a> - политика в области персональных данных
        </p>
        <p class="main-footer__link">
          &copy; <span class="main-footer__date">{{ date }}</span> www.bookingservice.ru
        </p>
      </div>

      <div class="main-footer__col main-footer__apps">
        <div class="app-links">
          <a class="app-links__a app-links__and" href="#">
            <img src="~assets/img/and.svg" alt="and">
          </a>

          <a class="app-links__a app-links__ios" href="#">
            <img src="~assets/img/ios.svg" alt="ios">
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {defineComponent} from 'vue';
import useApplicationDates from "src/hooks/useApplicationDates";

export default defineComponent({
  name: "MainFooter",

  setup() {
    const date = useApplicationDates();

    return {
      date,
    }
  }
})
</script>

<style lang="scss">
.main-footer {
  background: $dark;

  &__content {
    padding: calc(50% - 500px);
  }

  &__row {
    padding: 20px 25px;
    display: flex;
    justify-content: space-between;
  }

  &__col {
    display: flex;
    flex-direction: column;
  }

  &__apps {
    justify-content: center;
  }

  &__link {
    margin: 0 0 5px 0;
    color: $blue-grey;
  }

  &__a {
    &:hover {
      text-decoration-line: underline;
    }
  }
}

.app-links {
  display: flex;

  &__a {
    width: 110px;
    height: 35px;

    &:hover {
      transition: 0.3s;
      opacity: 0.4;
    }
  }

  &__ios {
    margin-left: 10px;
  }
}
</style>

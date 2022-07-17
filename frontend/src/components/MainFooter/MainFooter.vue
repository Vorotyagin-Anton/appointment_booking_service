<template>
  <footer class="container main-footer">
    <div class="main-footer__content">
      <div class="main-footer-info">

        <div class="main-footer-info__top">
          <div class="main-footer-info__lang">
            <span class="material-icons main-footer-info__lang-icon">language</span>
            <span class="main-footer-info__lang-btn">English</span>
          </div>

          <div class="main-footer-info__apps app-links">
            <a class="app-links__a app-links__ios" href="#">
              <img class="app-links__img" src="~assets/img/ios.svg" alt="ios">
            </a>

            <a class="app-links__a app-links__and" href="#">
              <img class="app-links__img" src="~assets/img/and.svg" alt="and">
            </a>
          </div>
        </div>

        <div class="main-footer-info__bottom">
          <div class="main-footer-info__copyright">
            &copy; <span class="main-footer-info__date">{{ currentDate }}</span> www.bookingservice.com
          </div>

          <div class="main-footer-info__about-us">
            <router-link class="main-footer-info__link" :to="{name: 'main'}">
              Licenses
            </router-link>

            <router-link class="main-footer-info__link" :to="{name: 'main'}">
              Privacy Notice
            </router-link>

            <router-link class="main-footer-info__link" :to="{name: 'main'}">
              Terms of Service
            </router-link>

            <router-link class="main-footer-info__link" :to="{name: 'main'}">
              Block, Inc.
            </router-link>
          </div>
        </div>

      </div>
    </div>
  </footer>
</template>

<script>
import useAppTime from "src/hooks/common/useAppTime";

export default {
  name: "MainFooter",

  setup() {
    const {currentDate} = useAppTime();

    return {
      currentDate,
    }
  }
}
</script>

<style lang="scss">
.main-footer {
  display: flex;
  justify-content: center;
  background: $charcoal;

  &__content {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 900px;
    padding: 100px 0 50px;
  }
}

.main-footer-info {
  display: flex;
  flex-direction: column;
  width: 900px;
  color: $white;

  &__top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    height: 70px;
    border-top: .1px solid $grey400;
    border-bottom: .1px solid $grey400;
    margin-bottom: 25px;
  }

  &__lang {
    display: flex;
    align-items: center;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
  }

  &__lang-icon {
    margin-right: 3px;
    font-size: 22px;
  }

  &__copyright {
    color: $grey400;
  }

  &__bottom {
    display: flex;
    justify-content: space-between;
  }

  &__about-us {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
  }

  &__link {
    padding: 2px 0;
    cursor: pointer;
  }
}

.app-links {
  display: flex;

  &__ios {
    margin-right: 5px;
  }

  &__img {
    width: 110px;
    height: 30px;
  }
}
</style>

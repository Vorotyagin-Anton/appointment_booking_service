<script setup>
import {ref} from "vue";

const show = ref(true);
const isExpansionOpen = ref(false);
const toggleExpansion = () => isExpansionOpen.value = !isExpansionOpen.value;
</script>

<template>
  <q-banner class="cabinet-banner" v-if="show">
    <div class="cabinet-banner__top">
      <q-btn
        class="cabinet-banner__close"
        icon="close"
        flat
        @click="show = false;"
      />
    </div>

    <div class="cabinet-banner__header">
      <h2 class="cabinet-banner__heading">Let’s get started</h2>

      <p class="cabinet-banner__p">
        This Setup Guide will take you through the steps needed to get My Business up and running on Booking
        Service.
      </p>
    </div>

    <div class="cabinet-banner__content">
      <section class="cabinet-banner__setup">
        <q-expansion-item
          class="banner-expansion"
          expand-icon-toggle
          expand-separator
          v-model="isExpansionOpen"
        >
          <template v-slot:header>
            <q-item-section>
              <h3
                class="banner-expansion__label"
                @click="toggleExpansion"
              >
                Setup your account
              </h3>
            </q-item-section>
          </template>

          <q-card class="banner-expansion__card">
            <q-card-section class="banner-expansion__section">

              <q-separator/>

              <div class="banner-expansion__item">
                <router-link
                  class="banner-expansion__link"
                  :to="{name: 'cabinet.profile'}"
                >
                  <p class="banner-expansion__title">Profile</p>

                  <p class="banner-expansion__desc">
                    Before you can accept bookings, we need to verify your identity.
                  </p>
                </router-link>
              </div>

              <q-separator/>

              <div class="banner-expansion__item">
                <router-link
                  class="banner-expansion__link"
                  :to="{name: 'cabinet.schedule'}"
                >
                  <p class="banner-expansion__title">Schedule</p>

                  <p class="banner-expansion__desc">
                    Set up a your work schedule so for your customers.
                  </p>
                </router-link>
              </div>

              <q-separator/>

              <div class="banner-expansion__item">
                <router-link
                  class="banner-expansion__link"
                  :to="{name: 'cabinet.services'}"
                >
                  <p class="banner-expansion__title">Services</p>

                  <p class="banner-expansion__desc">
                    Specify services for ordering.
                  </p>
                </router-link>
              </div>
            </q-card-section>
          </q-card>
        </q-expansion-item>
      </section>
    </div>
  </q-banner>
</template>

<style lang="scss">
.cabinet-banner {
  border-radius: 8px;
  box-shadow: 0 1px 2px rgb(0 0 0 / 10%), 0 0 4px rgb(0 0 0 / 10%);

  &__top {
    display: flex;
    justify-content: flex-end;
  }

  &__header {
    padding: 0 16px;
  }

  &__close {
    color: $grey-7;
  }

  &__heading {
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: 500;
    line-height: 25px;
  }

  &__p {
    font-size: 14px;
    font-weight: 300;
  }
}

.banner-expansion {
  &__label {
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
  }

  &__item {
    padding: 15px 10px 5px;

    &:hover .banner-expansion__title {
      text-decoration: underline;
    }
  }

  &__title {
    color: $primary;
    font-size: 14px;
    font-weight: 600;
  }

  &__desc {
    font-size: 14px;
    font-weight: 300;
    color: $black;
  }
}
</style>

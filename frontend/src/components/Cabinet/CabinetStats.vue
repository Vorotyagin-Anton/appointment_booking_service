<script setup>
const stats = [
  {
    name: 'Total customers',
    value: 0,
  },
  {
    name: 'New customers',
    value: 0,
  },
  {
    name: 'Returning customers',
    value: 0,
  },
  {
    name: 'Average spending per list customers',
    value: '$0.00',
  },
  {
    name: 'Average visits per customers',
    value: 0,
  },
  {
    name: 'Positive feedback',
    value: 0,
  },
  {
    name: 'Negative feedback',
    value: 0,
  },
];
</script>

<template>
  <div class="cabinet-stats">
    <q-list class="cabinet-stats__list">

      <q-item class="cabinet-stats__item">
        <q-item-section class="cabinet-stats__section" dense>
          <p class="cabinet-stats__heading">Last 30 days</p>
        </q-item-section>
      </q-item>

      <div
        v-for="stat in stats"
        :key="stat.name"
      >
        <q-separator class="cabinet-stats__separator"/>

        <router-link
          class="cabinet-stats__link"
          :to="{name: 'cabinet'}"
        >
          <q-item class="cabinet-stats__item">
            <q-item-section class="cabinet-stats__section">
              <span class="cabinet-stats__hovered cabinet-stats__name">{{ stat.name }}</span>
            </q-item-section>

            <q-item-section side class="cabinet-stats__section">
              <span class="cabinet-stats__hovered cabinet-stats__value">{{ stat.value }}</span>
              <q-icon class="cabinet-stats__icon" name="navigate_next"/>
            </q-item-section>
          </q-item>
        </router-link>

      </div>
    </q-list>
  </div>
</template>

<style lang="scss">
.cabinet-stats {
  padding-top: 25px;

  &__heading {
    font-size: 16px;
    font-weight: 600;
  }

  &__list {
    width: 300px;
  }

  &__item {
    color: $black;
    padding-left: 10px;
    padding-right: 5px;

    &:hover .cabinet-stats__hovered {
      color: $primary;
    }
  }

  &__separator {
    background-color: $grey-3;
  }

  &__section {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center !important;
  }

  &__name {
    font-size: 12px;
  }

  &__value {
    margin-right: 10px;
    font-size: 12px;
    color: $black !important;
  }

  &__icon {
    font-size: 18px !important;
    color: $grey-4;
  }
}
</style>

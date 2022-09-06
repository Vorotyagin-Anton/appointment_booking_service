<script setup>
import {computed} from "vue";
import formatPrice from "src/filters/formatPrice";
import BannerContainer from "components/Cabinet/Common/BannerContainer";
import DropdownCalendar from "components/Cabinet/Banners/Calendar/DropdownCalendar";
import SalesItem from "components/Cabinet/Banners/Calendar/SalesItem";

const sales = computed(() => formatPrice('0.00'));
const averageSales = computed(() => formatPrice('0.00'));
const returns = computed(() => formatPrice('0.00'));
const transactions = 0;

</script>

<template>
  <banner-container class="sales-history">
    <dropdown-calendar class="sales-history__calendar"/>

    <div class="sales-history__content">
      <sales-item
        class="sales-history__item"
        label="Sales"
        :value="'$ ' + sales"
      />

      <sales-item
        class="sales-history__item"
        label="Transactions"
        :value="transactions"
      />

      <sales-item
        class="sales-history__item"
        label="Average sales"
        :value="'$ ' + averageSales"
      />

      <sales-item
        class="sales-history__item"
        label="Returns"
        :value="'$ ' + returns"
      />
    </div>
  </banner-container>
</template>

<style lang="scss">
.sales-history {
  &__calendar {
    margin-bottom: 60px;
  }

  &__content {
    display: flex;
    flex-wrap: wrap;
  }

  &__item {
    margin-bottom: 15px;
  }
}
</style>

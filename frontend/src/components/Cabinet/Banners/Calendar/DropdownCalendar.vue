<script setup>
import moment from "moment";
import {computed, ref} from "vue";

const date = ref();

const dateLabel = computed(() => {
  if (!date.value) {
    return moment().format('MMM\. D');
  }

  return moment(date.value).format('MMM\. D');
});
</script>

<template>
  <div class="dropdown-calendar">
    <q-btn
      class="dropdown-calendar__btn"
      :label="dateLabel"
      color="grey"
      no-caps
      outline
    >
      <q-menu
        class="dropdown-calendar__menu"
        transition-show="jump-down"
        transition-hide="jump-up"
      >
        <q-date
          class="dropdown-calendar__dates"
          v-model="date"
          landscape
        >
          <div class="row items-center justify-end">
            <q-btn v-close-popup label="Close" flat />
            <q-btn v-close-popup label="Submit" color="primary" flat/>
          </div>
        </q-date>
      </q-menu>
    </q-btn>
  </div>
</template>

<style lang="scss">
.dropdown-calendar {
  &__btn {
    min-width: 110px;
    min-height: 45px;

    & .q-btn__content {
      font-size: 17px;
      color: $dark;
    }
  }
}
</style>

<script setup>
import ServicesRow from "components/Cabinet/Business/Services/ServicesRow";

const emit = defineEmits([
  'toggle', 'remove',
]);

const props = defineProps({
  services: {type: Array, required: true},
});

const remove = (id) => emit('remove', id);

</script>

<template>
  <div class="services-table">
    <div class="services-table__row">
      <div class="services-table__col services-table__active">Active</div>
      <div class="services-table__col services-table__name">Name</div>
      <div class="services-table__col services-table__description">Description</div>
      <div class="services-table__col services-table__price">Price</div>
      <div class="services-table__col services-table__duration">Duration</div>
      <div class="services-table__col services-table__image">Image</div>
    </div>

    <ServicesRow
      v-for="row in services"
      :key="row.name"
      :row="row"
      @remove="remove"
    />
  </div>
</template>

<style lang="scss">
.services-table {
  border: 1px solid rgba(0, 0, 0, .12);

  &__row {
    width: 100%;
    height: 35px;
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid rgba(0, 0, 0, .12);
    background-color: $grey-3;

    &:last-of-type {
      border-bottom: none;
    }
  }

  &__col {
    flex: 1;
    display: flex;
    align-items: center;
    padding: 5px;
    font-weight: 500;
  }

  &__name,
  &__image {
    flex: 2;
  }

  &__description {
    flex: 4;
  }
}
</style>

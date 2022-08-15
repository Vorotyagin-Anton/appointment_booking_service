<script setup>
import {ref} from "vue";

const props = defineProps({
  sortMap: {
    type: Array,
    required: true,
  },

  orderMap: {
    type: Array,
    required: true,
  },

  perPageMap: {
    type: Array,
    required: true,
  },

  perPage: {
    type: Number,
    required: true,
  },
});

const emit = defineEmits(['sort']);

const sort = ref(null);
const order = ref(null);
const offset = ref(props.perPage);

const applySorting = () => emit('sort', {
  sort: sort.value,
  order: order.value,
  offset: offset.value,
});
</script>

<template>
  <div class="sorting-panel">
    <div class="sorting-panel__sorting">
      <q-select
        class="sorting-panel__select"
        v-model="sort"
        :options="sortMap"
        :options-dense="true"
        dense="dense"
        label="Sort by"
        bg-color="white"
        borderless
        square
        @update:model-value="applySorting"
      >
        <template v-slot:append>
          <q-icon
            name="close"
            v-if="sort !== null"
            @click.stop="sort = null"
            class="cursor-pointer select-dropdown__clear"
          />
        </template>
      </q-select>

      <q-select
        class="sorting-panel__select sorting-panel__order"
        v-model="order"
        :options="orderMap"
        :options-dense="true"
        dense="dense"
        label="Order"
        bg-color="white"
        borderless
        square
        @update:model-value="applySorting"
      />
    </div>

    <q-select
      class="sorting-panel__select sorting-panel__show"
      v-model="offset"
      :options="perPageMap"
      :options-dense="true"
      dense="dense"
      bg-color="white"
      borderless
      square
      @update:model-value="applySorting"
    />
  </div>
</template>

<style lang="scss">
.sorting-panel {
  width: 100%;
  display: flex;
  justify-content: space-between;
  padding: 10px;
  background-color: $grey-2;

  &__sorting {
    display: flex;
  }

  &__select {
    width: 150px;
    margin-right: 8px;

    .q-field__native {
      font-size: 14px;
      padding-left: 10px;
    }

    .q-field__label {
      left: 10px;
    }

    &__clear {
      font-size: 18px;
    }
  }

  &__order {
    width: 80px;
    margin-right: 35px;
  }

  &__show {
    width: 50px;
    align-self: flex-end;
  }
}
</style>

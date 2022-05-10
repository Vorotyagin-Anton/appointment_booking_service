<template>
  <div class="masters-sorting">

    <div class="masters-sorting__sorting">
      <q-select
        class="masters-sorting__select"
        v-model="sort"
        :options="sortMap"
        :dense="'dense'"
        :options-dense="true"
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
        class="masters-sorting__select masters-sorting__order"
        v-model="order"
        :options="orderMap"
        :dense="'dense'"
        :options-dense="true"
        label="Order"
        bg-color="white"
        borderless
        square
        @update:model-value="applySorting"
      />
    </div>

    <q-select
      class="masters-sorting__select masters-sorting__show"
      v-model="offset"
      :options="perPageMap"
      :dense="'dense'"
      :options-dense="true"
      bg-color="white"
      borderless
      square
      @update:model-value="applySorting"
    />

  </div>
</template>

<script>
import {onMounted, ref} from "vue";

export default {
  name: "MastersSorting",

  emits: ['sort'],

  setup(props, {emit}) {
    const sort = ref(null);
    const order = ref(null);
    const offset = ref(12);

    const applySorting = () => emit('sort', {
      sort: sort.value,
      order: order.value,
      offset: offset.value,
    });

    return {
      sort,
      order,
      offset,
      sortMap: ['Name', 'Rating', 'Popularity'],
      orderMap: [null, 'Asc', 'Desc'],
      perPageMap: [12, 30, 60, 90],

      applySorting,
    }
  }
}
</script>

<style lang="scss">
.masters-sorting {
  width: 885px;
  display: flex;
  justify-content: space-between;
  padding: 10px 10px;
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

<template>
  <div class="profile-category">
    <div class="profile-category__content">
      <h2 class="profile-category__h2">Tell us about our business</h2>

      <div class="profile-category__label">What type of business do you run?</div>

      <q-select
        class="profile-category__select"
        outlined
        use-input
        use-chips
        multiple
        standout
        v-model="selectedItems"
        :options="filteredItems"
        @filter="filterFn"
      >
        <template v-slot:append>
          <q-icon
            v-if="selectedItems.length > 0"
            class="cursor-pointer"
            name="clear"
            @click.stop="selectedItems = []"
          />
        </template>

        <template v-slot:option="scope">
          <q-item v-bind="scope.itemProps">
            <q-item-section>
              <q-item-label class="profile-category__option">{{ scope.opt.label }}</q-item-label>
              <q-item-label class="profile-category__description" caption>{{ scope.opt.promo }}</q-item-label>
            </q-item-section>
          </q-item>
        </template>

        <template v-slot:no-option>
          <q-item>
            <q-item-section class="text-grey">
              No results
            </q-item-section>
          </q-item>
        </template>
      </q-select>

      <div class="profile-type__bottom">
        <q-btn
          class="profile-type__btn"
          label="Back"
          color="black"
          outline
          no-caps
          @click="prev"
        />

        <q-btn
          class="profile-type__btn"
          label="Continue"
          color="primary"
          no-caps
          @click="next"
        />
      </div>
    </div>
  </div>
</template>

<script>
import useCategories from "src/hooks/categories/useCategories";
import useSelect from "src/hooks/form/useSelect";
import useMessage from "src/hooks/common/useMessage";
import {onMounted} from "vue";

export default {
  name: "ProfileCategory",

  emits: [
    'next',
    'prev',
  ],

  setup(props, {emit}) {
    const {categories, getFromApi} = useCategories();

    const {filteredItems, selectedItems, filterFn} = useSelect(categories);

    const {showError, hide} = useMessage();

    const next = () => {
      if (selectedItems.value.length === 0) {
        showError('Please select type of your business.', 5000);
        return;
      }

      emit('next');

      hide();
    }

    const prev = () => emit('prev');

    onMounted(async () => {
      if (categories.value.length === 0) {
        await getFromApi();
      }
    });

    return {
      filteredItems,
      selectedItems,
      filterFn,
      next,
      prev,
    }
  }
}
</script>

<style lang="scss">
.profile-category {
  display: flex;
  justify-content: center;

  &__content {
    width: 750px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  &__h2 {
    font-size: 36px;
    padding: 15px 0;
  }

  &__label {
    margin-bottom: 10px;
    width: 100%;
    text-align: left;
    font-weight: 300;
  }

  &__select {
    width: 100%;
  }

  &__option {
    text-transform: capitalize;
    color: $primary;
    margin-bottom: 5px;
  }

  &__bottom {
    margin-top: 25px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 25px 0;
    border-top: 1px solid $grey-4;
  }

  &__btn {
    width: 360px;
    height: 40px;
  }
}
</style>

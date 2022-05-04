<template>
  <div class="masters">
    <breadcrumbs-section :breadcrumbs="breadcrumbs"/>

    <div class="container">
      <div class="masters__content">

        <div class="masters__sidebar">
          <search-input
            class="masters__search"
            :search-callback="search"
          />

          <q-separator class="masters__separator"/>

          <masters-filter
            class="masters__filter"
            @filter="applyFilters"
          />
        </div>

        <div class="masters__list">
            <masters-sorting
              class="masters__sorting"
              @sort="applySort"
            />

            <masters-list
              class="masters__items"
              :params="params"
            />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {ref} from "vue";
import useSearch from "src/hooks/masters/useSearch";
import useBreadcrumbs from "src/hooks/common/useBreadcrumbs";
import BreadcrumbsSection from "components/Sections/BreadcrumbsSection";
import MastersSorting from "components/Catalog/Masters/MastersSorting";
import MastersList from "components/Catalog/MastersList";
import MastersFilter from "components/Catalog/Masters/MastersFilter";
import SearchInput from "components/Common/SearchInput";

export default {
  name: "MastersPage",

  components: {
    BreadcrumbsSection,
    MastersSorting,
    MastersList,
    SearchInput,
    MastersFilter,
  },

  setup() {
    const {getByRoute} = useBreadcrumbs();
    const breadcrumbs = getByRoute('masters');

    const params = ref({
      offset: 12,
    });

    const applySort = (options) => mergeParams(options);
    const applyFilters = (filters) => mergeParams(filters);

    const mergeParams = (data) => {
      const normalizedData = {};

      for (let prop in data) {
        if (data.prop != null && data.prop !== [] && data.prop !== '') {
          normalizedData.prop = data.prop;
        }
      }

      params.value = {...params.value, ...normalizedData};
    };

    const search = useSearch();

    return {
      breadcrumbs,
      params,
      applySort,
      applyFilters,
      search,
    }
  }
}
</script>

<style lang="scss">
.masters {
  &__content {
    display: flex;
    padding: 50px 27px;
  }

  &__sidebar {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 350px;
    margin-right: 50px;
    padding: 0 15px;
  }

  &__search {
    padding: 0 10px;
    margin-top: 20px;
    width: 100%;
  }

  &__separator {
    margin: 32px 0 50px;
    width: 100%;
  }

  &__sorting {
    display: flex;
    margin-bottom: 30px;
  }

  &__list {
    max-width: 885px;
  }
}
</style>

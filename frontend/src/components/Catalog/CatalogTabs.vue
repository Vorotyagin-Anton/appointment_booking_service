<template>
  <div class="q-pa-md container app-catalog">
    <div class="q-gutter-y-md">
      <q-card class="app-catalog__card">
        <q-tabs
          class="app-catalog__tabs"
          v-model="tab"
          align="left"
          active-color="primary"
          indicator-color="primary"
          dense
        >
          <q-tab
            class="app-catalog__tab"
            name="services"
            label="Services"
          />
          <q-tab
            class="app-catalog__tab"
            name="masters"
            label="Masters"
          />
        </q-tabs>

        <q-tab-panels v-model="tab" animated class="app-catalog__panels">
          <q-tab-panel class="app-catalog__panel" name="services">
            <service-list/>
          </q-tab-panel>

          <q-tab-panel class="app-catalog__panel" name="masters">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
          </q-tab-panel>
        </q-tab-panels>
      </q-card>

    </div>
  </div>
</template>

<script>
import {defineComponent, ref} from "vue";
import ServiceList from "components/Catalog/ServiceList";

export default defineComponent({
  name: "CatalogTabs",

  components: {
    ServiceList,
  },

  setup() {
    const tab = ref('services');

    return {
      tab,
    }
  }
})
</script>

<style lang="scss">
  .app-catalog {
    width: 100%;

    &__card {
      box-shadow: none;
      border-radius: 0;
    }

    &__tabs {
      display: flex;
      justify-content: flex-start;
      height: 60px;
      padding: 25px 50px 0 50px;
    }

    &__tab {
      min-width: 150px;
    }

    &__panels {
      height: 800px;
    }
  }
</style>

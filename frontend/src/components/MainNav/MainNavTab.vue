<template>
  <div class="main-link">
    <q-route-tab
      class="main-link__tab"
      :class="{'main-link__tab_selected': isSelected}"
      :name="title"
      :label="title"
      :to="to"
      @click="select"
    >
      <keep-alive v-if="child">
        <component :is="child"/>
      </keep-alive>
    </q-route-tab>
  </div>
</template>

<script>
export default {
  name: "MainNavTab",

  emits: ['select'],

  props: {
    name: {
      type: String,
      required: true,
    },

    title: {
      type: String,
      required: true,
    },

    to: {
      type: [Object, null],
      default: null,
    },

    child: {
      type: [Object, null],
      default: null,
    },

    selectable: {
      type: Boolean,
      default: true,
    },

    isSelected: {
      type: Boolean,
      default: false,
    },
  },

  setup(props, {emit}) {
    const select = () => {
      if (props.selectable) {
        emit('select', props.name);
      }
    }

    return {
      select,
    }
  }
}
</script>

<style lang="scss">
.main-link {
  &__tab {
    text-transform: capitalize;

    .q-tab__label {
      font-size: 16px;
      color: $grey-8;
    }

    &_selected {
      .q-tab__label {
        color: $black;
      }
    }
  }
}
</style>

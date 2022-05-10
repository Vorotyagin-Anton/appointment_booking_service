<template>
  <q-input
    class="search-input"
    outlined
    square
    dense
    v-model="input"
    label="Search"
    :loading="isDisabled"
    @focusin="setFocus(true)"
    @focusout="setFocus(false)"
  >
    <template
      v-slot:append
      v-if="!isDisabled"
    >
      <q-icon
        class="search-input__clear"
        name="close"
        v-if="isNotEmpty"
        @click="resetInput"
      />

      <q-separator vertical/>

      <div class="search-input__btn">
        <q-icon
          class="search-input__search"
          name="search"
          @click="callSearchCallback"
        />
      </div>
    </template>
  </q-input>
</template>

<script>
import useSearch from "src/hooks/form/useSearch";

export default {
  name: "SearchInput",

  props: {
    searchCallback: {
      type: Function,
      required: true,
    },
  },

  setup(props) {
    return useSearch(props.searchCallback);
  }
}
</script>

<style lang="scss">
.search-input {

  &__clear {
    right: 10px;
    cursor: pointer;
  }

  &__search {
    left: 5px;
  }

  &__btn {
    cursor: pointer;
  }
}
</style>

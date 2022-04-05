<template>
  <q-card class="my-card masters-card" flat bordered>

    <q-card-section class="masters-card__header">
      <div class="text-h6 q-mb-xs">{{ name + ' ' + surname }}</div>
      <div class="row no-wrap items-center">
        <q-rating
          :color="'warning'"
          size="14px"
          v-model="rating"
          :max="5"
          readonly
        />

        <span class="text-caption text-grey q-ml-sm">4.2 (551)</span>
      </div>
    </q-card-section>

    <q-separator/>

    <q-card-section horizontal>
      <q-card-section class="col-5 justify-center items-center">
        <q-avatar :size="'6rem'">
          <img
            src="https://cdn.quasar.dev/img/boy-avatar.png"
            alt="img"
          />
        </q-avatar>
      </q-card-section>

      <q-card-section class="q-pt-xs">
        <div class="text-caption text-grey">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
          magna aliqua.
        </div>
      </q-card-section>
    </q-card-section>

    <q-separator/>

    <q-card-actions>
      <q-btn
        flat
        round
        icon="event"
      />

      <q-btn
        flat
        color="primary"
        @click="selectMaster"
      >
        Reserve
      </q-btn>
    </q-card-actions>
  </q-card>
</template>

<script>
import {ref, toRefs} from "vue";

export default {
  name: "MastersListItem",

  props: {
    item: {
      type: Object,
      required: true,
    },
  },

  emits: [
    'selected',
  ],

  setup(props, {emit}) {
    const {item} = toRefs(props);

    const selectMaster = () => emit('selected', item.value);

    return {
      name: item.value.name,
      surname: item.value.surname,
      rating: ref(4),
      selectMaster,
    }
  }
}
</script>

<style lang="scss">
.masters-card {
  width: 100%;
  max-width: 280px;
  margin-bottom: 35px;
  margin-right: 35px;
  transition: 0.3s ease-in-out;

  &:hover {
    transform: scale(1.04);
    cursor: pointer;
  }

  &__header {
    background-color: $grey-2,
  }
}

.q-rating {
  &__icon {
    text-shadow: none;
  }
}
</style>

<template>
  <q-card class="my-card masters-card" flat bordered>

    <q-card-section class="masters-card__header">
      <master-header
        :rating="rating"
        :name="item.name + ' ' + item.surname"
        :class-name="'masters-card__heading'"
      />
    </q-card-section>

    <q-separator/>

    <q-card-section horizontal>
      <master-info
       :name="item.name"
       image="https://i.pravatar.cc/700"
       speciality="Lorem ipsum"
       info="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua"
       :avatar-size="100"
       class-name="masters-card__info"
      />
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
import MasterHeader from "components/Master/MasterHeader";
import MasterInfo from "components/Master/MasterInfo";

export default {
  name: "MastersListItem",

  components: {
    MasterHeader,
    MasterInfo,
  },

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

    const rating = ref({
      max: 5,
      score: (Math.random() * 4 + 1).toFixed(1),
      voices: Math.floor(Math.random() * 200),
    });

    const selectMaster = () => emit('selected', item.value);

    return {
      name: item.value.name,
      surname: item.value.surname,
      rating,
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
    padding: 15px 15px 10px;
    background-color: $grey-2,
  }

  &__heading {
    display: flex;
    flex-direction: column;

    .master-header__name {
      margin-bottom: 7px;
    }
  }

  &__info {
    display: flex;
    padding: 15px 15px 10px;

    .master-info__avatar {
      display: flex;
      align-items: center;
    }

    .master-info__about {
      align-items: flex-start;
    }
  }
}

.q-rating {
  &__icon {
    text-shadow: none;
  }
}
</style>

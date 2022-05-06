<template>
  <q-card
    class="my-card masters-card"
    @click="selectMaster"
    flat
    bordered
  >

    <q-card-section class="masters-card__header">
      <master-header
        class="masters-card__heading"
        :rating="rating"
        :name="master.name + ' ' + master.surname"
      />
    </q-card-section>

    <q-separator/>

    <q-card-section horizontal>
      <master-info
        class="masters-card__info"
        :name="master.name"
        :image="generateSourceUrl()"
        speciality="Lorem ipsum"
        info="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua"
        :avatar-size="100"
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
        @click.stop="reserveMaster"
      >
        Reserve
      </q-btn>
    </q-card-actions>
  </q-card>
</template>

<script>
import {ref} from "vue";
import useRandomAvatar from "src/hooks/common/useRandomAvatar";
import MasterHeader from "components/Master/MasterHeader";
import MasterInfo from "components/Master/MasterInfo";

export default {
  name: "MasterCard",

  components: {
    MasterHeader,
    MasterInfo,
  },

  props: {
    master: {
      type: Object,
      required: true,
    },
  },

  emits: [
    'selected',
    'reserved',
  ],

  setup(props, {emit}) {
    const rating = ref({
      max: 5,
      score: Number((Math.random() * 4 + 1).toFixed(1)),
      voices: Math.floor(Math.random() * 200),
    });

    const selectMaster = () => emit('selected', props.master.id);

    const reserveMaster = () => emit('reserved', props.master.id);

    const {generateSourceUrl} = useRandomAvatar();

    return {
      rating,
      selectMaster,
      reserveMaster,
      generateSourceUrl,
    }
  }
}
</script>

<style lang="scss">
.masters-card {
  width: 100%;
  max-width: 280px;
  margin-bottom: 25px;
  //transition: 0.3s ease-in-out;

  &:hover {
    //transform: scale(1.03);
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

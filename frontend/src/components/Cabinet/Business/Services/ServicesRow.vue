<script setup>
import {ref} from "vue";

const props = defineProps({
  row: {type: Object, required: true},
});

const emit = defineEmits([
  'toggle', 'remove',
]);

const active = ref(props.row.active);
const price = ref();
const duration = ref();
const image = process.env.HOST + props.row.pathToPhoto;

const toggleActive = () => {
  active.value = !active.value;
  emit('toggle', !active.value);
}

const remove = () => emit('remove', props.row.id);
</script>

<template>
  <div class="service-row">
    <div class="service-row__col service-row__active" @click="toggleActive">
      <q-checkbox class="service-row__checkbox" v-model="active"/>
    </div>

    <div class="service-row__col service-row__name">
      {{ row.name }}
    </div>

    <div class="service-row__col service-row__description">
      <span v-if="row.description">
        {{ row.description }}
      </span>

      <div v-else class="service-row__placeholder">
        Add description
      </div>
    </div>

    <div class="service-row__col service-row__price">
      <q-input
        v-model.number="price"
        :placeholder="row.price"
        type="number"
        min="0"
        dense
      />
    </div>

    <div class="service-row__col service-row__duration">
      <q-input
        v-model.number="duration"
        :placeholder="row.duration"
        type="number"
        min="1"
        max="24"
        dense
      />
    </div>

    <div class="service-row__col service-row__image">
      <q-img
        v-if="row.pathToPhoto"
        class="service-row__img"
        :src="image"
      />

      <div v-else class="service-row__placeholder">
        Add image
      </div>
    </div>

    <div class="service-row__add">
      <span class="material-icons service-row__add-icon" @click="remove">
        highlight_off
      </span>
    </div>
  </div>
</template>

<style lang="scss">
.service-row {
  position: relative;
  display: flex;
  justify-content: space-between;
  border-bottom: 1px solid rgba(0, 0, 0, .12);

  &:last-of-type {
    border-bottom: none;
  }

  &__col {
    flex: 1;
    min-height: 50px;
    padding: 5px;
    display: flex;
    align-items: center;
  }

  &__active {
    cursor: pointer;
  }

  &__name,
  &__image {
    flex: 2;
  }

  &__price,
  &__duration {
    .q-field__control:before {
      border-bottom: none;
    }
  }

  &__description {
    flex: 4;
  }

  &__img {
    max-height: 50px;
    cursor: pointer;
  }

  &__placeholder {
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    font-size: 20px;
    font-weight: 700;
    color: $grey-4;
    cursor: pointer;
    transition: color .4s;

    &:hover {
      color: $grey-5;
    }
  }

  &__checkbox {
    margin-right: 15px;

    .q-checkbox__inner {
      &:before {
        background: none;
      }
    }
  }

  &__inputs {
    flex: 5;
    display: flex;
    flex-direction: column;
  }

  &__add {
    position: absolute;
    height: 100%;
    display: flex;
    align-items: center;
    right: -35px;
  }

  &__add-icon {
    font-size: 24px;
    color: $grey-7;
    cursor: pointer;

    &:hover {
      color: $red-6;
    }
  }
}
</style>

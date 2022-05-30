<template>
  <div
    class="master-career"
    :class="className"
  >
    <div
      class="master-career__stage"
      v-for="(item, key) in career"
      :key="key"
    >
      <div class="master-career__dates">
        {{ item.yearFrom }} -
        <span v-if="item.yearTo"> {{ item.yearTo }} </span>
        <span v-else> to this day </span>
      </div>

      <div class="master-career__biography">
        <span class="master-career__speciality">{{ item.speciality }}</span>

        <div class="master-career__place">
          <span class="material-icons master-career__icon">place</span>
          <span class="master-career__organization">{{ item.place }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MasterCareer",

  props: {
    career: {
      type: Array,
      default: function (){
        return [
          {
            id: 1,
            place: "place",
            speciality: "speciality",
            yearFrom: "2000-00-00",
            yearTo: "2000-00-00",
          },
        ]
      }
      //required: true,
    },

    className: {
      type: String,
      default: '',
    },
  },
}
</script>

<style lang="scss">
.master-career {
  display: flex;
  flex-direction: column;
  overflow: auto;

  &__stage {
    display: flex;
    margin-bottom: 15px;
  }

  &__dates {
    margin-top: 3px;
    font-size: 12px;
    font-weight: 500;
    color: $grey-8;
  }

  &__biography {
    display: flex;
    flex-direction: column;
  }

  &__speciality {
    font-size: 13px;
    font-weight: 600;
    color: $grey-8;
    margin-bottom: 2px;
  }

  &__place {
    display: flex;
    font-size: 11px;
    font-weight: 400;
    color: $grey-7;
  }

  &__icon {
    color: $grey-7;
    margin-right: 2px;
  }

  &__organization {
    margin-top: 3px;
  }
}
</style>

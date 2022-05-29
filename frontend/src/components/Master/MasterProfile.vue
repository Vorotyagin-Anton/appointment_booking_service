<template>
  <div class="master-profile">

    <div class="master-profile__column">
      <div class="master-profile__box">

        <div class="master-profile__section">
          <master-header
            :class-name="'master-profile__header'"
            :name="master.name + ' ' +  master.surname"
            :rating="master.rating"
          />
        </div>

        <div class="master-profile__section">
          <master-info
            :class-name="'master-profile__info'"
            :name="master.name"
            :image="hostUrl + master.pathToPhoto"
            :speciality="master.speciality"
            :info="master.story"
            :avatar-size="140"
          />
        </div>
      </div>

      <div class="master-profile__box">
        <div class="master-profile__section">
          <h5 class="master-profile__h4">Experience</h5>
        </div>

        <div class="master-profile__section">
          <master-career
            :career="master.career"
            :class-name="'master-profile__career'"
          />
        </div>
      </div>
    </div>

    <div class="master-profile__column">
      <div class="master-profile__box master-profile__reviews">
        <div class="master-profile__section">
          <h5 class="master-profile__h4">Reviews</h5>
        </div>

        <div class="master-profile__section">
          <master-reviews :reviews="master.gettedReviews"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MasterHeader from "components/Master/MasterHeader";
import MasterInfo from "components/Master/MasterInfo";
import MasterCareer from "components/Master/MasterCareer";
import MasterReviews from "components/Master/MasterReviews";

export default {
  name: "MasterProfile",

  components: {
    MasterHeader,
    MasterInfo,
    MasterCareer,
    MasterReviews,
  },

  props: {
    master: {
      type: Object,
      default: function () {
        return {
          speciality: 'Speciality default',
        }
      }
      //required: true,
    },
  },

  setup(){
    const hostUrl = 'http://localhost:8081'
    return{
      hostUrl,
    }
  }
}
</script>

<style lang="scss">
.master-profile {
  display: flex;
  justify-content: flex-start;
  max-height: 600px;
  padding: 25px;
  box-sizing: border-box;

  &__column {
    margin-right: 10px;
  }

  &__box {
    margin-bottom: 10px;
  }

  &__section {
    width: 400px;
    max-height: 500px;
    overflow: auto;
    display: flex;
    align-items: center;
    padding: 25px 20px;
    box-sizing: border-box;
    background-color: $white;
    margin-bottom: 5px;
  }

  &__header {
    .master-header__name {
      width: 140px;
      margin-right: 25px;
    }
  }

  &__info {
    display: flex;
  }

  &__career {
    .master-career__dates {
      width: 140px;
      margin-right: 25px;
    }
  }

  &__h4 {
    font-size: 15px;
    font-weight: 600;
    color: $grey-9;
    line-height: 15px;
  }
}
</style>

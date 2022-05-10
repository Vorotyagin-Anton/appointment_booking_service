<template>
  <div
    class="master-info"
    :class="className"
  >
    <div class="master-info__avatar">
      <profile-avatar
        :size="avatarSize"
        :name="name"
        :image="image"
      />
    </div>

    <div class="master-info__about">
      <h6 class="master-info__speciality">{{ speciality }}</h6>
      <p class="master-info__info">{{ info }}</p>
    </div>
  </div>
</template>

<script>
import ProfileAvatar from "components/Profile/ProfileAvatar";

export default {
  name: "MasterInfo",

  components: {
    ProfileAvatar,
  },

  props: {
    name: {
      type: String,
      required: true,
    },

    image: {
      type: String,
      default: '',
    },

    speciality: {
      type: String,
      default: '',
    },

    info: {
      type: String,
      default: '',
    },

    avatarSize: {
      type: Number,
    },

    className: {
      type: String,
      default: '',
    },
  },
}
</script>

<style lang="scss">
.master-info {
  &__avatar {
    margin-right: 25px;
  }

  &__about {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  &__speciality {
    font-size: 14px;
    font-weight: 600;
    color: $grey-8;
    line-height: 18px;
    margin-bottom: 15px;
  }

  &__info {
    font-size: 12px;
    font-weight: 400;
    color: $grey-7;
  }
}
</style>
